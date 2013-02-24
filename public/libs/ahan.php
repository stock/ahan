<?php
require_once('config.php');
include "dbclass.php";

class Ahan
{
	var $title;
	var $tblname;
	var $db;
	var $flag;

	function Ahan()	{	
		global $dbhost,$dbuser,$dbpass,$dbname;
    	$this->db =new DBClass($dbhost,$dbuser,$dbpass,$dbname);
		$this->title=array('','杂阿含经','中阿含经','长阿含经','增一阿含经','南传相应部','南传中部','南传长部','南传增支部','南传小部','比丘戒律');
		$this->tblname=array('','za','zhong','chang','zeng','nc_za','nc_zhong','nc_chang','nc_zeng','nc_xiao','jielv');
//		$this->flag=array('S'=>'nc_za','M'=>'nc_zhong','D'=>'nc_chang','A'=>'nc_zeng');
		$this->flag=array('S'=>'nc_za');
	}

	
	function joinkey($keytext)
	{
		$keybuf=trim($keytext);
		if ($keybuf!='')
		{
			$keyarr=explode(' ',preg_replace('/ +/',' ',$keybuf));
			$keybuf='';
			for ($ii=0;$ii<count($keyarr);$ii++)
			{
				if ($keyarr[$ii]!='')
				{
					$keybuf .= " content like '%{$keyarr[$ii]}%'";
					if ($ii<count($keyarr)-1)
						$keybuf .= " and ";
				}
			}
		}
		return $keybuf;
	}

	function SetKeyColor($content,$keytext)
	{
		$colors=array('red','aqua','blue','green','fuchsia','bisque','yellow','paleturquoise');
		$keybuf=trim($keytext);

		if ($keybuf!='')
		{
			$keyarr=explode(' ',preg_replace('/ +/',' ',$keybuf));
			for ($i=0;$i<count($keyarr);$i++)
				$keyarrc[$i]="<font color='".$colors[$i]."'>".$keyarr[$i]."</font>";

			$keybuf=str_replace($keyarr,$keyarrc,$content);

		}
		return $keybuf;
	}

	function Chinese($p)	{
		$s='';
	    $a=array("〇","一","二","三","四","五","六","七","八","九");
	    while ($p>0.8)
		{
	        $n = $p % 10;
		    $p = floor($p / 10);
			$s = $a[$n] . $s;
		}
		
		return $s;
	}
	function Number($p)	{
		$s=0;
	    $a=array("〇"=>0,"一"=>1,"二"=>2,"三"=>3,"四"=>4,"五"=>5,"六"=>6,"七"=>7,"八"=>8,"九"=>9);
		$n=strlen($p);
	    for ($i=0;$i<$n;$i+=3)
		{
	        $c = substr($p,$i,3);
		    $k = $a[$c];
			$s = $k + $s*10;
		}
		
		return $s;
	}
	function GetContent2($rs,$starts,$ends) {
		$buf= $rs['content'];
		$starts=quotemeta($starts);
		$ends=quotemeta($ends);
		if ($ends=='')
			$s="/({$starts}[\s\S]+)/";
		else
			$s="/({$starts}[\s\S]+?){$ends}/";
		preg_match_all($s,$buf,$m);
		$data=$m[1];
		if (count($data)>0)
			$result=$data[0];
		else
			$result='没有内容';
		return $result;
	}

	function GetIndex($rs) {
		$buf= $rs['content'];
		preg_match_all("/(第.+?品)\s*?\n/",$buf,$result);
		$p1=$result[1];
		preg_match_all("/(\[.+?\]\s*第.+?)\s*?\n/",$buf,$result);
		$n=0;
		foreach ($result[1] as $s)
		{
			$n++;
			while (!strstr($s,"[".$this->Chinese($n)."]"))
			{
				$p2[$n]='';
				$n++;
			}
			$p2[$n]=$s;
		}
		$p[0]=$p1;
		$p[1]=$p2;
		return $p;
	}

	function GetTitle($jing)	{
		return $this->title[$jing];
	}

