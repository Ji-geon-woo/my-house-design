<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/layout/lib/db_conn.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/layout/lib/session_chk.php";
?>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/layout/inc/head.php"; ?>

<body>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/layout/inc/header.php"; ?>

    <!--list-->
    <ul>
        <?php
            $sql = "SELECT * FROM onhouse LEFT JOIN member ON onhouse.member_link = member.member_uid";

            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result))
            {
                $row['onh_regdate'] = mb_substr($row['onh_regdate'], 0, 10); //닐짜 자르기
        ?>
        <li style="display:inline-block;">
            <div>
                <P><img src="/layout/online_house/uploads/<?=$row['onh_bef']?>" alt="" style="width:200px"></P>
                <P>Before 사진</P>
            </div>
            <div>
                <P><img src="/layout/online_house/uploads/<?=$row['onh_aft']?>" alt="" style="width:200px"></P>
                <P>After 사진</P>
            </div>
            <div>
                <P>작성자 이름 : <?=$row['member_name']?></P>
                <P>작성자 아이디 : <?=$row['member_id']?></P>
                <P>작성일 : <?=$row['onh_regdate']?></P>
                <P>평점 : <?=$row['onh_grade']?></P>
                <P>노하우 : <?=$row['onh_description']?></P>

                <?php
                if($row['member_id']==$_SESSION['MID']){
                ?>

                <?php
                } else {
                ?>
                    <p><input type="button" value="평점주기" class="btn_grade"></p>
                <?php
                }
                ?>


            </div>
        </li>
        <?php
			}
		?>
    </ul>

    <br />
    <br />
    <br />

    <input type="button" value="글작성" id="btn_write">

    <br />
    <br />
    <br />
    <!--list-->


    <!--write-->
    <div id="write_table" class="modal">
        <button class="modal_close">닫기</button>
        <form name="frm_write" action="frm_write" method="post" enctype="multipart/form-data">
        <table>
        	<colgroup>
        		<col width="200px" />
        		<col width="*" />
        	</colgroup>
        	<tbody>
        		<tr>
        			<th scope="row">Before 사진</th>
        			<td><input type="file" name="userfile[]" id="before"></td>
        		</tr>
        		<tr>
        			<th scope="row">After 사진</th>
        			<td><input type="file" name="userfile[]" id="after"></td>
        		</tr>
        		<tr>
        			<th scope="row">노하우</th>
        			<td><textarea name="onh_description" id="onh_description" style="width:100%; height:100px;"></textarea></td>
        		</tr>
        	</tbody>
        </table>
        <!--button-->
        <div>
        	<input type="button" value="작성완료" id="submit_write">
        </div>
        <!--//button-->
        </form>
    </div>
    <!--//write-->


    <!--grade-->
    <div id="grade_table" class="modal">
        <button class="modal_close">닫기</button>
    	<form name="frm_grade" action="frm_grade" method="post">
        <input type="hidden" name="onh_uid" id="onh_uid" value="">
    	<table>
    		<colgroup>
    			<col width="200px" />
    			<col width="*" />
    		</colgroup>
    		<tbody>
    			<tr>
    				<th scope="row">평점주기</th>
    				<td>
    					<select name="in_grade" id="in_grade">
    						<option value="1">1점</option>
    						<option value="2">2점</option>
    						<option value="3">3점</option>
    						<option value="4">4점</option>
    						<option value="5">5점</option>
    					</select>
    				</td>
    			</tr>
    		</tbody>
    	</table>
        <!--button-->
        <div>
            <input type="button" value="완료" id="submit_grade">
        </div>
        <!--//button-->
    	</form>
    </div>
    <!--//grade-->

	<script type="text/javascript">
        //modal
        $('#btn_write').click(function(){
            modal_open();
            $('#write_table').addClass('modal_on');
        });

        $('.btn_grade').click(function(){
            var liNum = $(this).closest('li').prevAll().length;
            var postNum = liNum + 1;
            console.log(postNum);
            $('#onh_uid').val(postNum);

            modal_open();
            $('#grade_table').addClass('modal_on');
    	});

        //글작성 체크
        $(function write() {
            $('#submit_write').click(function(){
                if(!chkForm('before', 'Before 사진을', 'input', '2')) return;
                if(!chkForm('after', 'After 사진을', 'input', '2')) return;
        		if(!chkForm('onh_description', '노하우를', 'input', '1')) return;
        		document.frm_write.action="write_post.php";
        		document.frm_write.submit();
        	});
        });

        //평점 체크
        $('#submit_grade').click(function(){
            document.frm_grade.action="grade_post.php";
            document.frm_grade.submit();
        });
	</script>
	<!--//write-->

</body>
</html>
