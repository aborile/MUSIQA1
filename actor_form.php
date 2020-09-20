<?
include "headers.php";
include "configs.php";    //데이터베이스 연결 설정파일
include "utils.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "actor_insert.php";

if (array_key_exists("actor_name", $_GET)) {
    $actor_name = $_GET["actor_name"];
    $query =  "select * from actor where actor_name = '$actor_name'";
    $res = mysqli_query($conn, $query);
    $actor = mysqli_fetch_array($res);
    if(!$actor) {
        msg("해당 배우에 대한 정보가 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "actor_modify.php";
}

$productions = array();

$query = "select * from production";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $productions[$row['production_name']] = $row['production_name'];
}
?>
    <div class="container">
        <form name="actor_form" action="<?=$action?>" method="post" class="fullwidth">
            <h3>배우 정보 <?=$mode?></h3>
            <p>
                <label for="actor_name">이름</label>
                <input type="text" placeholder="이름 입력" id="actor_name" name="actor_name" value="<?=$actor['actor_name']?>"/>
            </p>
            <p>
                <label for="debut">데뷔</label>
                <input type="text" placeholder="데뷔년도 입력" id="debut" name="debut" value="<?=$actor['debut']?>"/>
            </p>
            <p>
                <label for="agency">소속사</label>
                <select name="agency" id="production_name">
                    <option value="-1">소속사 정보 없음</option>
                    <?
                        foreach($productions as $id => $name) {
                            if($id == $actor['agency']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                	if(document.getElementById("actor_name").value == "") {
                        alert ("배우 이름을 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>
