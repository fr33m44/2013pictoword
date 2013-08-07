<?php 
	//连接数据库
	require_once 'conn.php';
	//start session
	session_start();
	//query data
	$id = (int)$_GET['id'];
	if(0 == $id)
	{
		exit;
	}
	$sql = sprintf("select * from pictoword where id=%d", $id);
	$res = mysql_query($sql);
	$data = mysql_fetch_assoc($res);
	
	$sql = sprintf("select * from pictoword_cate where id=%d ", $data['cate_id']);
	$res = mysql_query($sql);
	$data_cate = mysql_fetch_assoc($res);
	
	
	
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

<title><?php echo $data['description'].' '.$data_cate['name'].' '. mb_strlen($data['answer'], MB_ENCODING)."个字"?> 疯狂猜图 答案查询 答案大全</title>
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
			<div class="location">当前位置：<a href="index.php">首页</a> >> <a href="detail.php?id=<?php echo $id?>"><?php echo $data['answer']?></a></div>
		</div>
		<div class="clear"></div>
		
		<div class="grid_12 pic_detail">
			<div class="pic_detail_inner">
				<img src="<?php echo $data['pic_url']?>" alt="<?php echo $data['answer']?>" title="<?php echo $data['answer']?>"  />
			</div>
			<div class="answer">
				<ul>
				<?php 
					$len = mb_strlen($data['answer'], MB_ENCODING);
					
					for($i=0;$i<$len;$i++)
					{
						echo '<li>'. mb_substr($data['answer'], $i, 1, MB_ENCODING) . '</li>';
					}
				?>
				</ul>
			</div>
			<div class="description">
				<?php echo $data['intro']?>
			</div>
		</div>
		<div class="clear"></div>
		<!--footer-->
		<div class="grid_12 footer">
			<div>
				<span>关键字：<?php echo $data['description'].' '.$data_cate['name'].' '. mb_strlen($data['answer'], MB_ENCODING)."个字"?> 疯狂猜图 答案查询 答案大全</span>
			</div>
			<div class="copyright">
				<span>©2013 <a href="http://hahaku.net">哈哈库</a><span>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
</body>
</html>