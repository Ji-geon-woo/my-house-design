<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/layout/lib/db_conn.php";

$member_index = $_SESSION['Mindex'];
$mst_cost = $_POST['mst_cost'];
$est_uid = $_POST['est_uid'];
$mst_state = '진행중';

// 쿼리전송
$sql = "
INSERT INTO master
(mst_cost, mst_state, estimate_link, member_link)
VALUES (
    '$mst_cost',
    '$mst_state',
    '$est_uid',
    '$member_index'
)
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
