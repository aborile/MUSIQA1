<?
include "headers.php";
include "configs.php";    //데이터베이스 연결 설정파일
include "utils.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("production_name", $_GET)) {
    $production_name = $_GET["production_name"];
    $query = "select * from production where production_name = '$production_name'";
    $res = mysqli_query($conn, $query);
    $production = mysqli_fetch_assoc($res);
    if (!$production) {
        msg("기획사가 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3><b><br>기획사 정보 상세 보기<br><br></b></h3>

        <p>
            <label for="production_name">기획사명</label>
            <input readonly type="text" id="production_name" name="production_name" value="<?= $production['production_name'] ?>"/>
        </p>
        <p>
            <label for="producer">대표</label>
            <input readonly type="text" id="producer" name="producer" value="<?= $production['producer'] ?>"/>
        </p>
        <p>
            <label for="phone">전화번호</label>
            <input readonly type="text" id="phone" name="phone" value="<?= $production['phone'] ?>"/>
        </p>
        <p>
            <label for="email">이메일</label>
            <input readonly type="text" id="email" name="email" value="<?= $production['email'] ?>"/>
        </p>

    </div>
<? include("footer.php") ?>
