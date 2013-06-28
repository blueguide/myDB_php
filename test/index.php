<?php
	include 'myDB/mysql.class.php';
	
	$myDb=new DB_mysql("localhost", "root", "", "blogs");//连接数据库
	
	/**
	 * 以数组形式输出结果
	 */
	$myDb->setDbFormat("ARRAY");//设置查询返回值得类型 可选  ARRAY 或者 JSON
	$result=$myDb->select("user", "");//执行查询，返回查询结果数组
	print_r($result);//打印数组
	
	echo "<br /><hr /><br />";
	
	/**
	 * 以JSON形式输出结果
	 */
	$myDb->setDbFormat("JSON");
	$result=$myDb->select("user", "");//执行查询，返回查询结果数组
	print_r($result);//打印数组

	
	$myDb->close();