<?php
include "configs.php";    //데이터베이스 연결 설정파일
include "utils.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$title = $_POST['title'];
$years = $_POST['years'];
$dates = $_POST['dates'];
$venue = $_POST['venue'];
$production_name = $_POST['production_name'];
$director = $_POST['director'];
$playwright = $_POST['playwright'];

$ret = mysqli_query($conn, "update musical set years = $years, dates = '$dates', venue = '$venue', production_name = '$production_name', director = '$director', playwright = '$playwright' where title = '$title'");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=musical_list.php'>";
}

?>
