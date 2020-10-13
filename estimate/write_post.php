<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/layout/lib/db_conn.php";

$member_index = $_SESSION['Mindex'];
$in_year = $_POST['in_year'];
$in_month = $_POST['in_month'];
$in_day = $_POST['in_day'];
$est_date = $in_year."-".$in_month."-".$in_day;
$est_description = $_POST['est_description'];
$est_state = '진행중';
$est_select_state = '미선택';
$est_count = '0';

// 쿼리전송
$sql = "
INSERT INTO estimate
(est_date, est_description, est_state, est_select_state, est_count, member_link)
VALUES (
    '$est_date',
    '$est_description',
    '$est_state',
    '$est_select_state',
    '$est_count',
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
