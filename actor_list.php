<?
include "headers.php";
include "configs.php";    //데이터베이스 연결 설정파일
include "utils.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from actor";
    if (array_key_exists("search_actor", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_actor"];
        $query =  $query . " where actor_name like '%$search_keyword%'";

    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>
    <h3><b><br>배우 목록 <br><br></b></h3>
    <form action="actor_list.php" method="post">
    	<input type="text" name="search_actor" placeholder="배우정보검색">
    </form>
    <br><br>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>이름</th>
            <th>데뷔</th>
            <!--<th>기능</th>-->
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='actor_view.php?actor_name={$row['actor_name']}'>{$row['actor_name']}</a></td>";
            echo "<td>{$row['debut']}</td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <?
    echo "<a href='actor_form.php'><button class='button primary small'>등록</button></a>";
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
