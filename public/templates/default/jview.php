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
	padding-left: 15px;
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
.intro {
    font-family: 宋体;
	font-size:14px;
    line-height :16px;
}
</style>

</HEAD>
<BODY>
<span><?=$title; ?></span><br />
<span class='intro'><br />简介：<?=$intro; ?></span><br />
<hr />

<DIV id="menu">
	<ul>
		<li><a href="#" onclick="javascript:view('1');">南传巴利律</a></li>
		<li><a href="#" onclick="javascript:view('2');">根本说一切有部毗奈耶</a></li>
		<li>摩诃僧祇律</li>
		<li>十诵律</li>
		<li>四分律</li>
		<li><a href="#" onclick="javascript:view('6');">五分律</a></li>
	</ul>
</div>
<br />
<DIV id="main1">
<?=$main1; ?>
</DIV>
<DIV id="main2" style="display:none">
<?=$main2; ?>
</DIV>
<DIV id="main3" style="display:none">
<?=$main3; ?>
</DIV>
<DIV id="main4" style="display:none">
<?=$main4; ?>
</DIV>
<DIV id="main5" style="display:none">
<?=$main5; ?>
</DIV>
<DIV id="main6" style="display:none">
<?=$main6; ?>
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
	
	for (j=1;j<7 ;j++ )
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
