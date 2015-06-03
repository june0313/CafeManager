<?php 
include 'header.php'; 
include 'admin_left.php';
include 'db_conn.php';

 $query="SELECT name, price, type FROM goods WHERE goods_num='$_GET[goods_num]'";
 $result=mysql_query($query,$link) or die("DB접속 혹은 쿼리에 실패하였습니다.".mysql_error());
 $row = mysql_fetch_array($result);
?>

<div class="right">
	<div class="subheader">
		상품 정보 수정
	</div>
		<form ACTION="goods_change_process.php?work=change2&goods_num=<?=$_GET[goods_num]?>" METHOD="POST">
			<table class="goods_insert">
			<tr>
				<td class="h">이름</td>
				<td><input type="text" name="name" value='<?=$row['name']?>'></input></td>
			</tr>
			<tr>
				<td class="h">가격</td>
				<td><input type="text" name="price" value=<?=$row['price']?>></input></td>
			</tr>
			<tr>
				<td class="h">종류</td>
				<td><SELECT name="type">
				<?
					if($row['type']=="esp")	
					{
	?>	
						<OPTION VALUE="esp">ESPRESSO</OPTION>
						<OPTION VALUE="nonesp">NON-ESPRESSO</OPTION>
						<OPTION VALUE="iceesp">ICE-ESPRESSO</OPTION>
						<OPTION VALUE="icenonesp">ICE-NON-ESPRESSO</OPTION>
						<OPTION VALUE="ade">ADE</OPTION>
						<?
					}	
					elseif($row['type']=="nonesp")	
					{
	?>	
						<OPTION VALUE="esp">ESPRESSO</OPTION>
						<OPTION VALUE="nonesp" selected>NON-ESPRESSO</OPTION>
						<OPTION VALUE="iceesp">ICE-ESPRESSO</OPTION>
						<OPTION VALUE="icenonesp">ICE-NON-ESPRESSO</OPTION>
						<OPTION VALUE="ade">ADE</OPTION>
						<?
					}	
					elseif($row['type']=="iceesp")	
					{
	?>	
						<OPTION VALUE="esp">ESPRESSO</OPTION>
						<OPTION VALUE="nonesp">NON-ESPRESSO</OPTION>
						<OPTION VALUE="iceesp" selected>ICE-ESPRESSO</OPTION>
						<OPTION VALUE="icenonesp">ICE-NON-ESPRESSO</OPTION>
						<OPTION VALUE="ade">ADE</OPTION>
						<?
					}
					elseif($row['type']=="icenonesp")	
					{
	?>	
						<OPTION VALUE="esp">ESPRESSO</OPTION>
						<OPTION VALUE="nonesp">NON-ESPRESSO</OPTION>
						<OPTION VALUE="iceesp">ICE-ESPRESSO</OPTION>
						<OPTION VALUE="icenonesp" selected>ICE-NON-ESPRESSO</OPTION>
						<OPTION VALUE="ade">ADE</OPTION>
						<?
					}
					elseif($row['type']=="ade")	
					{
	?>	
						<OPTION VALUE="esp">ESPRESSO</OPTION>
						<OPTION VALUE="nonesp">NON-ESPRESSO</OPTION>
						<OPTION VALUE="iceesp">ICE-ESPRESSO</OPTION>
						<OPTION VALUE="icenonesp">ICE-NON-ESPRESSO</OPTION>
						<OPTION VALUE="ade" selected>ADE</OPTION>
						<?
					}
	?>
				</td>
			</tr>
		</table>
		<center>
			<input type="submit" value="수정" onclick="location.href='admin.php?work=change2&goods_num=<?=$_GET[goods_num]?>'">
			<input type="button" value="취소" onclick="location.href='admin.php?work=change2&goods_num=<?=$_GET[goods_num]?>'">
		</center>
	</form>
</div>
<!------------------------------- 오른쪾 내용 끝 ------------------------------>
	
<?php 
include 'footer.php' 
?>