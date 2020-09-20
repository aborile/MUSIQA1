<?
include "headers.php";
include "configs.php";    //데이터베이스 연결 설정파일
include "utils.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from musical";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where title like '%$search_keyword%'";

    }
    $query = $query . " order by dates";
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>
	<h3><b><br>뮤지컬 목록 <br><br></b></h3>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>제목</th>
            <th>연도</th>
            <th>공연 기간</th>
            <th>극장</th>
            <!--<th>기능</th>-->
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='musical_view.php?title={$row['title']}'>{$row['title']}</a></td>";
            echo "<td>{$row['years']}</td>";
            echo "<td>{$row['dates']}</td>";
            echo "<td>{$row['venue']}</td>";
            // echo "<td width='17%'>
            //       <a href='musical_form.php?title={$row['title']}'><button class='button primary small'>수정</button></a>
            //       <button onclick='javascript:deleteConfirm(\"{$row['title']}\")' class='button danger small'>삭제</button>
            //       </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <?
    echo "<a href='musical_form.php'><button class='button primary small'>등록</button></a>";
    ?>
    <script>
        function deleteConfirm(title) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "musical_delete.php?title=" + title;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
