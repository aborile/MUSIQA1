<?
include "headers.php";
include "configs.php";    //데이터베이스 연결 설정파일
include "utils.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("title", $_GET) && array_key_exists("writerID", $_GET)) {
    $musical_title = $_GET["title"];
    $writerID = $_GET["writerID"];
    $query = "select * from review where title = '$musical_title' and writerID = '$writerID'";
    $res = mysqli_query($conn, $query);
    $review = mysqli_fetch_assoc($res);
    if (!$review) {
        msg("후기가 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3><b><br>상세 후기 <br><br></b></h3>

        <p>
            <label for="review_title">제목</label>
            <input readonly type="text" id="review_title" name="review_title" value="<?= $review['review_title'] ?>"/>
        </p>

        <p>
            <label for="writerID">작성자</label>
            <input readonly type="text" id="writerID" name="writerID" value="<?= $review['writerID'] ?>"/>
        </p>

        <p>
            <label for="title">뮤지컬</label>
            <input readonly type="text" id="musical_title" name="musical_title" value="<?= $review['title'] ?>"/>
        </p>

        <p>
            <label for="grade">평점</label>
            <input readonly type="int" id="grade" name="grade" value="<?= $review['grade'] ?>"/>
        </p>

        <p>
            <label for="content">내용</label>
            <textarea readonly id="content" name="content" rows="15"><?= $review['content'] ?></textarea>
        </p>
    </div>
<? include("footer.php") ?>
