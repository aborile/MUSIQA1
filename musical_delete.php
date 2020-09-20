<?php
include "configs.php";    //데이터베이스 연결 설정파일
include "utils.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$title = $_GET['title'];

$ret = mysqli_query($conn, "delete from review where title = '$title'");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}

$ret = mysqli_query($conn, "delete from number where musical = '$title'");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}

$ret = mysqli_query($conn, "delete from casting where title = '$title'");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}

$ret = mysqli_query($conn, "delete from musical where title = '$title'");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=musical_list.php'>";
}

?>
