<?php
	include "db_conn.php";
	
	// �Է����� ���� �׸��� �ִ��� Ȯ���Ѵ�.
	if ($_POST[name] == null || $_POST[price] == null)
	{
?>
		<script>
		alert("��� �׸��� �������� �Է����ּ���.");
		history.back();
		</script>
<?php
	}
	
	$query = "SELECT count(*) FROM goods WHERE name = '$_POST[name]' && del=1";
	$result = mysql_query($query, $link) or die("DB���� Ȥ�� ������ �����Ͽ����ϴ�.??".mysql_error());
	$row = mysql_fetch_array($result);

	if( $row[0] == 1)
	{
?>
	<script>
	alert("�ߺ��� ��ǰ�� �ֽ��ϴ�.");
	history.back();
	</script>
<?php
	}

	elseif(!preg_match("/[0-9]/", $_REQUEST[price]))
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
		$query = "INSERT INTO goods(name,price,type,del)";
		$query .= "VALUES ('$_POST[name]',$_POST[price],'$_POST[type]',1)";
		$result = mysql_query($query,$link);
?>

		<script>
		alert("��ǰ����� �Ϸ�Ǿ����ϴ�.");
		location.href="admin.php?work=list&cat=<?=$_POST[type]?>";
		</script>
<?php
	}
?>

