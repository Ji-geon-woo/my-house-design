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
            $sql = "SELECT * FROM member WHERE member_lv='1'";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result))
            {
        ?>
        <li style="display:inline-block;">
            <P><img src="/layout/member/uploads/<?=$row['member_pic']?>" alt="" style="width:200px"></P>
            <P>이름 : <?=$row['member_name']?></P>
            <P>아이디 : <?=$row['member_id']?></P>
            <P>평점 : <?=$row['member_grade']?></P>
            <p><input type="button" value="후기작성" class="btn_write"></p>
        </li>
        <?php
			}
		?>
    </ul>
    <!--list-->

    <!--write-->
    <div id="write_table" class="modal">
        <button class="modal_close">닫기</button>
    	<form name="frm_write" action="frm_write" method="post">
            <input type="hidden" name="member_uid" id="member_uid" value="">
        	<table>
        		<colgroup>
        			<col width="200px" />
        			<col width="*" />
        		</colgroup>
        		<tbody>
                    <tr>
                        <th scope="row">비용</th>
                        <td><input type="text" name="review_cost" id="review_cost"></td>
                    </tr>
        			<tr>
        				<th scope="row">내용</th>
        				<td><textarea name="review_description" id="review_description" style="width:100%; height:100px;"></textarea></td>
        			</tr>
                    <tr>
        				<th scope="row">평점</th>
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
            <div>
        		<input type="button" value="작성완료" id="submit_write">
        	</div>
    	</form>
    </div>
	<!--//write-->

    <script type="text/javascript">
        $('.btn_write').click(function(){
            var liNum = $(this).closest('li').prevAll().length;
            var postNum = liNum + 1;
            console.log(postNum);
            $('#member_uid').val(postNum);

            modal_open();
            $('#write_table').addClass('modal_on');
        });

        $(function write() {

            var Regex_num = /^[0-9]/g; //숫자만

            $('#submit_write').click(function(){
                if(!chkForm('review_cost', '비용을', 'input', '2')) return;
                // 비용 검사
                if ( !Regex_num.test($.trim($("#review_cost").val())) )
                {
                    alert("숫자만 입력하세요.");
                    $("#review_cost").focus();
                    return false;
                }

                if(!chkForm('review_description', '내용을', 'input', '1')) return;
                document.frm_write.action="write_post.php";
                document.frm_write.submit();
        	});
        });
	</script>


</body>
</html>
