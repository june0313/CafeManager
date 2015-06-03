<?php 
include 'header.php'; 
include 'db_conn.php';

// 선택된 카테고리의 색을 다르게 표시하는 코드
// 기본적으로 nonSelected 클래스의 스타일을 적용하고
$esp = "nonSelected";
$nonesp = "nonSelected";
$iceesp = "nonSelected";
$icenonesp = "nonSelected";
$ade = "nonSelected";

// 선택된 카테고리일 경우에면 Selected 클래스의 스타일을 적용한다.
if($_GET['cat'] == "esp")
{
	$esp = 'Selected';
}
else if($_GET['cat'] == "nonesp")
{
	$nonesp = 'Selected';
}
else if($_GET['cat'] == "iceesp")
{
	$iceesp = 'Selected';
}
else if($_GET['cat'] == "icenonesp")
{
	$icenonesp = 'Selected';
}
else if($_GET['cat'] == "ade")
{
	$ade = "Selected";
}
?>

<!-- 선택된 메뉴를 추가한다 -->
<?php
	
	if( $_GET[goods_num] )
	{
		$goods_num = $_GET[goods_num];
		
		// 메뉴를 추가한다.
		$query = "INSERT INTO selected_menu VALUES( $goods_num, 1)";
		$result = mysql_query($query);
		
		// 중복되는 메뉴가 있으면 메뉴 수량을 1 증가킨다.
		if( mysql_errno() == 1062)
		{
			$query = "UPDATE selected_menu SET goods_count = goods_count+1 WHERE goods_num = $goods_num";
			$result = mysql_query($query);
		}
		
		/*
		echo("<script>");
		echo("location.href='order.php?cat=$_GET[cat]'");
		echo("</script>");
		*/
	}
?>

<!-- 선택된 메뉴를 삭제한다 -->
<?php
// 현재 선택되어 있는 메뉴의 테이블 내용을 지운다.
if( $_GET[action] == 'delete')
{
	$query = "DELETE FROM selected_menu";
	$result = mysql_query($query);
}
?>



<!------------------------------- 왼쪽 메뉴 시작 ------------------------------->
	<div class="left">
		<div class="order_table">
			<table id="order_table">
				<tr>
					<th class="menu">메뉴</th> <th>수량</th> <th>가격</th>
				</tr>
				<?php 
				$query = "SELECT name, goods_count, price*goods_count AS price FROM selected_menu JOIN goods USING(goods_num)";
				$result = mysql_query($query);
				$sum = 0;
				// 현재 선택된 메뉴들을 출력한다.
				while($row = mysql_fetch_row($result))
				{
					echo("<tr>");
					echo("<td>$row[0]</td>");
					echo("<td>$row[1]</td>");
					echo("<td>$row[2]</td>");
					echo("</tr>");
					
					$sum += $row[2];
				}
				?>
			</table>
			
			<?php
			if(mysql_num_rows($result) != 0)
			{
				echo("<a href='order.php?action=delete&cat=$_GET[cat]'>주문취소</a>");
			}
			?>
		</div>
		
		<form id="form" action="insert.php" method="POST">
			
		</form>
			
		<div class="print_price">
			총금액 <input type=text id="sum" readonly="readonly" value=<?=$sum?>>
		</div>
		
	</div>
<!------------------------------- 왼쪽 메뉴 끝 -------------------------------->
	
	
	
	
	

<!------------------------------- 오른쪽 내용 시작 ---------------------------->
	<div class="right">

		<!-- 메뉴 카테고리 -->
		<div class="category">
			<ul>
				<li><a class="<?php echo $esp; ?>" href="order.php?cat=esp">ESPRESSO</a></li>
				<li><a class="<?php echo $nonesp; ?>" href="order.php?cat=nonesp">NON-ESPRESSO</a></li>
				<li><a class="<?php echo $iceesp; ?>" href="order.php?cat=iceesp">ICE-ESPRESSO</a></li>
				<li><a class="<?php echo $icenonesp; ?>" href="order.php?cat=icenonesp">ICE-NON-ESPRESSO</a></li>
				<li><a class="<?php echo $ade; ?>" href="order.php?cat=ade">ADE</a></li>
			</ul>
		</div>
		
		

		<!-- 메뉴판 -->
		<div class="menu">
			<?php
			$query = "SELECT goods_num, name, price FROM goods WHERE type='$_GET[cat]' && del=1";
			$result = mysql_query($query);
			$i = 0;
			
			echo("<table>");
			
			if(mysql_num_rows($result) == 0) 
				echo("<tr><td>메뉴가 등록되어있지 않습니다.</td></tr>");
			else{
				// 해당 카테고리의 메뉴를 출력한다.
				while( $row = mysql_fetch_row($result) )
				{
					if( $i % 5 == 0 ) echo("<tr>");
				
					echo("<td><a href=order.php?goods_num=$row[0]&cat=$_GET[cat]>$row[1]<br>$row[2]</a></td>");
					
					if( $i % 5 == 4 ) echo("<tr>");
					
					$i++;
				}
			}
			
			echo("</table>");
			
			?>
			
		</div>
		
		
		
		<div class="menu_bottom">
				<form method=POST action=insert.php>
					<table class="how_pay">
						<tr>
							<td>결제수단</td>
							<td rowspan=2><input type=submit value="계산">	</td>
						</tr>
						<tr>
							<td>
								<select name=how_pay>
									<option value=1>현금</option>
									<option value=2>카드</option>
									<option value=3>현금영수증</option>
								</select>
							
							</td>
						</tr>
					</table>
				</form>
				
		</div>
	
	</div>
<!------------------------------- 오른쪽 내용 끝 ------------------------------->
	
<?php 
include 'footer.php'; 
?>