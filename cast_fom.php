<?
include "headers.php";
include "configs.php";    //데이터베이스 연결 설정파일
include "utils.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "cast_insert.php";

if (array_key_exists("actor_name", $_GET)){
	$actor_name = $_GET["actor_name"];
	$cast['actor_name'] = $actor_name;
}

$musicals = array();

$query = "select * from musical";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $musicals[$row['title']] = $row['title'];
}
?>
    <div class="container">
        <form name="musical_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="actor_name" value="<?=$cast['actor_name']?>"/>
            <h3>출연 정보 <?=$mode?></h3>
            <p>
                <label for="title">출연 작품</label>
                <select name="title" id="title">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($musicals as $id => $name) {
                            if($id == $cast['title']){
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
                	if(document.getElementById("title").value == "-1") {
                        alert ("출연 작품을 선택해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>
