<?php header("content-Type: text/html; charset=utf-8"); ?>
<?php
$dbi=0;
$debug=0;
$dbcharset='utf8';
$dbtype="sqlite";

$dbhost[$dbi]=""; 
$dbuser[$dbi]="";  
$dbpass[$dbi]="";  
$dbname[$dbi]=$_SERVER["DOCUMENT_ROOT"]."/libs/ahan.sq3"; 
$dbi++;

$style="default";

$tj='<div style="display:none"><script language="javascript" type="text/javascript" src="http://js.users.51.la/3658617.js"></script><noscript><a href="http://www.51.la/?3658617" target="_blank"><img alt="&#x6211;&#x8981;&#x5566;&#x514D;&#x8D39;&#x7EDF;&#x8BA1;" src="http://img.users.51.la/3658617.asp" style="border:none" /></a></noscript></div>';
$tj='';
?>