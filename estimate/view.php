<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/layout/lib/db_conn.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/layout/lib/session_chk.php";
?>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/layout/inc/head.php"; ?>

<body>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/layout/inc/header.php"; ?>

    <ul class="tab">
        <li><a href="list.php">리스트</a></li>
        <li><a href="view.php">보낸 견적 리스트</a></li>
    </ul>
    
    <!--list-->
    <ul>
        <?php
            $mid = $_SESSION['Mindex'];
            $sql = "SELECT * FROM estimate LEFT JOIN member
            ON estimate.member_link = member.member_uid left JOIN master
            ON estimate.est_uid = master.estimate_link
            WHERE $mid = master.member_link";
            //$sql = "SELECT * FROM estimate ORDER BY est_uid";
            //SELECT * FROM 테이블이름 WHERE 조건 ORDER BY 컬럼이름 LIMIT 갯수
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result))
            {
        ?>
        <li style="margin:20px;">
            <span style="padding-right:10px;"><b>회원 이름 :</b> <?=$row['member_name']?></span>
            <span style="padding-right:10px;"><b>회원 아이디 :</b> <?=$row['member_id']?></span>
            <span style="padding-right:10px;"><b>시공일 :</b> <?=$row['est_date']?></span>
            <span style="padding-right:10px;"><b>내용 :</b> <?=$row['est_description']?></span>
            <span style="padding-right:10px;"><b>비용 :</b> <?=$row['mst_cost']?></span>
            <span style="padding-right:10px;"><b>상태 :</b> <?=$row['mst_state']?></span>
        </li>
        <?php
			}
		?>
    </ul>
    <!--list-->

</body>
</html>
