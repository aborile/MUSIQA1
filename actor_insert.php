<?php
include "configs.php";    //데이터베이스 연결 설정파일
include "utils.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$actor_name = $_POST['actor_name'];
$debut = $_POST['debut'];
$agency = $_POST['agency'];

if ($agency == -1) {
	$ret = mysqli_query($conn, "insert into actor values('$actor_name', '$debut', null)");
}
else {
	$ret = mysqli_query($conn, "insert into actor values('$actor_name', '$debut', '$agency')");
}
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=actor_list.php'>";
}

?>
