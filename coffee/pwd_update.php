<?php
	include "db_conn.php";

	//입력된 비밀번호가 맞고, 변경 비밀번호와, 확인이 맞는지 비교한다.
	$query = "SELECT * FROM admin";
	$result = mysql_query($query, $link) or die("DB접속 혹은 쿼리에 실패하였습니다.".mysql_error());
	$row = mysql_fetch_array($result);

	if($_POST[password]!=$row['password'])
	{
		?>
		<script>
			alert("기존 비밀번호가 일치하지 않습니다.");
			history.back();
		</script>

<?
	}


	elseif( $_POST[password_change]!=$_POST[passwordCheck])
	{
?>
	<script>
	alert("변경된 비밀번호가 일치하지 않습니다.");
	history.back();
	</script>

<?php
	}
	else
	{
	// customer 테이블의 내용을 변경한다.
	$query = "UPDATE admin";
	$query .= " SET password = '$_POST[password_change]'";
	$result = mysql_query($query,$link) or die("DB접속 혹은 쿼리에 실패하였습니다.?".mysql_error());

?>

	<script>
	alert("관리자 비밀번호 수정이 완료되었습니다.");
	location.href="admin.php?work=list&cat=esp";
	</script>
<?php
	}
?>

