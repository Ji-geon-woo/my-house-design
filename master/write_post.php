<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/layout/lib/db_conn.php";

$member_index = $_SESSION['Mindex'];
$review_cost = $_POST['review_cost'];
$review_description = $_POST['review_description'];
$member_uid = $_POST['member_uid'];
$review_grade = $_POST['in_grade'];

$sql = "SELECT * FROM member WHERE member_uid='$member_uid'";
$result = mysqli_query($conn, $sql);
$member = mysqli_fetch_array($result);

$review_mid = $member['member_id'];
$review_mname = $member['member_name'];

// 쿼리전송
$sql = "
INSERT INTO review
(review_cost, review_description, review_grade, review_mid, review_mname, member_link)
VALUES (
    '$review_cost',
    '$review_description',
    '$review_grade',
    '$review_mid',
    '$review_mname',
    '$member_index'
)
";
$result = mysqli_query($conn, $sql);


$sql = "SELECT AVG(review_grade) FROM review WHERE review_mid='$review_mid'";
$result = mysqli_query($conn, $sql);
$review = mysqli_fetch_array($result);
$member_grade = floor($review[0]);

//쿼리전송
$sql = "
UPDATE member
SET
    member_grade = '$member_grade'
WHERE
    member_id = '$review_mid'
";
$result = mysqli_query($conn, $sql);


if($result === false){
    echo '저장하는 과정에서 문제가 생겼습니다.';
    error_log(mysqli_error($conn));
} else {
    echo "<script type='text/javascript'>alert('글을 작성했습니다');";
    echo "location.href='review_list.php';";
    echo "</script>";
}
?>
