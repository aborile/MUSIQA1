<?php
include "configs.php";    //데이터베이스 연결 설정파일
include "utils.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$actor_name = $_GET['actor_name'];

$ret = mysqli_query($conn, "delete from casting where actor_name = '$actor_name'");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}

$ret = mysqli_query($conn, "delete from actor where actor_name = '$actor_name'");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=actor_list.php'>";
}

?>
