<?php
	// 데이터베이스 연결
	$link = mysql_connect("localhost","root","apmsetup") or die("DB서버 연결에 실패했습니다.");
	mysql_select_db("coffeesale",$link);
?>