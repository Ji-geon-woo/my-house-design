<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/layout/lib/db_conn.php";


$sql = "
  CREATE TABLE member (
    member_uid int(11) NOT NULL auto_increment COMMENT '번호',
    member_id varchar(100) NOT NULL COMMENT '아이디',
    member_name varchar(100) DEFAULT NULL COMMENT '이름',
    member_pw varchar(200) NOT NULL COMMENT '비밀번호',
    member_lv int(11) NOT NULL COMMENT '권한',
    member_pic varchar(200) NOT NULL COMMENT '회원사진',
    member_grade int(11) NOT NULL COMMENT '전문가 평점',
    PRIMARY KEY  (member_uid)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='회원정보';
";

$sql .= "
  CREATE TABLE onhouse (
    onh_uid int(11) NOT NULL auto_increment COMMENT '번호',
    onh_bef varchar(200) NOT NULL COMMENT 'Before',
    onh_aft varchar(200) NOT NULL COMMENT 'After',
    onh_description text NOT NULL COMMENT '노하우',
    onh_grade int(11) NOT NULL COMMENT '평점',
    onh_count int(11) NOT NULL COMMENT '횟수',
    onh_total int(11) NOT NULL COMMENT '총합',
    onh_regdate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '작성일',
    member_link int(11) NOT NULL COMMENT '멤버테이블',
    PRIMARY KEY  (onh_uid)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='온라인집들이';
";

$sql .= "
  CREATE TABLE review (
    review_uid int(11) NOT NULL auto_increment COMMENT '번호',
    review_cost varchar(200) NOT NULL COMMENT '비용',
    review_description text NOT NULL COMMENT '내용',
    review_grade int(11) NOT NULL COMMENT '평점',
    review_mid varchar(200) NOT NULL COMMENT '전문가 아이디',
    review_mname varchar(200) NOT NULL COMMENT '전문가 이름',
    member_link int(11) NOT NULL COMMENT '멤버테이블',
    PRIMARY KEY  (review_uid)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='시공후기';
";

$sql .= "
  CREATE TABLE estimate (
    est_uid int(11) NOT NULL auto_increment COMMENT '번호',
    est_date varchar(200) NOT NULL COMMENT '시공일',
    est_description text NOT NULL COMMENT '내용',
    est_state varchar(200) NOT NULL COMMENT '상태',
    est_count varchar(200) NOT NULL COMMENT '견적개수',
    est_select_mst varchar(200) NOT NULL COMMENT '선택 견적',
    est_select_cost varchar(200) NOT NULL COMMENT '선택 비용',
    est_select_state varchar(200) NOT NULL COMMENT '선택 여부',
    member_link int(11) NOT NULL COMMENT '멤버테이블',
    PRIMARY KEY  (est_uid)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='시공견적';
";

$sql .= "
  CREATE TABLE master (
    mst_uid int(11) NOT NULL auto_increment COMMENT '번호',
    mst_cost int(11) NOT NULL COMMENT '비용',
    mst_state varchar(200) NOT NULL COMMENT '상태',
    member_link int(11) NOT NULL COMMENT '멤버테이블',
    estimate_link int(11) NOT NULL COMMENT '견적테이블',
    PRIMARY KEY  (mst_uid)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='시공견적2';
";


$result = mysqli_multi_query($conn, $sql);
if($result === false){
  echo 'error';
  error_log(mysqli_error($conn));
} else {
  echo 'ok';
}

?>