	function GetDir($jing,$keytext='')	{
		$buffer = '';
		switch ($jing)
		{
			case 1:
	            $buffer .='<br />';

				if ($keytext!='')
				{

					$sql="select id,juan from za where ".$this->joinkey($keytext);
					$this->db->query($sql);		
					$cnt = $this->db->recordCount();
					$buffer .= '(<a href="?fojing='.$jing.'">返回</a>)<br />搜索<b>'.$keytext.'</b>的结果如下:<br />';


				}
				else
				{
					$sql="select id,juan from za";
					$this->db->query($sql);		
					$cnt = $this->db->recordCount();
				}


	            $buffer .= '<b>共有'.$cnt.'经</b><br />';
				for ($i=1;$i<=$cnt;$i++)
				{
					$rs = $this->db->getRow();
					$buffer .= "<a href=\"/view/1/{$rs['id']}/".urlencode($keytext)."\" target=\"main\">第{$rs['id']}经 (第" . $rs['juan']. "卷)</a>";
					$buffer .= "<br />";
				}
				break;
			case 4:
				if ($keytext!='')
				{
					$sql="select id from {$this->tblname[$jing]} where ".$this->joinkey($keytext);
					$this->db->query($sql);		
					$cnt = $this->db->recordCount();
					$buffer .= '(<a href="?fojing='.$jing.'">返回</a>)<br />搜索<b>'.$keytext.'</b>的结果如下:<br />';
				}
				else
				{
					$sql="select id from {$this->tblname[$jing]}";
					$this->db->query($sql);		
					$cnt = $this->db->recordCount();
				}
				$buffer .= '<b>共有'.$cnt.'卷</b><br />';

				for ($i=1;$i<=$cnt;$i++)
				{
					$rs = $this->db->getRow();
					$id=sprintf("第%d卷",$rs['id']);
					$buffer .= "<a href=\"/view/4/{$rs['id']}/".urlencode($keytext)."\" target=\"main\">{$id}</a>";
					$buffer .= "<br />";
				}
				break;
			case 2:
			case 3:
			case 5:
			case 6:
			case 7:
			case 8:
			case 9:
				if ($keytext!='')
				{
					$sql="select id,name from {$this->tblname[$jing]} where ".$this->joinkey($keytext)." order by id";
					$this->db->query($sql);		
					$cnt = $this->db->recordCount();
					$buffer .= '(<a href="?fojing='.$jing.'">返回</a>)<br />搜索<b>'.$keytext.'</b>的结果如下:<br />';
				}
				else
				{
					$sql="select id,name from {$this->tblname[$jing]} order by id";
					$this->db->query($sql);		
					$cnt = $this->db->recordCount();
				}

				$buffer .= '<b>共有'.$cnt.'经</b><br />';

				for ($i=1;$i<=$cnt;$i++)
				{
					$rs = $this->db->getRow();
					$id=sprintf("%0d",$rs['id']);
					$buffer .= "<a href=\"/view/{$jing}/{$rs['id']}/".urlencode($keytext)."\" target=\"main\">{$id}.{$rs['name']}</a>";
					$buffer .= "<br />";
				}
				break;
			case 10:
				$jc=$this->GetJielvClass();
				if ($keytext!='')
				{
					$sql="select jielv_title_id from jielv_content where ".$this->joinkey($keytext)." group by jielv_title_id";
					$this->db->query($sql);	
					$cnt = $this->db->recordCount();
					$buffer .= '(<a href="?fojing='.$jing.'">返回</a>)<br />搜索<b>'.$keytext.'</b>的结果如下:<br /><br />';
					$s="(";
					for ($i=0;$i<$cnt;$i++)
					{
						$rs=$this->db->getRow();
						$s.=$rs['jielv_title_id'];
						if ($i<$cnt-1) 
							$s.=',';
						else
							$s.=')';
					}
					$sql="SELECT * FROM jielv_title WHERE id IN $s";
					$this->db->query($sql);		
					$cnt = $this->db->recordCount();
				}
				else
				{
					$sql="select * from jielv_title";
					$this->db->query($sql);		
					$cnt = $this->db->recordCount();
				}

				$j=0;
				$n=count($jc);
				for ($iii=0;$iii<$n;$iii++)
				{
					if ($keytext=='') $buffer.="<br /><span class='classtitle'>【".$jc[$iii]['name'].'】</span><br />';
					$a=explode(',',str_replace(')','',str_replace('(','',$s)));
					for ($i=0;$i<$jc[$iii]['number'];$i++)
					{
						$j++;
						if ($keytext==''||array_search($j,$a)>-1)
						{
							$rs=$this->db->getRow();
	                        $buffer .='<a href="/view/' .$jing. "/" .$j ."/".urlencode($keytext)." \" title=\"". $rs['intro']."\" target=\"main\">" .$j.".". $rs['title']."</a><br />";
						}
					}
				}
                $buffer .= "<br />";
				break;
		}
		return $buffer;
	}

