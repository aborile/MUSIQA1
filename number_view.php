<?
include "headers.php";
include "configs.php";    //데이터베이스 연결 설정파일
include "utils.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("number_title", $_GET) && array_key_exists("musical", $_GET)) {
    $number_title = $_GET["number_title"];
    $musical = $_GET["musical"];
    $query = "select * from number where number_title = '$number_title' and musical = '$musical'";
    $res = mysqli_query($conn, $query);
    $number = mysqli_fetch_assoc($res);
    if (!$number) {
        msg("넘버가 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3><b><br>넘버 정보 상세 보기<br><br></b></h3>
        <p>
            <label for="number_title">넘버 제목</label>
            <input readonly type="text" id="number_title" name="number_title" value="<?= $number['number_title'] ?>"/>
        </p>
        <p>
            <label for="composer">작곡가</label>
            <input readonly type="text" id="composer" name="composer" value="<?= $number['composer'] ?>"/>
        </p>
        <p>
            <label for="lyrics">가사</label>
            <textarea readonly id="lyrics" name="lyrics" rows="15"><?= $number['lyrics'] ?></textarea>
        </p>

        <?
            echo "
                  <a href='number_form.php?number_title={$number['number_title']}&musical={$number['musical']}'><button class='button primary small'>수정</button></a>
                  <button onclick='javascript:deleteConfirm(\"{$number['number_title']}\", \"{$number['musical']}\")' class='button danger small'>삭제</button>
                  <a href='musical_view.php?title={$number['musical']}'><button class='button small'>목록</button></a>
                  ";
        ?>

    <script>
        function deleteConfirm(title, musical) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "number_delete.php?number_title=" + title + "&musical=" + musical;
            }else{   //취소
                return;
            }
        }
    </script>
    </div>
<? include("footer.php") ?>
