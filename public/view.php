<?php
require_once('./libs/ahan.php');

if ($_GET['fojing']=='')
	$jing=1;
else
	$jing=$_GET['fojing'];

if ($_GET['id']=='')
	$id=1;
else
	$id=$_GET['id'];

if (!empty($_GET['keytext']))
	$keytext=$_GET['keytext'];
else
	$keytext="";

setcookie("fojing",$jing,time()+88888888,"/","");
setcookie("id",$id,time()+88888888,"/","");

$ahan=new Ahan();
$rs=$ahan->GetContent($jing,$id,$keytext);
if ($jing==10)
{
	$title=$rs['title'];
	$main=$rs['title'];
	$intro=$rs['intro'];
	for ($i=1;$i<7;$i++)
	{
		$sss='main'.$i;
		$$sss= nl2br($rs["content$i"]);
	}
	include("./templates/{$style}/jview.php"); 

}
else
{
	$title=$rs['title'];
	$main=$rs['title'];
	$main1=nl2br($rs['content']);
	if (!empty($rs['baihua']))
	{
		$baihua='ok';
		$main2=nl2br($rs['baihua']);
	}
	else
		$baihua="";

	if (!empty($rs['xiangying']))
	{
		$xiangying='ok';
		$main3=nl2br($ahan->GetXiangying($rs['xiangying']));
	}
	else
		$xiangying="";
	
	if (!empty($rs['zhuang']))
	{
		$zhuang='ok';
		$zhuangurl=$rs['zhuang'];
	}
	else
		$zhuang="";


	include("./templates/{$style}/view.php"); 
}
?>