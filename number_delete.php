<?php
include "configs.php";    //데이터베이스 연결 설정파일
include "utils.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$title = $_GET['number_title'];
$musical = $_GET['musical'];

$ret = mysqli_query($conn, "delete from number where number_title = '$title' and musical = '$musical'");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=musical_view.php?title={$musical}'>";
}

?>
