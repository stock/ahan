<?php
/**
 *DBClass以pdo为底层的数据库类，只做了几个常用的功能
 *版本：1.0   这个专门用来sqlite3
 */
if (!$dbcharset) $dbcharset="utf8";		//数据库字符编码
if (!$dbtype) $dbtype="mysql";			//当前使用的数据库类型
if (!$debug) 
	error_reporting(0);					//0:关闭错误警告提示 -1:打开所有错误提示
else
	error_reporting(-1);
class DBClass { 
	function __construct($host,$user,$pass,$db) 
	{ 
		global $dbcharset,$dbtype,$debug;
		$cnt=count($host);
		for ($i=0;$i<$cnt;$i++)
		{
			switch ($dbtype) 
			{
				case 'mysql':
					$dsn = "mysql:host={$host[$i]};dbname={$db[$i]}";
					break;
				case 'sqlite':
					$dsn = "sqlite:{$db[$i]}";  //sqlite:/opt/databases/mydb.sq3
					break;
			}

			$options = array(
				); 

			try 
			{
				$this->db = new PDO($dsn, $user[$i], $pass[$i], $options);
				break;
			}
			catch (PDOException $e) 
			{
				if ($i==$cnt-1)	
				{
					echo "<B>Unable to connect database !</B> ";
					if ($debug) echo("[ {$e->getMessage()} ]"); 
					die("\n\n<br><br>Game over!<br><br>");
				}
			}
			unset($this->db);
		}
	} 

	function __destruct() 
	{
		unset($this->db);
	}

	/**
	 *方法:query
	 *功能:执行sql命令，包括select,update....
	 */
	function query($sql) 
	{ 
		if (strtoupper(substr(trim($sql),0,6))=="SELECT"
			||strtoupper(substr(trim($sql),0,4))=="SHOW"
			||strtoupper(substr(trim($sql),0,4))=="DESC") 
		{
			$this->query=$this->db->query($sql);
			$this->data=$this->query->fetchAll();
			$this->rowCount=count($this->data);
			$this->i=0;
		}
		else
			return $db->exec($sql);
	} 
	/**
	 *功能：取当前查询的一行结果
	 */
	function getRow() 
	{ 
		if ( $this->i<$this->rowCount) 
		{	
			$row=$this->data[$this->i];
			$this->i++;
			return $row; 
		}
		else 
			return false; 
	} 
	/**
	 *功能：取当前查询结果数量
	 */
	function recordCount()
	{
		$cnt=$this->rowCount;
		return $cnt;
	}
	/**
	 *功能：返回版本号
	 */
	function version() 
	{
		return "1.0";
	}
	/**
	 *此功能兼容以前版本，新版未用
	 */
	function GetHostId()
	{
		return "";
	}

} 
?>