<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/layout/lib/db_conn.php";

$onh_uid = $_POST['onh_uid'];
$in_grade = $_POST['in_grade'];

$sql = "SELECT * FROM onhouse WHERE onh_uid='$onh_uid'";
$result = mysqli_query($conn, $sql);
$onhouse = mysqli_fetch_array($result);

$divnum = $onhouse['onh_count']+1;
$totalgrade = $onhouse['onh_total'];
$sumgrade = $in_grade + $totalgrade;
$cntgrade = floor($sumgrade/$divnum);


// 쿼리전송
$sql = "
UPDATE onhouse
SET
    onh_grade = '$cntgrade',
    onh_count = '$divnum',
    onh_total = '$sumgrade'
WHERE
    onh_uid = '$onh_uid'
";
$result = mysqli_query($conn, $sql);


// $onh_id = $onhouse['onh_id'];
//
// $sql = "SELECT AVG(onh_grade) FROM onhouse WHERE onh_id='$onh_id'";
// $result = mysqli_query($conn, $sql);
// $onhouse = mysqli_fetch_array($result);
//
// $member_grade = floor($onhouse[0]);
//
// echo $member_grade;
//
// //쿼리전송
// $sql = "
// UPDATE member
// SET
//     member_grade = '$member_grade'
// WHERE
//     member_id = '$onh_id'
// ";
// $result = mysqli_query($conn, $sql);


if($result === false){
    echo '저장하는 과정에서 문제가 생겼습니다.';
    error_log(mysqli_error($conn));
} else {
    echo "<script type='text/javascript'>alert('글을 작성했습니다');";
    echo "location.href='list.php';";
    echo "</script>";
}
?>
