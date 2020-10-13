<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/layout/lib/db_conn.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/layout/lib/session_chk.php";
?>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/layout/inc/head.php"; ?>

<body>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/layout/inc/header.php"; ?>

    <ul class="tab">
        <li><a href="list.php">전문가 리스트</a></li>
        <li><a href="review_list.php">시공후기 리스트</a></li>
    </ul>

    <!--list-->
    <ul>
        <?php
            $sql = "SELECT * FROM review LEFT JOIN member ON review.member_link = member.member_uid";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result))
            {
        ?>
        <li>
            <div style="margin:30px;">
                <span style="padding-right:10px;"><b>전문가 이름 :</b> <?=$row['review_mname']?></span>
                <span style="padding-right:10px;"><b>전문가 아이디 :</b> <?=$row['review_mid']?></span>
                <span style="padding-right:10px;"><b>작성자 이름 :</b> <?=$row['member_name']?></span>
                <span style="padding-right:10px;"><b>작성자 아이디 :</b> <?=$row['member_id']?></span>
                <span style="padding-right:10px;"><b>비용 :</b> <?=$row['review_cost']?></span>
                <span style="padding-right:10px;"><b>내용 :</b> <?=$row['review_description']?></span>
                <span style="padding-right:10px;"><b>평점 :</b> <?=$row['review_grade']?></span>
            </div>
        </li>
        <?php
			}
		?>
    </ul>
    <!--list-->


</body>
</html>
