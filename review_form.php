<?
include "headers.php";
include "configs.php";    //데이터베이스 연결 설정파일
include "utils.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "review_insert.php";

$musicals = array();

$query = "select * from musical";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $musicals[$row['title']] = $row['title'];
}
?>
    <div class="container">
        <form name="review_form" action="<?=$action?>" method="post" class="fullwidth">
            <h3>후기 작성 <?=$mode?></h3>
            <p>
                <label for="review_title">제목</label>
                <input type="text" placeholder="제목 입력" id="review_title" name="review_title" value="<?=$review['review_title']?>"/>
            </p>
            <p>
                <label for="writerID">작성자</label>
                <input type="text" placeholder="작성자 ID" id="writerID" name="writerID" value="<?=$review['writerID']?>"/>
            </p>
            <p>
                <label for="title">뮤지컬</label>
                <select name="title" id="title">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($musicals as $id => $name) {
                            if($id == $review['title']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="grade">평점</label>
                <input type="int" placeholder="1 ~ 5의 정수값을 입력" id="grade" name="grade" value="<?=$review['grade']?>"/>
            </p>
            <p>
                <label for="content">내용</label>
                <textarea placeholder="상세후기 작성" id="content" name="content" rows="10"><?=$review['content']?></textarea>
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                	if(document.getElementById("review_title").value == "") {
                        alert ("후기 제목을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("writerID").value == "") {
                        alert ("작성자 ID를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("title").value == "-1") {
                        alert ("후기를 작성할 뮤지컬을 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("grade").value == null) {
                        alert ("평점을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("content").value == "") {
                        alert ("내용을 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>
