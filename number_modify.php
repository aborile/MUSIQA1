<?php
include "configs.php";    //데이터베이스 연결 설정파일
include "utils.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$title = $_POST['number_title'];
$musical = $_POST['musical'];
$song_num = $_POST['song_num'];
$composer = $_POST['composer'];
$lyrics = $_POST['lyrics'];

$ret = mysqli_query($conn, "update number set song_num = $song_num, composer = '$composer', lyrics = '$lyrics' where number_title = '$title' and musical = '$musical'");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=number_view.php?number_title={$title}&musical={$musical}'>";
}

?>
