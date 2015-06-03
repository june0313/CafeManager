<?php 
include 'header.php'; 
include 'admin_left.php';
include 'db_conn.php';
?>


<!------------------------------- 오른쪽 내용 시작 ---------------------------->
<div class="right">
	<div class="subheader">
		상품 삭제
	</div>

		
		
		<form ACTION="goods_delete_process.php?goods_num=<?=$_GET[goods_num]?>&cat=<?=$_GET[cat]?>" METHOD="POST"> 
			
			
			<center>
				<p class="goods_delete">해당 상품을 정말로 삭제하시겠습니까?</p>
				<input type="submit" value="확인">
				<input type="button" value="취소" onclick="history.back()">
			</center>
		</form>
	

</div>

<!------------------------------- 오른쪾 내용 끝 ------------------------------>
	
<?php 
include 'footer.php' 
?>