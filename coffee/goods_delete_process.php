<?
 include "./db_conn.php";

 $query="UPDATE goods SET del = 0  where goods_num='$_GET[goods_num]'";
 $result=mysql_query($query,$link) or die("DB���� Ȥ�� ������ �����Ͽ����ϴ�.".mysql_error());
// -------- ���� �޴� �κ� -------------

?>
 
 <script language="javascript">
  document.location.href='admin.php?work=list&cat=<?=$_GET[cat]?>';
 </script>