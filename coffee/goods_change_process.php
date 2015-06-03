<?php
	include "db_conn.php";
	
	// 입력하지 않은 항목이 있는지 확인한다.
	if ($_POST[name]==null||$_POST[price] == null)
	{
?>
		<script>
		alert("모든 항목을 빠짐없이 입력해주세요.");
		history.back();
		</script>
<?php
	}
	
	if(!preg_match("/[0-9]/", $_REQUEST[price]))
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
	
	$query = "UPDATE goods";
	$query .= " SET price = '$_POST[price]', name = '$_POST[name]', type = '$_POST[type]' WHERE goods_num='$_GET[goods_num]'";
	$result = mysql_query($query,$link);
?>

	<script>
	alert("상품수정이 완료되었습니다.");
	location.href="admin.php?work=change2&goods_num=<?=$_GET[goods_num]?>";
	</script>
<?php
	}
?>

