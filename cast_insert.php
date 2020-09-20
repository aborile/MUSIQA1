<?php
include "configs.php";    //데이터베이스 연결 설정파일
include "utils.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$actor_name = $_POST['actor_name'];
$title = $_POST['title'];

$ret = mysqli_query($conn, "insert into casting values('$actor_name', '$title')");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=actor_view.php?actor_name={$actor_name}'>";
}

?>
