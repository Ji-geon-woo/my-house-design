<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/layout/lib/db_conn.php";

// 세션변수 create
function setsSession($name,$value){
	$$name = $_SESSION["$name"] = $value;
}

$member_id = $_POST['member_id'];
$member_pw = $_POST['member_pw'];

//쿼리전송
$sql = "SELECT * FROM member WHERE member_id='$member_id'";
$result = mysqli_query($conn, $sql);
$member = mysqli_fetch_array($result);

if(!$member['member_id']){
	echo "
    <script>
    window.alert('존재하지 않는 아이디입니다.');
    history.back(1);
    </script>
    ";
	exit;
}

if($member['member_pw']!=$member_pw){
	echo "
    <script>
    window.alert('비밀번호가 같지 않습니다.');
    history.back(1);
    </script>
    ";
	exit;
}

setsSession('MID',$member_id);
setsSession('MName',$member['member_name']);
setsSession('MLV',$member['member_lv']);
setsSession('Mindex',$member['member_uid']);

echo "
 <script>
 window.alert('로그인 되었습니다.');
 location.href='/layout/index.php'
 </script>
 ";

?>
