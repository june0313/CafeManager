<?php 
include 'header.php'; 
?>

<div class="admin_check">
	<form ACTION="admin_process.php" METHOD="POST">
		<table class="login">
				<tr>
					<th colspan=2>관리자 비밀번호 입력</th>
				</tr>
				<tr>
					<td><input type="password" name="password"></td>
					<td><input type="submit" value="접속"></td>
				</tr>
		</table>
	</form>
</div>


<?php 
include 'footer.php' 
?>