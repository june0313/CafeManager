<?php 
include 'header.php'; 
include 'admin_left.php';
include 'db_conn.php';
?>


<!------------------------------- ������ ���� ���� ---------------------------->
<div class="right">
	<div class="subheader">
		��ǰ ����
	</div>

		
		
		<form ACTION="goods_delete_process.php?goods_num=<?=$_GET[goods_num]?>&cat=<?=$_GET[cat]?>" METHOD="POST"> 
			
			
			<center>
				<p class="goods_delete">�ش� ��ǰ�� ������ �����Ͻðڽ��ϱ�?</p>
				<input type="submit" value="Ȯ��">
				<input type="button" value="���" onclick="history.back()">
			</center>
		</form>
	

</div>

<!------------------------------- �����U ���� �� ------------------------------>
	
<?php 
include 'footer.php' 
?>