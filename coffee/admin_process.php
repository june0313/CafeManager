<?php
	include "db_conn.php";

	//��й�ȣ�� ��ġ�ϴ� ���� ã�´�.
	$query = "SELECT count(*) FROM admin WHERE password ='$_POST[password]'";
	$result = mysql_query($query, $link);
    $row = mysql_fetch_array($result);


	 //�˻� ����� 1�̸� ���������� �α���
	if( $row[0] == 1 )
	{
		?>
	   	<script>
		location.href="admin.php?work=list&cat=esp";
		</script>
		<?
	}
	//�α��� ����
	else
	{
?>
		<script>
			alert("������ ��й�ȣ�� ��ġ���� �ʽ��ϴ�.");
			history.back();
		</script>
<?php
	}
?>