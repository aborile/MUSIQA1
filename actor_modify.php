<?php
include "configs.php";    //데이터베이스 연결 설정파일
include "utils.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$actor_name = $_POST['actor_name'];
$debut = $_POST['debut'];
$agency = $_POST['agency'];

if ($agency == -1){
	$ret = mysqli_query($conn, "update actor set debut = '$debut', agency = null where actor_name = '$actor_name'");
}
else {
	$ret = mysqli_query($conn, "update actor set debut = '$debut', agency = '$agency' where actor_name = '$actor_name'");
}


if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=actor_view.php?actor_name={$actor_name}'>";
}

?>
