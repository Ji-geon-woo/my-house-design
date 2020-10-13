// form check
var chkForm = function(objs,titles,types,minlens){
    var objs = document.getElementById(objs);
    var typesmsg = '';
    var objsTrim = $.trim(objs.value);

    if(types=='input') typesmsg = ' 입력해';
    else if(types=='select') typesmsg = ' 선택해';

    if(objsTrim==""){
        alert(titles+typesmsg+'주세요.','')
        if(objs.type!="textarea"){
            objs.focus();
        }
        return false;
    }
    if(minlens!=0&&objsTrim.length<minlens){
        alert(titles+ " 최소 "+minlens+"자리 이상으로 기입해주세요.");
        if(objs.type!="textarea"){
            objs.focus();
        }
        return false;
    }
    return true;
}

//modal_open
var modal_open = function(){
    $('#blank_layer').css('display','block');
    $('body').addClass('no_scroll');
}

//modal_close
var modal_close = function(){
    $('#blank_layer').css('display','none');
    $('.modal').removeClass('modal_on');
    $('body').removeClass('no_scroll');
}


$(function () {

    //아이디 중복 체크
    $(".check").on("keyup", function(){ //check라는 클래스에 입력을 감지
        var self = $(this);
        var member_id_join;
        if(self.attr("id") === "member_id_join"){
            member_id_join = self.val();
        }

        $.post( //post방식으로 id_check.php에 입력한 userid값을 넘깁니다
            "/layout/member/id_check.php",
            { member_id_join : member_id_join },
            function(data){
                if(data){ //만약 data값이 전송되면
                    self.parent().find('.check_text').html(data); //div태그를 찾아 html방식으로 data를 뿌려줍니다.
                    // self.parent().find("div").css("color", "#F00"); //div 태그를 찾아 css효과로 빨간색을 설정합니다
                }
            }
        );
    });

    //모달 닫기 이벤트
    $('.modal_close').click(function(){
        modal_close();
    });

});
