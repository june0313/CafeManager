<?php 
include 'header.php'; 
include 'admin_left.php';
include 'db_conn.php';
?>

<!------------------------------- 오른쪽 내용 시작 ---------------------------->
	<div class="right">
		<?php
		// 비밀번호 변경 화면 출력
		if($_GET[work]=="pwd")
		{
		?>
		<div class="subheader">
			비밀번호 설정
		</div>
		<form ACTION="pwd_update.php" METHOD="POST">
			<table class="pwd_update">
			<tr>
				<td class="h">기존 비밀번호</td>
				<td><input type="password" name="password"></input></td>
			</tr>
			<tr>
				<td class="h">변경할 비밀번호</td>
				<td><input type="password" name="password_change"></input></td>
			</tr>
			<tr>
				<td class="h">비밀번호 확인</td>
				<td><input type="password" name="passwordCheck"></input></td>
			</tr>
		</table>
			<center>
				<input type="submit" value="수정">
				<input type="reset" value="취소">
			</center>
		</form>
		<?
		}
		// 상품 등록 화면
		elseif($_GET[work]=="insert")
		{
		?>
			<div class="subheader">
				상품 등록
			</div>
			<form ACTION="goods_insert.php" METHOD="POST">
				<table class="goods_insert">
					<tr>
						<td class="h">이름</td>
						<td><input type="text" name="name"></input></td>
					</tr>
					<tr>
						<td class="h">가격</td>
						<td><input type="text" name="price"></input></td>
					</tr>
					<tr>
						<td class="h">종류</td>
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
					<input type="submit" value="등록">
					<input type="reset" value="취소">
				</center>
			</form>

		<?
		}
		// 상품 목록 화면
		elseif($_GET[work]=="list")
		{
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
			
			$query="SELECT name, price, type FROM goods";
			$result=mysql_query($query,$link);
			$row = mysql_fetch_array($result);
		?>
			<div class="subheader">
				커피숍에 등록되어 있는 상품목록입니다. 상품을 클릭하면 수정할 수 있습니다.
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
		
			<!-- 메뉴판 -->
			<div class="menu_admin">
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
				상품의 상세 정보
			</div>
			
			<form ACTION="goods_change.php" METHOD="POST">
				<table class="goods_detail">
					<tr>
						<td class="h">이름</td>
						<td><?=$good[name]?></td>
					</tr>
					<tr>
						<td class="h">가격</td>
						<td><?=$good[price]?></td>
					</tr>
					<tr>
						<td class="h">종류</td>
						<td><?=$type?></td>
					</tr>
				</table>

				<center>
					<input type="button" value="수정" onclick="location.href='goods_change.php?goods_num=<?=$_GET[goods_num]?>'">
					<input type="button" value="삭제" onclick="location.href='goods_delete.php?goods_num=<?=$_GET[goods_num]?>&cat=<?=$good[type]?>'">
					<input type="button" value="취소" onclick="location.href='admin.php?work=list&cat=<?=$good[type]?>'">
				</center>
			</form>


	<?
		}	

	?>





	</div>
<!------------------------------- 오른쪾 내용 끝 ------------------------------>
	
<?php 
include 'footer.php' 
?>