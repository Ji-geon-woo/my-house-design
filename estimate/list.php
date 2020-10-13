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
            $sql = "SELECT * FROM estimate LEFT JOIN member ON estimate.member_link = member.member_uid";
            //$sql = "SELECT * FROM estimate ORDER BY est_uid";
            //SELECT * FROM 테이블이름 WHERE 조건 ORDER BY 컬럼이름 LIMIT 갯수
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result))
            {
        ?>
        <li style="margin:20px;">
            <span style="padding-right:10px;"><b>작성자 이름 :</b> <?=$row['member_name']?></span>
            <span style="padding-right:10px;"><b>작성자 아이디 :</b> <?=$row['member_id']?></span>
            <span style="padding-right:10px;"><b>시공일 :</b> <?=$row['est_date']?></span>
            <span style="padding-right:10px;"><b>내용 :</b> <?=$row['est_description']?></span>
            <span style="padding-right:10px;"><b>상태 :</b> <?=$row['est_state']?></span>
            <span style="padding-right:10px;"><b>견적개수 :</b> <?=$row['est_count']?></span>
            <span style="padding-right:10px;"><b>버튼:</b>
                <?php
                if($row['member_id']==$_SESSION['MID']){
                ?>
                    <a href="view_user.php?id=<?=$row['est_uid']?>">견적보기</a>
                <?php
                }
                if($_SESSION['MLV']==1 && $row['est_state'] == "진행중" && $row['member_id']!==$_SESSION['MID']) {
                ?>
                    <input type="button" value="견적보내기" class="btn_post" id="est_<?=$row['est_uid']?>">
                <?php
                }
                ?>
            </span>
        </li>
        <?php
			}
		?>
        <p><input type="button" value="견적요청" id="btn_write"></p>
    </ul>
    <!--list-->

    <!--write-->
    <div id="write_table" class="modal">
        <button class="modal_close">닫기</button>
    	<form name="frm_write" action="frm_write" method="post">
        	<table>
        		<colgroup>
        			<col width="200px" />
        			<col width="*" />
        		</colgroup>
        		<tbody>
                    <tr>
                        <th scope="row">시공일</th>
                        <td>
                            <input type="text" name="in_year" id="in_year" size="4" maxlength="4" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');"/>년
                            <input type="text" name="in_month" id="in_month" size="4" maxlength="2" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');"/>월
                            <input type="text" name="in_day" id="in_day" size="4" maxlength="2" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');"/>일
                        </td>
                    </tr>
        			<tr>
        				<th scope="row">내용</th>
        				<td><textarea name="est_description" id="est_description" style="width:100%; height:100px;"></textarea></td>
        			</tr>
        		</tbody>
        	</table>
        	<!--button-->
        	<div>
        		<input type="button" value="작성완료" id="btn_submit">
        	</div>
        	<!--//button-->
        </form>
    </div>
	<!--//write-->

    <!--write2-->
    <div id="write_table2" class="modal">
        <button class="modal_close">닫기</button>
    	<form name="frm_write2" action="frm_write2" method="post">
            <input type="hidden" name="est_uid" id="est_uid" value="">
        	<table>
        		<colgroup>
        			<col width="200px" />
        			<col width="*" />
        		</colgroup>
        		<tbody>
                    <tr>
                        <th scope="row">비용</th>
                        <td><input type="text" name="mst_cost" id="mst_cost"></td>
                    </tr>
        		</tbody>
        	</table>
        	<!--button-->
        	<div>
        		<input type="button" value="입력완료" id="btn_submit2">
        	</div>
        	<!--//button-->
        </form>
    </div>
	<!--//write2-->

    <script type="text/javascript">
        //modal
        $('#btn_write').click(function(){
            modal_open();
            $('#write_table').addClass('modal_on');
        });

        $('.btn_post').click(function(){
            var liNum = $(this).attr('id');
            var array = liNum.split("_");
            var postNum = array[1];
            console.log(postNum);
            $('#est_uid').val(postNum);

            modal_open();
            $('#write_table2').addClass('modal_on');
    	});

        //write1 체크
        $(function write() {

            $('#btn_submit').click(function(){
                if(!chkForm('in_year', '시공일 연도를', 'input', '4')) return;
                if(!chkForm('in_month', '시공일 월을', 'input', '1')) return;
                if(!chkForm('in_day', '시공일 일을', 'input', '1')) return;

                if(!chkForm('est_description', '내용을', 'input', '1')) return;
                document.frm_write.action="write_post.php";
        		document.frm_write.submit();
        	});
        });

        //write2 체크
        $(function write2() {
            var Regex_num = /^[0-9]/g; //숫자만

            $('#btn_submit2').click(function(){
                if(!chkForm('mst_cost', '비용을', 'input', '2')) return;
                // 비용 검사
                if ( !Regex_num.test($.trim($("#mst_cost").val())) )
                {
                    alert("숫자만 입력하세요.");
                    $("#mst_cost").focus();
                    return false;
                }

                document.frm_write2.action="write_post2.php";
        		document.frm_write2.submit();
        	});
        });

	</script>

</body>
</html>
