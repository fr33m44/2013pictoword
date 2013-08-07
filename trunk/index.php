<?php 
function uri($catid, $wc, $kw)
{
	return "index.php?catid=$catid&wc=$wc&kw=$kw";
}
	//连接数据库
	require_once 'conn.php';
	//start session
	session_start();
	//获取GET参数
 	isset($_GET['kw'])?$kw=$_GET['kw']:$kw=null;
	$kw = str_replace('"', '&quot;', $kw);
	$kw = str_replace('<', '&lt;', $kw);
	$kw = str_replace('>', '&gt;', $kw);
	if(isset($_GET['catid']))
	{
		$catid=(int)($_GET['catid']);
		if(null==$catid);
	}
	else
	{
		$catid=null;
	}
	if(isset($_GET['wc']))
	{
		$wc=(int)($_GET['wc']);
		if(null==$wc);
	}
	else
	{
		$wc=null;
	}
	
	$sql = "select * from pictoword_cate";
	$cate = mysql_query($sql);
	
	$sql = "select * from pictoword";
	if(null!=$wc || null!=$catid || null!=$kw)
		$sql.=" where ";
	if(null!=$wc)
		$sql.=" CHAR_LENGTH(answer)=$wc and";
	if(null!=$catid)
		$sql.=" cate_id=$catid and";
	if(null!=$kw)
	{
		$kw = addslashes($kw);
		$sql.= " (answer like '%$kw%' or description like '%$kw%' or intro like '%$kw%') and";
		$kw = stripslashes($kw);
	}
	if(null!=$wc || null!=$catid || null!=$kw)
		$sql.=" 1=1 order by id desc";
	else
		$sql.=" order by id desc";
	echo $sql;
	$data = mysql_query($sql);
	
	$query =$_SERVER["QUERY_STRING"];
	parse_str($query);
	
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
<link rel="stylesheet" type="text/css" media="all" href="static/jquery.lightbox-0.5.css"/>
<script language="javascript" type="text/javascript" src="static/jquery.js"></script>
<script language="javascript" type="text/javascript" src="static/jquery.lightbox-0.5.js"></script>
<script language="javascript" type="text/javascript" src="lib/kindeditor/kindeditor.js"></script>
<script language="javascript" type="text/javascript" src="lib/kindeditor/lang/zh_CN.js"></script>

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
					<input type="hidden" name="catid" value="<?php echo $catid ?>" />
					<input type="hidden" name="wc" value="<?php echo $wc ?>" />
					<input type="text" name="kw" placeholder="输入关键字搜索" value="<?php echo $kw?>"/><input type="submit" value="搜索"/>
					<a href="<?php echo uri($catid, $wc, '') ?>">重置关键字</a> | <a href="<?php echo uri('', '', '') ?>">清空所有搜索条件</a>
				</form>
			</div>
		</div>
		<div class="clear"></div>
		<!--search -->
		<div class="grid_12 search">
			<table>
				<tr><td>按分类查找：</td>
				<td class="searchlist"><ul>
					<li<?php if($catid == ''){ echo ' class="selected"' ?>>全部</li>
					<?php } else { ?>
						<li><a href="<?php echo uri('', $wc, $kw) ?>">全部</a></li>
					<?php } ?>		
					<?php
					while($cateArr = mysql_fetch_assoc($cate))
					{
						if($catid == $cateArr['id'])
							echo "<li class=\"selected\">$cateArr[name]</li>\n";
						else
							echo "<li><a href=".uri($cateArr['id'], $wc, $kw).">".$cateArr['name']."</a></li>\n";
					}
					?></ul>
				</td></tr>
				<tr><td>按字数查找：</td>
				<td class="searchlist"><ul>
					<li <?php if($wc=='') { echo ' class="selected"' ?>>全部</li>
					<?php } else { ?>
						<li><a href="<?php echo uri($catid, '', $kw) ?>">全部</a></li>
					<?php } ?>
					<?php for($i=2;$i<=8;$i++){ ?>
					<li <?php if($i==$wc) { echo ' class="selected"'; ?>><?php echo $i; ?>个字</li>
					<?php } else { ?>
						<li><a href="<?php echo uri($catid, $i, $kw); ?>"><?php echo $i; ?>个字</a></li>
					<?php }} ?>
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