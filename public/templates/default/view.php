<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="阿含经在线阅读，可以在线阅读北传的杂阿含经，中阿含经，长阿含经，增一阿含经，南传的相应部，中部，长部，增支部，小部，阿含经的白话文，以及南北经文对照" />
<meta name="keywords" content="阿含经在线阅读,杂阿含经,中阿含经,长阿含经,增一阿含经,南传相应部,南传中部,南传长部,南传增支部,南传小部,白话文,南北经文对照" />
<title><?=$main; ?></title>
<style>
#menu {
	margin: 0px;
	height: 22px;
}
#menu ul {
	margin: 0px;
	padding-left: 20px;
}
#menu li {
	float: left;
	background-repeat: no-repeat;
	background-position: left center;
	padding: 0px 8px;
	list-style-type: none;
}
#menu a{
	color: blue;
	text-decoration: none;
	padding: 0px 4px;
	border-bottom: #485f5f 1px dotted;
}
#menu a:hover{
	color: red;
	border-bottom: #c30 1px solid;
}
#menu a:visited{
	color: blue;
}
body {
	background-color: F5F5F5;
    font-family: 黑体;
	font-size: 20px;
}
.bbs {
    font-family: 宋体;
    font-size: 14px;
    line-height :18px;
}

</style>

</HEAD>
<BODY>
<h2><?=$title; ?></h1>
<hr />

<DIV id="menu">
	<ul>
		<li><a href="#" onclick="javascript:view('1');">原文</a></li>
<?php if ($baihua=='ok') : ?>
		<li><a href="#" onclick="javascript:view('2');">白话文</a></li>
<?php endif; ?>
<?php if ($xiangying=="ok") : ?>
		<li><a href="#" onclick="javascript:view('3');">对应的南传经文</a></li>
<?php endif; ?>
<?php if ($zhuang=="ok") : ?>
		<li><a href="http://agama.buddhason.org/<?=$zhuangurl; ?>" target="_blank">庄春江译文</a></li>
<?php endif; ?>
	</ul>
</div>
<br />
<DIV id="main1">
<?=$main1; ?>
</DIV>
<DIV id="main2" style="display:none">
<?=$main2; ?>
</div>
<DIV id="main3" style="display:none">
<?=$main3; ?>
<p>
注：S:相应部 ; D:长部 ; M:中部 ; A:增支部 ; Sn:小部，经集 ; Cv:律藏小品 ; J:小部，本 生经 ; Thag:小部，长老偈经 ; Thig:小部，长老尼偈经 ; Ud:小部，自说经 ; Dhp:小部，法句经 ; It:如是语经 ; cf:参考类似经文 
</p>
</DIV>

<div style="display:none">
    <a href="/list?fojing=1">杂阿含经</a>
    <a href="/list?fojing=2">中阿含经</a>
    <a href="/list?fojing=3">长阿含经</a>
    <a href="/list?fojing=4">增一阿含经</a>
    <a href="/list?fojing=5">南传相应部</a>
    <a href="/list?fojing=6">南传中部</a>
    <a href="/list?fojing=7">南传长部</a>
    <a href="/list?fojing=8">南传增支部</a>
    <a href="/list?fojing=9">南传小部</a>
<?=$tj; ?>
</div>
<DIV id=footer>
</DIV>

</BODY>
<SCRIPT LANGUAGE="JavaScript">
function view(i)
{
	
	for (j=1;j<4 ;j++ )
	{
		main=eval("main"+j);
		if (i==j)
			main.style.display='';
		else
			main.style.display='none';
	}
}
</SCRIPT>
</HTML>
