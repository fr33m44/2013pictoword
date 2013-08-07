<?php
	//database
	mysql_connect("localhost", "root", "") or
		die("Could not connect: " . mysql_error());
	mysql_select_db("test");
	mysql_query("set names utf8");
	
	
	//define
	define('MB_ENCODING', 'UTF-8');