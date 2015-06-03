<?
 include "./db_conn.php";

 $query="UPDATE goods SET del = 0  where goods_num='$_GET[goods_num]'";
 $result=mysql_query($query,$link) or die("DB접속 혹은 쿼리에 실패하였습니다.".mysql_error());
// -------- 변수 받는 부분 -------------

?>
 
 <script language="javascript">
  document.location.href='admin.php?work=list&cat=<?=$_GET[cat]?>';
 </script>