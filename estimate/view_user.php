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
        <form name="frm" action="frm" method="post">
        <?php
            $parameter = $_GET['id'];
            $sql = "SELECT * FROM estimate LEFT JOIN member
            ON estimate.member_link = member.member_uid left JOIN master
            ON estimate.est_uid = master.estimate_link
            WHERE $parameter = master.estimate_link";
            //$sql = "SELECT * FROM estimate ORDER BY est_uid";
            //SELECT * FROM 테이블이름 WHERE 조건 ORDER BY 컬럼이름 LIMIT 갯수
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result))
            {
        ?>
        <li style="margin:20px;">
            <input type="hidden" name="mst_link" id="mst_link" value="<?=$row['estimate_link']?>">
            <span style="padding-right:10px;"><b>전문가 이름 :</b> <?=$row['member_name']?></span>
            <span style="padding-right:10px;"><b>전문가 아이디 :</b> <?=$row['member_id']?></span>
            <span style="padding-right:10px;"><b>비용 :</b> <?=$row['mst_cost']?></span>
            <?php
            if($row['mst_state'] == "진행중") {
            ?>
                <input type="button" value="선택" class="btn_sel">
            <?php
            }
            ?>

        </li>
        <?php
			}
		?>
        </from>
    </ul>
    <!--list-->

    <script type="text/javascript">
	$(function () {
        $('.btn_sel').click(function(){
			document.frm.action="user_post.php";
			document.frm.submit();
		});
	});
	</script>


</body>
</html>
