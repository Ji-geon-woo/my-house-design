<div id="blank_layer"></div>

<header id="header">
    <nav>
        <ul>
            <li>
                <a href="/Layout/index.php">홈</a>
            </li>
            <li>
                <a href="/Layout/online_house/list.php">온라인집들이</a>
            </li>
            <li>
                <a href="/Layout/master/list.php">전문가</a>
            </li>
            <li>
                <a href="/Layout/estimate/list.php">시공견적</a>
            </li>
            <?php
            if($_SESSION['MID']==''){
            ?>
            <li>
                <a href="#;"id="btn_login">로그인</a>
            </li>
            <li>
                <a href="#;" id="btn_join">회원가입</a>
            </li>
            <?php
            } else {
            ?>
            <li>
                <a href="/Layout/member/logout.php">로그아웃</a>
            </li>
            <?php
            }
            ?>
        </ul>
    </nav>
</header>

<!--login-->
<div id="login_form" class="modal">
    <button class="modal_close">닫기</button>
    <form name="frm_login" action="frm_login" method="post">
    <fieldset>
        <dl>
            <dt>아이디</dt>
            <dd><input type="text" name="member_id" id="member_id"></dd>
        </dl>
        <dl>
            <dt>비밀번호</dt>
            <dd><input type="password" name="member_pw" id="member_pw"></dd>
        </dl>
        <input type="button" value="로그인" id="submit_login">
    </fieldset>
    </form>
</div>
<!--//login-->


<!--join-->
<div id="join_form" class="modal">
    <button class="modal_close">닫기</button>
    <form name="frm_join" action="frm_join" method="post" enctype="multipart/form-data">
    <fieldset>
        <dl>
            <dt>아이디</dt>
            <dd>
                <input type="text" name="member_id_join" id="member_id_join" class="check">
                <div class="check_text"></div>
            </dd>
        </dl>
        <dl>
            <dt>비밀번호</dt>
            <dd><input type="password" name="member_pw_join" id="member_pw_join"></dd>
        </dl>
        <dl>
            <dt>이름</dt>
            <dd><input type="text" name="member_name" id="member_name"></dd>
        </dl>
        <dl>
            <dt>사진</dt>
            <dd><input type="file" name="userfile[]"></dd>
        </dl>
        <dl>
            <dt><img src="/layout/images/code/code_1.gif" id="captcha_img" alt="a15vde90"></dt>
            <dd><input type="text" id="captcha_input"></dd>
        </dl>
        <input type="button" value="회원가입" id="submit_join">
    </fieldset>
    </form>
</div>
<!--//join-->

<script type="text/javascript">
    //modal
    $('#btn_login').click(function(){
        modal_open();
        $('#login_form').addClass('modal_on');
    });

    $('#btn_join').click(function(){
        modal_open();
        $('#join_form').addClass('modal_on');
    });

    //로그인폼 체크
    $(function logIn() {
    	$('#submit_login').click(function(){
    		if(!chkForm('member_id', '아이디를', 'input', '2')) return;
    		if(!chkForm('member_pw', '비밀번호를', 'input', '4')) return;
            document.frm_login.action="/layout/member/login_post.php";
            document.frm_login.submit();
    	});
    });

    //회원가입폼 체크
    $(function join() {

        var Regex_1 = /^[가-힣]{2,4}$/; //한글만 2~4자 사이
        var Regex_2 = /^[a-z0-9_-]{2,12}$/; //영문, 숫자
        var Regex_3 = /^[ㄱ-ㅎ|가-힣|a-z|A-Z|0-9|\*]+$/; //한글, 영문, 숫자

    	$('#submit_join').click(function(){

            var captcha_img = $('#captcha_img').attr('alt');
            var captcha_input = $('#captcha_input').val();

            // 아이디 검사
            if(!chkForm('member_id_join', '아이디를', 'input', '2')) return;
            if ( !Regex_2.test($.trim($("#member_id_join").val())) )
            {
                alert("아이디는 2~12자 사이의 영문소문자와 숫자만 가능합니다");
                $("#member_id_join").focus();
                return false;
            }

            // 비밀번호 검사
            if(!chkForm('member_pw_join', '비밀번호를', 'input', '4')) return;

            // 이름 검사
            if(!chkForm('member_name', '이름을', 'input', '2')) return;
            if ( !Regex_3.test($.trim($("#member_name").val())) )
            {
                alert("잘못된 이름입니다.");
                $("#member_name").focus();
                return false;
            }

            // captcha 검사
            if(!chkForm('captcha_input', 'captcha를', 'input', '2')) return;
            if ( captcha_img != captcha_input )
            {
                alert("잘못된 captcha입니다.");
                $("#captcha_input").focus();
                return false;
            }

            document.frm_join.action="/layout/member/join_post.php";
            document.frm_join.submit();
    	});
    });
</script>
