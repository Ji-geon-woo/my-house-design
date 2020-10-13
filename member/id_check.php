<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/layout/lib/db_conn.php";

if($_POST['member_id_join'] != NULL){
  $sql = "SELECT COUNT(*) FROM member WHERE member_id='{$_POST['member_id_join']}'";
  $result = mysqli_query($conn, $sql);
  $member = mysqli_fetch_array($result);
  $id_check = $member[0];

  if($id_check >= 1){
  	echo "<p style='color:#F00;'>존재하는 아이디입니다.</p>";
  } else {
  	echo "<p>사용 가능한 아이디입니다.</p>";
  }
}

?>
