<?php
require_once('./libs/ahan.php');

if (empty($_GET['fojing']))
	$id=1;
else
	$id=$_GET['fojing'];

if (!empty($_GET['keytext']))
	$keytext=$_GET['keytext'];
else
	$keytext="";
$title='';
setcookie("jing",$id,time()+88888888,"/","");
for ($i=1;$i<=10;$i++)
{
	$sss='selectflag'.$i;
	if ($i==$id)
		$$sss= 'selected';
	else
		$$sss='';
}

$ahan=new Ahan();

$list=$ahan->GetDir($id,$keytext);
include("templates/{$style}/list.php"); 
?>