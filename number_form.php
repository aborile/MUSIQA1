<?
include "headers.php";
include "configs.php";    //데이터베이스 연결 설정파일
include "utils.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "number_insert.php";

if (array_key_exists("number_title", $_GET)) {
    $title = $_GET["number_title"];
    $musical = $_GET["musical"];
    $query =  "select * from number where number_title = '$title' and musical = '$musical'";
    $res = mysqli_query($conn, $query);
    $number = mysqli_fetch_array($res);
    if(!$number) {
        msg("넘버가 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "number_modify.php";
}
else if (array_key_exists("title", $_GET)){
	$musical = $_GET["title"];
	$number['musical'] = $musical;
}
$musicals = array();

$query = "select * from musical";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $musicals[$row['title']] = $row['title'];
}
?>
    <div class="container">
        <form name="product_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="musical" value="<?=$number['musical']?>"/>
            <h3>넘버 정보 <?=$mode?></h3>
            <p>
                <label for="number_title">넘버 제목</label>
                <input type="text" placeholder="넘버 제목 입력" id="number_title" name="number_title" value="<?=$number['number_title']?>"/>
            </p>
            <p>
                <label for="song_num">넘버 순서</label>
                <input type="int" placeholder="정수 입력" id="song_num" name="song_num" value="<?=$number['song_num']?>"/>
            </p>
            <p>
                <label for="composer">작곡가</label>
                <input type="text" placeholder="작곡가 입력" id="composer" name="composer" value="<?=$number['composer']?>"/>
            </p>
            <p>
                <label for="lyrics">가사</label>
                <textarea placeholder="가사 입력" id="lyrics" name="lyrics" rows="10"><?=$number['lyrics']?></textarea>
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                	if(document.getElementById("number_title").value == "") {
                        alert ("넘버 제목을 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>
