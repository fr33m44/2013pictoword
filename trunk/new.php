<?php 
	//连接数据库
	require_once 'conn.php';
	//start session
	session_start();
	if(isset($_POST['answer']))
	{
		$answer 		= $_POST['answer'];
		$pic_url		= $_POST['pic_url'];
		$cate_id	= $_POST['cate_id'];
		$description	= $_POST['description'];
		$intro	= $_POST['intro'];
		$result = mysql_query("insert into pictoword(answer, pic_url, cate_id, description, intro) value('$answer','$pic_url', $cate_id, '$description', '$intro') ");
		echo "<script>alert($result)</script>";
		if($result)
		{
			//header('location:new.php');
		}
	}
	//view page
	$sql = "select * from pictoword_cate";
	$cate = mysql_query($sql);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="static/base.css" rel="stylesheet" />
<link href="static/jquery.lightbox-0.5.css" rel="stylesheet" />
<script language="javascript" type="text/javascript" src="static/jquery.js"></script>
<script language="javascript" type="text/javascript" src="static/jquery.lightbox-0.5.js"></script>
<script language="javascript" src="lib/kindeditor/kindeditor.js"></script>
<script language="javascript" src="lib/kindeditor/lang/zh_CN.js"></script>
<script>
	KindEditor.ready(function(K) {
		var editor1 = K.create('textarea[name="intro"]', {
			allowFileManager : false
		});
	});
</script>
<title>疯狂猜图 答案录入</title>
</head>

<body>
<div id="wrapper">
		
	<form name="form1" id="form1" action="new.php" method="post">
	<div id="pic_url">
			<h2>pic url:<input type="text" name="pic_url" size="80" style="padding:3px 8px"/></h2>
	</div>
	<div id="answer">
			<h2>answer:<input type="text" name="answer" size="80" style="padding:3px 8px"/></h2>
	</div>
	<div id="description">
			<h2>description:<input type="text" name="description" size="80" style="padding:3px 8px"/></h2>
	</div>
	<div id="cate_id">
			<h2>cate id:</h2>
			<?php
				while($cateArr = mysql_fetch_assoc($cate))
				{
			?>
			<input type="radio" id="cate_id<?php echo $cateArr['id']?>" name="cate_id" value="<?php echo $cateArr['id']?>"/>
			<label for="cate_id<?php echo $cateArr['id']?>"><?php echo $cateArr['name'];?></label>
			<?php }?>
	</div>
	<div id="panel">
		<span class="save"><input type="submit" value="保存" /></span>	
	</div>
	<div id="intro">
			<h2>intro</h2><textarea name="intro" id="intro" style="width:600px;height:400px;"></textarea>
	</div>
	</form> 
	
	<div id="footer">copyright&copy 2010  <a href="http://tunps.com">tunpishuang</a>. All rights reserved.</div>
</div>
</body>
</html>
