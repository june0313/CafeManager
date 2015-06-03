<?php
include "db_conn.php";

//주문 테이블에 저장된 주문번호를 오름차순으로 가져온다.(이후 추가할때는 이 값의 +1)
$query = "SELECT order_num FROM order_table ORDER BY order_num desc ";
$result = mysql_query($query, $link);
$row = mysql_fetch_array($result);

// 주문번호 설정
if($row[0]==NULL)
{
	$order_num = 1;
}
else
{
	$order_num = $row[0]+1;
}

// 결제수단 설정
if($_POST[how_pay] == 1) $how_pay = "cash";
else if($_POST[how_pay] == 2) $how_pay = "card";
else if($_POST[how_pay] == 3) $how_pay = "cashReceipt";

// 현재 선택된 메뉴의 번호, 수량, 가격을 가져온다.
$query = "SELECT goods_num, goods_count, price*goods_count AS price FROM selected_menu JOIN goods USING(goods_num)";
$result = mysql_query($query);

if(mysql_num_rows($result) == 0)
{
?>
	<script>
		alert("선택된 메뉴가 없습니다.");
		location.href="index.php";
	</script>
<?php
}

while($row = mysql_fetch_row($result))
{
	// 선택된 메뉴들을 차례대로 주문 테이블에 삽입한다.
	$goods_num = $row[0];
	$goods_count = $row[1];
	$goods_total_price = $row[2];
	
	$query = "INSERT INTO order_table(order_num, goods_num, goods_count, price, how_pay)";
	$query .= "VALUES ($order_num, $goods_num, $goods_count, $goods_total_price, '$how_pay')";
	$result1 = mysql_query($query);
}

// 선택된 메뉴를 지운다.
$query = "DELETE FROM selected_menu";
$result = mysql_query($query);

?>

<script>
	alert("주문이 완료되었습니다.");
	location.href="index.php";
</script>
