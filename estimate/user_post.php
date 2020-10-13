<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/layout/lib/db_conn.php";

$estimate_link = $_POST['mst_link'];
$mst_state = '선택';

// 쿼리전송
$sql = "
UPDATE master
SET
    mst_state = '$mst_state'
WHERE
    estimate_link = '$estimate_link'
";
$result = mysqli_query($conn, $sql);

if($result === false){
    echo '저장하는 과정에서 문제가 생겼습니다.';
    error_log(mysqli_error($conn));
} else {
    echo "<script type='text/javascript'>alert('글을 작성했습니다');";
    echo "location.href='list.php';";
    echo "</script>";
}
?>
