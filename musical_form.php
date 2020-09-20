<?
include "headers.php";
include "configs.php";    //데이터베이스 연결 설정파일
include "utils.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "musical_insert.php";

if (array_key_exists("title", $_GET)) {
    $title = $_GET["title"];
    $query =  "select * from musical where title = '$title'";
    $res = mysqli_query($conn, $query);
    $musical = mysqli_fetch_array($res);
    if(!$musical) {
        msg("뮤지컬이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "musical_modify.php";
}

$productions = array();

$query = "select * from production";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $productions[$row['production_name']] = $row['production_name'];
}
?>
    <div class="container">
        <form name="musical_form" action="<?=$action?>" method="post" class="fullwidth">
            <h3>뮤지컬 정보 <?=$mode?></h3>
            <p>
                <label for="title">뮤지컬 제목</label>
                <input type="text" placeholder="뮤지컬 제목 입력" id="title" name="title" value="<?=$musical['title']?>"/>
            </p>
            <p>
                <label for="years">연도</label>
                <input type="int" placeholder="개막 연도 정수로 입력" id="years" name="years" value="<?=$musical['years']?>"/>
            </p>
            <p>
                <label for="dates">공연기간</label>
                <input type="text" placeholder="YYYY.MM.DD-YYYY.MM.DD로 입력" id="dates" name="dates" value="<?=$musical['dates']?>"/>
            </p>
            <p>
                <label for="venue">극장</label>
                <input type="text" placeholder="극장 입력" id="venue" name="venue" value="<?=$musical['venue']?>"/>
            </p>
            <p>
                <label for="production_name">제작사/기획사</label>
                <select name="production_name" id="production_name">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($productions as $id => $name) {
                            if($id == $musical['production_name']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="director">연출가</label>
                <input type="text" placeholder="연출가 입력" id="director" name="director" value="<?=$musical['director']?>"/>
            </p>
            <p>
                <label for="title">극작가</label>
                <input type="text" placeholder="극작가 입력" id="playwright" name="playwright" value="<?=$musical['playwright']?>"/>
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                	if(document.getElementById("title").value == "") {
                        alert ("공연명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("production_name").value == "-1") {
                        alert ("기획사를 선택해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>
