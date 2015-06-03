<?php 
include 'header.php'; 
include "db_conn.php";
?>

<!------------------------------- ���� �޴� ���� ------------------------------>
	<div class="left">
		<div class="sales_left">	
			<ul>
				<li><a href="sales.php?sale=hour">�ð�������</a></li>
				<li><a href="sales.php?sale=day">�Ϻ�����</a></li>
				<li><a href="sales.php?sale=month">��������</a></li>
			</ul>
		</div>
	</div>
<!------------------------------- ���� �޴� �� -------------------------------->

	
	
	
<!------------------------------- ������ ���� ���� ----------------------------->
	<div class="right">
		<?php
		// �ð��� ���� ȭ��
		if($_GET[sale]=="hour")
		{
		?>
			<div class="sales_hour">
			<div class="subheader">�ð��� ����</div>
			<div class="sales_view_hour">
			
				<?php
				echo("<TABLE class=sales>");
				echo("<tr>");
				echo("<th>�ð���</th><th>����</th>");
				echo("</tr>");
		
				for($hour = 0; $hour < 24; $hour++)
				{
					// ���� ��¥�� �������� �ð��� ���� �ۼ�
		
					// ���� �ð�
					$date1 = mktime($hour, 0, 0, date("m"), date("d"), date("Y") );
					$startHour = date("H:i", $date1);
					$startTime = date("Y-m-d H:i:s", $date1);
		
					// �� �ð�
					$date2 = mktime($hour+1, 0, 0, date("m"), date("d"), date("Y") );
					$endHour = date("H:i", $date2);
					$endTime = date("Y-m-d H:i:s", $date2);
		
					// ���۽ð��� ���ð� ���̿� ���ϴ� �ֹ������� price�� ��
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
					�ֹ� ����
				</div>
				<div class="hour_detail">
					<?php 
					echo("<TABLE class=sales>");
					echo("<tr>");
					echo("<th>�ֹ���ȣ</th><th>�ֹ��ð�</th><th>����</th>");
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
					�ֹ� ���� ��
				</div>
			
				<div class="order_detail">
					<?php 
					
					
					echo("<TABLE class=sales>");
					echo("<tr>");
					echo("<th>�޴�</th><th>����</th><th>����</th>");
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
		
		// �Ϻ� ���� ȭ��
		if($_GET[sale]=="day")
		{
		?>
			<div class="subheader">�Ϻ� ����</div>
	
			<div class="sales_view">	
				<?php
				echo("<TABLE class=sales>");
				echo("<tr>");
				echo("<th>��¥</th><th>����</th>");
				echo("</tr>");
		
				for($day = 1; $day < 32; $day++)
				{
					// �̹����� �������� ��¥�� ���� �ۼ�
		
					// ��¥�� ��ȿ�� üũ
					if( !checkdate(date("m"), $day, date("Y") ) )
					{
						continue;
					}
					
					// ��¥ �����
					$date = mktime(0, 0, 0, date("m"), $day, date("Y") );
					$currentDate = date("Y-m-d", $date);
		
					// �ش��ϴ� ��¥�� �ֹ������� price�� ��
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
			<div class="subheader">���� ����</div>
	
			<div class="sales_view">	
				<?php
				echo("<TABLE class=sales>");
				echo("<tr>");
				echo("<th>��</th><th>����</th>");
				echo("</tr>");
		
				for($month = 1; $month < 13; $month++)
				{
					// �̹����� �������� ��¥�� ���� �ۼ�
		
					// ��¥ �����
					$date = mktime(0, 0, 0, $month, 1, date("Y") );
					$currentMonth = date("Y-m", $date);
		
					// �ش��ϴ� ��¥�� �ֹ������� price�� ��
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
<!------------------------------- �����U ���� �� ------------------------------->
	
<?php 
include 'footer.php' 
?>