<?
include "headers.php";
include "configs.php";    //데이터베이스 연결 설정파일
include "utils.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from review";
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>
	<h3><b><br>후기 <br><br></b></h3>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>공연 제목</th>
            <th>후기</th>
            <th>평점</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='review_view.php?title={$row['title']}&writerID={$row['writerID']}'>{$row['title']}</a></td>";
            echo "<td>{$row['review_title']}</td>";
            echo "<td>{$row['grade']}</td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <?
    echo "<a href='review_form.php'><button class='button primary small'>후기 작성</button></a>";
    ?>
</div>
<? include("footer.php") ?>
