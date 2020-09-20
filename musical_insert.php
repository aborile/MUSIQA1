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

$ret = mysqli_query($conn, "insert into musical values('$title', '$years', '$dates', '$venue', '$production_name', '$director', '$playwright')");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=musical_list.php'>";
}

?>
