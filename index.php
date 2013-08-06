<?php 
	//连接数据库
	require_once 'conn.php';
	//start session
	session_start();
	//获取GET参数
 	isset($_GET['kw'])?$kw=$_GET['kw']:$kw=null;
	$kw = str_replace('"', '&quot;', $kw);
	$kw = str_replace('<', '&lt;', $kw);
	$kw = str_replace('>', '&gt;', $kw);
	isset($_GET['catid'])?$catid=$_GET['catid']:$catid=null;
	isset($_GET['wc'])?$wc=$_GET['wc']:$wc=null;
	
	$sql = "select * from pictoword_cate";
	$cate = mysql_query($sql);
	$sql = "select * from pictoword order by id desc";
	$data = mysql_query($sql);
	
	
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="static/reset.css" />
<link rel="stylesheet" type="text/css" media="all" href="static/text.css" />
<link rel="stylesheet" type="text/css" media="all" href="static/960.css" />
<link rel="stylesheet" type="text/css" media="all" href="static/demo.css" />
<link rel="stylesheet" type="text/css" media="all" href="static/base.css" />
<link href="static/jquery.lightbox-0.5.css" rel="stylesheet" />
<script language="javascript" type="text/javascript" src="static/jquery.js"></script>
<script language="javascript" type="text/javascript" src="static/jquery.lightbox-0.5.js"></script>
<script language="javascript" src="lib/kindeditor/kindeditor.js"></script>
<script language="javascript" src="lib/kindeditor/lang/zh_CN.js"></script>

<title>疯狂猜图 答案查询 答案大全</title>
</head>

<body>
	<div class="container_12">
		<!--head-->
		<div class="grid_12 header">
			<div class="header_inner">
				<div class="header_logo"><img src="static\pictoword.png" alt="疯狂猜图 答案查询" /></div>
				<div class="header_text">
					<h1 id="page_title">疯狂猜图 答案查询</h1>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		
		<!--location-->
		<div class="grid_12">
			<div class="location">
				<span>当前位置：<span><a href="index.php">首页</a> >> 
				<form method="get" action="index.php">
					<input type="text" name="kw" placeholder="输入关键字搜索" value="<?php echo $kw?>"/><input type="submit" value="搜索"/>
				</form>
			</div>
		</div>
		<div class="clear"></div>
		<!--search -->
		<div class="grid_12 search">
			<table>
				<tr><td>按分类查找：</td>
				<td class="searchlist"><ul>
					<?php
					while($cateArr = mysql_fetch_assoc($cate))
					{
						echo "<li><a href=index.php?catid=$cateArr[id]>".$cateArr['name']."</a></li>\n";
					}
					?></ul>
				</td></tr>
				<tr><td>按字数查找：</td>
				<td class="searchlist"><ul>
					<li><a href="index.php?wc=2">2个字</a></li>
					<li><a href="index.php?wc=3">3个字</a></li>
					<li><a href="index.php?wc=4">4个字</a></li>
					<li><a href="index.php?wc=5">5个字</a></li>
					<li><a href="index.php?wc=6">6个字</a></li>
					<li><a href="index.php?wc=7">7个字</a></li>
					<li><a href="index.php?wc=8">8个字</a></li>
				</td></tr>
				
			</table>
		</div> 
		<div class="clear"></div>
		<div class="grid_12 piclist">
			<ul>
				<?php
					while($dataArr = mysql_fetch_assoc($data))
					{
						echo "<li><a href=\"detail.php?id=$dataArr[id]\"><img style=\"width:80px;height:80px;\"   src=\"$dataArr[pic_url]\" alt=\"\" /></a><span>$dataArr[answer]</span></li>\n";
					}
				?>
			</ul>
		</div>
		<div class="clear"></div>
		<!--pageNav-->
		<div class="grid_12 pagenav">
			<div>
				<span>上一页</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>下一页</span>
			</div>
		</div>
		<div class="clear"></div>
		<!--footer-->
		<div class="grid_12 footer">
			<div>
				<span>©2013 <a href="http://hahaku.net">哈哈库</a><span>
				<span>关键字：疯狂猜图 答案查询 答案大全</span>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<script language="javascript" type="text/javascript">

</script>
</body>
</html>