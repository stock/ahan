<html>

<head>
<title><?=$title; ?> - 阿含经在线阅读</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="阿含经在线阅读，可以在线阅读北传的杂阿含经，中阿含经，长阿含经，增一阿含经，南传的相应部，中部，长部，增支部，小部，阿含经的白话文，以及南北经文对照" />
<meta name="keywords" content="阿含经在线阅读,杂阿含经,中阿含经,长阿含经,增一阿含经,南传相应部,南传中部,南传长部,南传增支部,南传小部,白话文,南北经文对照" />
</head>
<style type="text/css">
<!--
body {
	background-color: D0DCE0;
	font-size: 12px;
    overflow-x: hidden;
	line-height:16px;
    white-space : nowrap;
	margin-left:  5px;
}
.classtitle {
	font-size: 14px;
	color:blue;
}
a {
    text-decoration: none;
	color: 005580;
}
a:hover {
    font-size: 14px;
    color:red;
    text-overflow : ellipsis ;
    white-space : nowrap;
}
a:visited { 
	color: blue; 
	} 
-->
</style>
<body>
<form name="fj" method="GET" action="">
<p><select name="fojing" size="1" onchange="fj.submit()">
<option value="1" <?=$selectflag1; ?>>1.杂阿含经</option>
<option value="2" <?=$selectflag2; ?>>2.中阿含经</option>
<option value="3" <?=$selectflag3; ?>>3.长阿含经</option>
<option value="4" <?=$selectflag4; ?>>4.增一阿含经</option>
<option value="5" <?=$selectflag5; ?>>5.南传相应部</option>
<option value="6" <?=$selectflag6; ?>>6.南传中部</option>
<option value="7" <?=$selectflag7; ?>>7.南传长部</option>
<option value="8" <?=$selectflag8; ?>>8.南传增支部</option>
<option value="9" <?=$selectflag9; ?>>9.南传小部</option>
<option value="10" <?=$selectflag10; ?>>10.比丘戒律</option>
  </select></p>
<INPUT TYPE=text VALUE="" NAME="keytext" SIZE=10 />
<INPUT TYPE=SUBMIT value="搜索" /><br />多个关键字用空格隔开。
</form>
<div class="mlist">
<?=$list; ?>
</div>
	<hr />
    <a href="/aboutahan/" target="main">阿含经简介</a><br />
    <hr />
    <a href="/list/?fojing=1">杂阿含经</a><br />
    <a href="/list/?fojing=2">中阿含经</a><br />
    <a href="/list/?fojing=3">长阿含经</a><br />
    <a href="/list/?fojing=4">增一阿含经</a><br />
    <a href="/list/?fojing=5">南传相应部</a><br />
    <a href="/list/?fojing=6">南传中部</a><br />
    <a href="/list/?fojing=7">南传长部</a><br />
    <a href="/list/?fojing=8">南传增支部</a><br />
    <a href="/list/?fojing=9">南传小部</a><br />
    <hr />
    <a href="/list/?fojing=10">比丘戒律</a><br />
    <hr />
    <a href="/about/" target="main">关于本站</a><br />
<?=$tj; ?>
</body>
</html>
