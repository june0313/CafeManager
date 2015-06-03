<?php 
include 'header.php'; 
include "db_conn.php";
?>

<!------------------------------- 왼쪽 메뉴 시작 ------------------------------>
	<div class="left">
		<div class="sales_left">	
			<ul>
				<li><a href="sales.php?sale=hour">시간별매출</a></li>
				<li><a href="sales.php?sale=day">일별매출</a></li>
				<li><a href="sales.php?sale=month">월별매출</a></li>
			</ul>
		</div>
	</div>
<!------------------------------- 왼쪽 메뉴 끝 -------------------------------->

	
	
	
<!------------------------------- 오른쪽 내용 시작 ----------------------------->
	<div class="right">
		<?php
		// 시간별 매출 화면
		if($_GET[sale]=="hour")
		{
		?>
			<div class="sales_hour">
			<div class="subheader">시간별 매출</div>
			<div class="sales_view_hour">
			
				<?php
				echo("<TABLE class=sales>");
				echo("<tr>");
				echo("<th>시간대</th><th>매출</th>");
				echo("</tr>");
		
				for($hour = 0; $hour < 24; $hour++)
				{
					// 오늘 날짜를 기준으로 시간별 쿼리 작성
		
					// 시작 시간
					$date1 = mktime($hour, 0, 0, date("m"), date("d"), date("Y") );
					$startHour = date("H:i", $date1);
					$startTime = date("Y-m-d H:i:s", $date1);
		
					// 끝 시간
					$date2 = mktime($hour+1, 0, 0, date("m"), date("d"), date("Y") );
					$endHour = date("H:i", $date2);
					$endTime = date("Y-m-d H:i:s", $date2);
		
					// 시작시간과 끝시간 사이에 속하는 주문내역의 price의 합
					$query = "SELECT sum(price) FROM order_table WHERE time BETWEEN '$startTime' AND '$endTime'";
					$result = mysql_query($query);
					$row = mysql_fetch_row($result);
		
					echo("<tr>");
					echo("<td> $startHour ~ $endHour </td>");
			
					echo("<td><a href=sales.php?sale=hour&startTime=$date1&endTime=$date2>$row[0]</a></td>");
			
					echo("</tr>");
				}
		
				echo("</TABLE>");
				?>
			</div>
			</div>
					
			<div class="detail">
				<div class="subheader">
					주문 내역
				</div>
				<div class="hour_detail">
					<?php 
					echo("<TABLE class=sales>");
					echo("<tr>");
					echo("<th>주문번호</th><th>주문시간</th><th>매출</th>");
					echo("</tr>");
					
					if($_GET[startTime] != null && $_GET[endTime] != null ) 
					{		
						$start = date("Y-m-d H:i:s", $_GET[startTime]);
						$end = date("Y-m-d H:i:s", $_GET[endTime]);
						
					 	$query = "SELECT order_num, time, sum(price) FROM order_table "; 
					 	$query .= "WHERE time BETWEEN '$start' AND '$end' ";
					 	$query .= "GROUP BY order_num";
					 	
					 	$result = mysql_query($query);
					 	
					 	while($row = mysql_fetch_row($result))
					 	{
					 		echo("<tr>");
					 		echo("<td><a href=sales.php?sale=hour&startTime=$_GET[startTime]&endTime=$_GET[endTime]&order_num=$row[0]>$row[0]</a></td>");
					 		echo("<td>$row[1]</td>");
					 		echo("<td>$row[2]</td>");
					 		echo("</tr>");
					 	}
					}
				 	echo("</TABLE>");
					
					?>
				</div>
				
				<div class="subheader">
					주문 내역 상세
				</div>
			
				<div class="order_detail">
					<?php 
					
					
					echo("<TABLE class=sales>");
					echo("<tr>");
					echo("<th>메뉴</th><th>수량</th><th>가격</th>");
					echo("</tr>");	
					
					if( $_GET[order_num] != null )
					{
						$query = "SELECT name, goods_count, order_table.price FROM order_table LEFT JOIN goods USING(goods_num) WHERE order_num=$_GET[order_num]";
						$result = mysql_query($query);
						
						while($row = mysql_fetch_row($result))
						{
							echo("<tr>");
							echo("<td>$row[0]</td>");
							echo("<td>$row[1]</td>");
							echo("<td>$row[2]</td>");
							echo("</tr>");
						}
					}
					echo("</TABLE>");
					
					?>
				</div>
				
			</div>
		<?php
		}
		
		// 일별 매출 화면
		if($_GET[sale]=="day")
		{
		?>
			<div class="subheader">일별 매출</div>
	
			<div class="sales_view">	
				<?php
				echo("<TABLE class=sales>");
				echo("<tr>");
				echo("<th>날짜</th><th>매출</th>");
				echo("</tr>");
		
				for($day = 1; $day < 32; $day++)
				{
					// 이번달을 기준으로 날짜별 쿼리 작성
		
					// 날짜의 유효성 체크
					if( !checkdate(date("m"), $day, date("Y") ) )
					{
						continue;
					}
					
					// 날짜 만들기
					$date = mktime(0, 0, 0, date("m"), $day, date("Y") );
					$currentDate = date("Y-m-d", $date);
		
					// 해당하는 날짜의 주문내역의 price의 합
					$query = "SELECT sum(price) FROM order_table WHERE time LIKE '$currentDate%'";
					$result = mysql_query($query);
					$row = mysql_fetch_row($result);
		
					echo("<tr>");
					echo("<td> $currentDate </td>");
					echo("<td> $row[0] </td>");
					echo("</tr>");
				}
		
				echo("</TABLE>");
				?>
			</div>		
		<?php
		}

		if($_GET[sale]=="month")
		{
		?>
			<div class="subheader">월별 매출</div>
	
			<div class="sales_view">	
				<?php
				echo("<TABLE class=sales>");
				echo("<tr>");
				echo("<th>달</th><th>매출</th>");
				echo("</tr>");
		
				for($month = 1; $month < 13; $month++)
				{
					// 이번달을 기준으로 날짜별 쿼리 작성
		
					// 날짜 만들기
					$date = mktime(0, 0, 0, $month, 1, date("Y") );
					$currentMonth = date("Y-m", $date);
		
					// 해당하는 날짜의 주문내역의 price의 합
					$query = "SELECT sum(price) FROM order_table WHERE time LIKE '$currentMonth%'";
					$result = mysql_query($query);
					$row = mysql_fetch_row($result);
		
					echo("<tr>");
					echo("<td> $currentMonth </td>");
					echo("<td> $row[0] </td>");
					echo("</tr>");
				}
		
				echo("</TABLE>");
				?>
			</div>
		<?php
		}	
		?>
	</div>
<!------------------------------- 오른쪾 내용 끝 ------------------------------->
	
<?php 
include 'footer.php' 
?>