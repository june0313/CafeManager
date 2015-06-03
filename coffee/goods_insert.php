<?php
	include "db_conn.php";
	
	// 입력하지 않은 항목이 있는지 확인한다.
	if ($_POST[name] == null || $_POST[price] == null)
	{
?>
		<script>
		alert("모든 항목을 빠짐없이 입력해주세요.");
		history.back();
		</script>
<?php
	}
	
	$query = "SELECT count(*) FROM goods WHERE name = '$_POST[name]' && del=1";
	$result = mysql_query($query, $link) or die("DB접속 혹은 쿼리에 실패하였습니다.??".mysql_error());
	$row = mysql_fetch_array($result);

	if( $row[0] == 1)
	{
?>
	<script>
	alert("중복된 상품이 있습니다.");
	history.back();
	</script>
<?php
	}

	elseif(!preg_match("/[0-9]/", $_REQUEST[price]))
	{
		?>
		<script>
		alert("가격란에는 숫자만 입력가능합니다.");
		history.back();
		</script>
		<?
	}
	else
	{
		$query = "INSERT INTO goods(name,price,type,del)";
		$query .= "VALUES ('$_POST[name]',$_POST[price],'$_POST[type]',1)";
		$result = mysql_query($query,$link);
?>

		<script>
		alert("상품등록이 완료되었습니다.");
		location.href="admin.php?work=list&cat=<?=$_POST[type]?>";
		</script>
<?php
	}
?>

