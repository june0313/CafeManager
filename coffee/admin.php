<?php 
include 'header.php'; 
include 'admin_left.php';
include 'db_conn.php';
?>

<!------------------------------- ������ ���� ���� ---------------------------->
	<div class="right">
		<?php
		// ��й�ȣ ���� ȭ�� ���
		if($_GET[work]=="pwd")
		{
		?>
		<div class="subheader">
			��й�ȣ ����
		</div>
		<form ACTION="pwd_update.php" METHOD="POST">
			<table class="pwd_update">
			<tr>
				<td class="h">���� ��й�ȣ</td>
				<td><input type="password" name="password"></input></td>
			</tr>
			<tr>
				<td class="h">������ ��й�ȣ</td>
				<td><input type="password" name="password_change"></input></td>
			</tr>
			<tr>
				<td class="h">��й�ȣ Ȯ��</td>
				<td><input type="password" name="passwordCheck"></input></td>
			</tr>
		</table>
			<center>
				<input type="submit" value="����">
				<input type="reset" value="���">
			</center>
		</form>
		<?
		}
		// ��ǰ ��� ȭ��
		elseif($_GET[work]=="insert")
		{
		?>
			<div class="subheader">
				��ǰ ���
			</div>
			<form ACTION="goods_insert.php" METHOD="POST">
				<table class="goods_insert">
					<tr>
						<td class="h">�̸�</td>
						<td><input type="text" name="name"></input></td>
					</tr>
					<tr>
						<td class="h">����</td>
						<td><input type="text" name="price"></input></td>
					</tr>
					<tr>
						<td class="h">����</td>
						<td><SELECT name="type">
							<OPTION VALUE="esp">ESPRESSO</OPTION>
							<OPTION VALUE="nonesp">NON-ESPRESSO</OPTION>
							<OPTION VALUE="iceesp">ICE-ESPRESSO</OPTION>
							<OPTION VALUE="icenonesp">ICE-NON-ESPRESSO</OPTION>
							<OPTION VALUE="ade">ADE</OPTION>
						</td>
					</tr>
				</table>
				<center>
					<input type="submit" value="���">
					<input type="reset" value="���">
				</center>
			</form>

		<?
		}
		// ��ǰ ��� ȭ��
		elseif($_GET[work]=="list")
		{
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
			
			$query="SELECT name, price, type FROM goods";
			$result=mysql_query($query,$link);
			$row = mysql_fetch_array($result);
		?>
			<div class="subheader">
				Ŀ�Ǽ� ��ϵǾ� �ִ� ��ǰ����Դϴ�. ��ǰ�� Ŭ���ϸ� ������ �� �ֽ��ϴ�.
			</div>
			
			<div class="category">
				<ul>
					<li><a class="<?php echo $esp; ?>" href="admin.php?work=list&cat=esp">ESPRESSO</a></li>
					<li><a class="<?php echo $nonesp; ?>" href="admin.php?work=list&cat=nonesp">NON-ESPRESSO</a></li>
					<li><a class="<?php echo $iceesp; ?>" href="admin.php?work=list&cat=iceesp">ICE-ESPRESSO</a></li>
					<li><a class="<?php echo $icenonesp; ?>" href="admin.php?work=list&cat=icenonesp">ICE-NON-ESPRESSO</a></li>
					<li><a class="<?php echo $ade; ?>" href="admin.php?work=list&cat=ade">ADE</a></li>
				</ul>
			</div>
		
			<!-- �޴��� -->
			<div class="menu_admin">
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
					
					echo("<td><a href=admin.php?work=change2&goods_num=$row[0]>$row[1]<br>$row[2]</a>
						</td>");
					
					if( $i % 5 == 4 ) echo("<tr>");
					
					$i++;
				}
			}
			
			echo("</table>");
			
			?>
			</div>
			
			
			<?
			}
			elseif($_GET[work]=="change2")
			{
				$query = "SELECT goods_num, name, price, type FROM goods WHERE goods_num=$_GET[goods_num]";
				$result = mysql_query($query);
				$good = mysql_fetch_array($result);
				
				if( $good[type] == "esp") $type = "ESPRESSO";
				else if( $good[type] == "nonesp") $type = "NON-ESPRESSO";
				else if( $good[type] == "iceesp") $type = "ICE-ESPRESSO";
				else if( $good[type] == "icenonesp") $type = "ICE-NON-ESPRESSO";
				else if( $good[type] == "ade") $type = "ADE";
			?>
			
			<div class="subheader">
				��ǰ�� �� ����
			</div>
			
			<form ACTION="goods_change.php" METHOD="POST">
				<table class="goods_detail">
					<tr>
						<td class="h">�̸�</td>
						<td><?=$good[name]?></td>
					</tr>
					<tr>
						<td class="h">����</td>
						<td><?=$good[price]?></td>
					</tr>
					<tr>
						<td class="h">����</td>
						<td><?=$type?></td>
					</tr>
				</table>

				<center>
					<input type="button" value="����" onclick="location.href='goods_change.php?goods_num=<?=$_GET[goods_num]?>'">
					<input type="button" value="����" onclick="location.href='goods_delete.php?goods_num=<?=$_GET[goods_num]?>&cat=<?=$good[type]?>'">
					<input type="button" value="���" onclick="location.href='admin.php?work=list&cat=<?=$good[type]?>'">
				</center>
			</form>


	<?
		}	

	?>





	</div>
<!------------------------------- �����U ���� �� ------------------------------>
	
<?php 
include 'footer.php' 
?>