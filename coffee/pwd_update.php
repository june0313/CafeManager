<?php
	include "db_conn.php";

	//�Էµ� ��й�ȣ�� �°�, ���� ��й�ȣ��, Ȯ���� �´��� ���Ѵ�.
	$query = "SELECT * FROM admin";
	$result = mysql_query($query, $link) or die("DB���� Ȥ�� ������ �����Ͽ����ϴ�.".mysql_error());
	$row = mysql_fetch_array($result);

	if($_POST[password]!=$row['password'])
	{
		?>
		<script>
			alert("���� ��й�ȣ�� ��ġ���� �ʽ��ϴ�.");
			history.back();
		</script>

<?
	}


	elseif( $_POST[password_change]!=$_POST[passwordCheck])
	{
?>
	<script>
	alert("����� ��й�ȣ�� ��ġ���� �ʽ��ϴ�.");
	history.back();
	</script>

<?php
	}
	else
	{
	// customer ���̺��� ������ �����Ѵ�.
	$query = "UPDATE admin";
	$query .= " SET password = '$_POST[password_change]'";
	$result = mysql_query($query,$link) or die("DB���� Ȥ�� ������ �����Ͽ����ϴ�.?".mysql_error());

?>

	<script>
	alert("������ ��й�ȣ ������ �Ϸ�Ǿ����ϴ�.");
	location.href="admin.php?work=list&cat=esp";
	</script>
<?php
	}
?>

