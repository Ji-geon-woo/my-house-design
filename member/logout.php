<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/layout/lib/db_conn.php";

if($_SESSION['MID']!=''){
	session_unset();
	echo "
	<script>
	window.alert('로그아웃 되었습니다.');
	location.href='/layout/index.php'
	</script>
	";
}
?>
