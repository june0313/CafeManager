<?php 
include 'header.php'; 
include 'db_conn.php';

// ���õ� ī�װ��� ���� �ٸ��� ǥ���ϴ� �ڵ�
// �⺻������ nonSelected Ŭ������ ��Ÿ���� �����ϰ�
$esp = "nonSelected";
$nonesp = "nonSelected";
$iceesp = "nonSelected";
$icenonesp = "nonSelected";
$ade = "nonSelected";

// ���õ� ī�װ��� ��쿡�� Selected Ŭ������ ��Ÿ���� �����Ѵ�.
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

<!-- ���õ� �޴��� �߰��Ѵ� -->
<?php
	
	if( $_GET[goods_num] )
	{
		$goods_num = $_GET[goods_num];
		
		// �޴��� �߰��Ѵ�.
		$query = "INSERT INTO selected_menu VALUES( $goods_num, 1)";
		$result = mysql_query($query);
		
		// �ߺ��Ǵ� �޴��� ������ �޴� ������ 1 ����Ų��.
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

<!-- ���õ� �޴��� �����Ѵ� -->
<?php
// ���� ���õǾ� �ִ� �޴��� ���̺� ������ �����.
if( $_GET[action] == 'delete')
{
	$query = "DELETE FROM selected_menu";
	$result = mysql_query($query);
}
?>



<!------------------------------- ���� �޴� ���� ------------------------------->
	<div class="left">
		<div class="order_table">
			<table id="order_table">
				<tr>
					<th class="menu">�޴�</th> <th>����</th> <th>����</th>
				</tr>
				<?php 
				$query = "SELECT name, goods_count, price*goods_count AS price FROM selected_menu JOIN goods USING(goods_num)";
				$result = mysql_query($query);
				$sum = 0;
				// ���� ���õ� �޴����� ����Ѵ�.
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
				echo("<a href='order.php?action=delete&cat=$_GET[cat]'>�ֹ����</a>");
			}
			?>
		</div>
		
		<form id="form" action="insert.php" method="POST">
			
		</form>
			
		<div class="print_price">
			�ѱݾ� <input type=text id="sum" readonly="readonly" value=<?=$sum?>>
		</div>
		
	</div>
<!------------------------------- ���� �޴� �� -------------------------------->
	
	
	
	
	

<!------------------------------- ������ ���� ���� ---------------------------->
	<div class="right">

		<!-- �޴� ī�װ� -->
		<div class="category">
			<ul>
				<li><a class="<?php echo $esp; ?>" href="order.php?cat=esp">ESPRESSO</a></li>
				<li><a class="<?php echo $nonesp; ?>" href="order.php?cat=nonesp">NON-ESPRESSO</a></li>
				<li><a class="<?php echo $iceesp; ?>" href="order.php?cat=iceesp">ICE-ESPRESSO</a></li>
				<li><a class="<?php echo $icenonesp; ?>" href="order.php?cat=icenonesp">ICE-NON-ESPRESSO</a></li>
				<li><a class="<?php echo $ade; ?>" href="order.php?cat=ade">ADE</a></li>
			</ul>
		</div>
		
		

		<!-- �޴��� -->
		<div class="menu">
			<?php
			$query = "SELECT goods_num, name, price FROM goods WHERE type='$_GET[cat]' && del=1";
			$result = mysql_query($query);
			$i = 0;
			
			echo("<table>");
			
			if(mysql_num_rows($result) == 0) 
				echo("<tr><td>�޴��� ��ϵǾ����� �ʽ��ϴ�.</td></tr>");
			else{
				// �ش� ī�װ��� �޴��� ����Ѵ�.
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
							<td>��������</td>
							<td rowspan=2><input type=submit value="���">	</td>
						</tr>
						<tr>
							<td>
								<select name=how_pay>
									<option value=1>����</option>
									<option value=2>ī��</option>
									<option value=3>���ݿ�����</option>
								</select>
							
							</td>
						</tr>
					</table>
				</form>
				
		</div>
	
	</div>
<!------------------------------- ������ ���� �� ------------------------------->
	
<?php 
include 'footer.php'; 
?>