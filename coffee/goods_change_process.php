<?php
	include "db_conn.php";
	
	// �Է����� ���� �׸��� �ִ��� Ȯ���Ѵ�.
	if ($_POST[name]==null||$_POST[price] == null)
	{
?>
		<script>
		alert("��� �׸��� �������� �Է����ּ���.");
		history.back();
		</script>
<?php
	}
	
	if(!preg_match("/[0-9]/", $_REQUEST[price]))
	{
		?>
		<script>
		alert("���ݶ����� ���ڸ� �Է°����մϴ�.");
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
	alert("��ǰ������ �Ϸ�Ǿ����ϴ�.");
	location.href="admin.php?work=change2&goods_num=<?=$_GET[goods_num]?>";
	</script>
<?php
	}
?>

