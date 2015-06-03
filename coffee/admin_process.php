<?php
	include "db_conn.php";

	//비밀번호가 일치하는 열을 찾는다.
	$query = "SELECT count(*) FROM admin WHERE password ='$_POST[password]'";
	$result = mysql_query($query, $link);
    $row = mysql_fetch_array($result);


	 //검색 결과가 1이면 성공적으로 로그인
	if( $row[0] == 1 )
	{
		?>
	   	<script>
		location.href="admin.php?work=list&cat=esp";
		</script>
		<?
	}
	//로그인 실패
	else
	{
?>
		<script>
			alert("관리자 비밀번호가 일치하지 않습니다.");
			history.back();
		</script>
<?php
	}
?>