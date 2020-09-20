<?php
include "configs.php";    //데이터베이스 연결 설정파일
include "utils.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$musical_title = $_POST['title'];
$writerID = $_POST['writerID'];
$review_title = $_POST['review_title'];
$grade = $_POST['grade'];
$content = $_POST['content'];

$ret = mysqli_query($conn, "insert into review values('$musical_title', '$writerID', '$review_title', $grade, '$content')");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=review_list.php'>";
}

?>
