<?php
include "db_conn.php";

//�ֹ� ���̺� ����� �ֹ���ȣ�� ������������ �����´�.(���� �߰��Ҷ��� �� ���� +1)
$query = "SELECT order_num FROM order_table ORDER BY order_num desc ";
$result = mysql_query($query, $link);
$row = mysql_fetch_array($result);

// �ֹ���ȣ ����
if($row[0]==NULL)
{
	$order_num = 1;
}
else
{
	$order_num = $row[0]+1;
}

// �������� ����
if($_POST[how_pay] == 1) $how_pay = "cash";
else if($_POST[how_pay] == 2) $how_pay = "card";
else if($_POST[how_pay] == 3) $how_pay = "cashReceipt";

// ���� ���õ� �޴��� ��ȣ, ����, ������ �����´�.
$query = "SELECT goods_num, goods_count, price*goods_count AS price FROM selected_menu JOIN goods USING(goods_num)";
$result = mysql_query($query);

if(mysql_num_rows($result) == 0)
{
?>
	<script>
		alert("���õ� �޴��� �����ϴ�.");
		location.href="index.php";
	</script>
<?php
}

while($row = mysql_fetch_row($result))
{
	// ���õ� �޴����� ���ʴ�� �ֹ� ���̺� �����Ѵ�.
	$goods_num = $row[0];
	$goods_count = $row[1];
	$goods_total_price = $row[2];
	
	$query = "INSERT INTO order_table(order_num, goods_num, goods_count, price, how_pay)";
	$query .= "VALUES ($order_num, $goods_num, $goods_count, $goods_total_price, '$how_pay')";
	$result1 = mysql_query($query);
}

// ���õ� �޴��� �����.
$query = "DELETE FROM selected_menu";
$result = mysql_query($query);

?>

<script>
	alert("�ֹ��� �Ϸ�Ǿ����ϴ�.");
	location.href="index.php";
</script>