	function GetContent($jing,$id='',$keytext='') {
		$buffer = '';
		switch ($jing)
		{
			case 1:
				$sql="select * from za where id={$id}";
				$this->db->query($sql);		
				$rs = $this->db->getRow();
				$rs['title']="【杂阿含经】第{$id}经 (第{$rs['juan']}卷) ";
				break;
			case 4:
				$sql="select * from {$this->tblname[$jing]} where id={$id}";
				$this->db->query($sql);		
				$rs = $this->db->getRow();
				$rs['title']="【{$this->title[$jing]}】第{$id}卷 ";
				break;
			case 2:
			case 3:
			case 5:
			case 6:
			case 7:
			case 8:
			case 9:
				$sql="select * from {$this->tblname[$jing]} where id={$id}";
				$this->db->query($sql);		
				$rs = $this->db->getRow();
				$rs['title']="【{$this->title[$jing]}】第{$id}经 {$rs['name']} ";
				break;
			case 10:
				$sql="select * from jielv_title where id={$id}";
				$this->db->query($sql);		
				$rs = $this->db->getRow();
				$ds['title']="【{$this->title[$jing]}】{$id}.{$rs['title']} ";
				$ds['intro']=$rs['intro'];
				$sql="select * from jielv_content where jielv_title_id={$id} order by jielv_id";
				$this->db->query($sql);		
				$cnt=$this->db->recordCount();
				for ($i=0;$i<$cnt;$i++)
				{
					$rs = $this->db->getRow();
					$ds['content'.($rs['jielv_id']+1)]=$rs['content'];
					if (trim($keytext!=""))
						$ds['content'.($rs['jielv_id']+1)]=$this->SetKeyColor($rs['content'],$keytext);
				}
				return $ds;
				break;
		}
		if (trim($keytext!=""))
			$rs['content']=$this->SetKeyColor($rs['content'],$keytext);
		return $rs;
	}

	function GetXiangying($flag) {
		$xyarr=explode(',',$flag);
		$cnt=count($xyarr);
		$buffer='<br />';
		for ($i=0;$i<$cnt;$i++)
		{
			if (strstr($xyarr[$i],'cf.'))
			{
				$cf='【参考此文】<br />';
				$xyarr[$i]=str_replace('cf.','',$xyarr[$i]);
			}
			$xy=explode('.',str_replace('\r','',$xyarr[$i]));

			if ($this->flag[$xy[0]]!='')
			{
				if ($bufarr[$xy[0]][$xy[1]]=='')
				{
					$sql="select * from {$this->flag[$xy[0]]} where id={$xy[1]}";
					$this->db->query($sql);		
					$rs = $this->db->getRow();
					$bufarr[$xy[0]][$xy[1]]=$rs;
				}
				else
					$rs=$bufarr[$xy[0]][$xy[1]];
				
				$data=$this->GetIndex($rs);
				$pinlist=$data[0];
                $jielist=$data[1];
				$id=$xy[2];

				if (count($xy)>3)
				{
					$p1=$xy[2]-1;
					$s1=$pinlist[$p1];
					$p1=$xy[2]+0;
					if ($p1<count($pinlist))
						$s2=$pinlist[$p1];
					else
						$s2='';
					while ($s2=='' && $p1<count($pinlist))
					{
						$p1+=1;
						$s2=$pinlist[$p1];
					}
					if ($s2!='')
						$buf2 = $this->GetContent2($rs,$s1, $s2);
					else
						$buf2 = $this->GetContent2($rs,$s1 , "");
					preg_match("/\[(.+?)\]/",$buf2,$result);
					$id=$this->Number($result[1])+$xy[3]+0;
				}
				
				if (count($xy)>=3)
				{
					$p1=$id+0;
					$s1=$jielist[$p1];
					while ($s1=='')
					{
						$p1-=1;
						$s1=$jielist[$p1];
					}
					$p1=$id+1;
					if ($p1<count($jielist))
						$s2=$jielist[$p1];
					else
						$s2='';
					while ($s2=='' && $p1<count($jielist))
					{
						$p1+=1;
						$s2=$jielist[$p1];
					}
					if ($s2!='')
						$content = $this->GetContent2($rs,$s1, $s2);
					else
						$content = $this->GetContent2($rs,$s1 , "");
				}
			}
			else
			{
				$content=$xyarr[$i];
			}
			$buffer.="$cf".$content."<hr />";
		}
		return($buffer);
	}

	function GetJielvClass()
	{
		$sql="select * from jielv_class";
		$this->db->query($sql);		
		$cnt = $this->db->recordCount();
		for ($i=0;$i<$cnt;$i++)
		{
			$rs=$this->db->getRow();
			$buffer[$i]['id']=$rs['id'];
			$buffer[$i]['name']=$rs['name'];
			$buffer[$i]['number']=$rs['number'];
		}
		return($buffer);
	}
}

?>