<?php
require_once('./libs/config.php');
require_once('./libs/dbclass.php'); 

$jing=empty($_COOKIE['jing'])?8:$_COOKIE['jing'];
$id=empty($_COOKIE['id'])?"":$_COOKIE['id'];
$main=empty($_COOKIE['fojing'])?'/about/':"/view/{$_COOKIE['fojing']}/$id/";
$fojing=empty($_COOKIE['fojing'])?8:$_COOKIE['fojing'];
include("templates/{$style}/index.php"); 

?>
