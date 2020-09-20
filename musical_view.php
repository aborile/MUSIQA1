<?
include "headers.php";
include "configs.php";    //데이터베이스 연결 설정파일
include "utils.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("title", $_GET)) {
    $title = $_GET["title"];
    $query = "select * from musical where title = '$title'";
    $res = mysqli_query($conn, $query);
    $musical = mysqli_fetch_assoc($res);
    if (!$musical) {
        msg("공연이 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3><b><br>공연 정보 상세 보기<br><br></b></h3>

        <?
            echo "
                  <a href='musical_form.php?title={$musical['title']}'><button class='button primary small'>수정</button></a>
                  <button onclick='javascript:deleteConfirm(\"{$musical['title']}\")' class='button danger small'>삭제</button>
                  ";
        ?>
        <p>
            <label for="title">공연 제목</label>
            <input readonly type="text" id="title" name="title" value="<?= $musical['title'] ?>"/>
        </p>

        <p>
            <label for="years">연도</label>
            <input readonly type="number" id="years" name="years" value="<?= $musical['years'] ?>"/>
        </p>

        <p>
            <label for="dates">공연 기간</label>
            <input readonly type="text" id="dates" name="dates" value="<?= $musical['dates'] ?>"/>
        </p>

        <p>
            <label for="venue">극장</label>
            <input readonly type="text" id="venue" name="venue" value="<?= $musical['venue'] ?>"/>
        </p>

        <p>
            <label for="production_name">제작사/기획사 </label><br>
            <?
            	echo "
            		 <a href='production_view.php?production_name={$musical['production_name']}'>{$musical['production_name']}</a>
            		 ";
            ?>
        </p>

        <p>
            <label for="director">연출가</label>
            <input readonly type="text" id="director" name="director" value="<?= $musical['director'] ?>"/>
        </p>

        <p>
            <label for="playwright">극본가</label>
            <input readonly type="text" id="playwright" name="playwright" value="<?= $musical['playwright'] ?>"/>
        </p>

        <p>
            <label for="number">넘버</label>
            <table class="table table-bordered">
		        <thead>
			        <tr>
			            <th>No.</th>
			            <th>넘버 제목</th>
			        </tr>
		        </thead>
		        <tbody>
		        <?
					$musical_title = $musical['title'];
					$num_query = "select * from number where musical = '$musical_title' order by song_num";
					$num_res = mysqli_query($conn, $num_query);
			        while ($num = mysqli_fetch_array($num_res)) {
			            echo "<tr>";
			            echo "<td>{$num['song_num']}</td>";
			            echo "<td><a href='number_view.php?number_title={$num['number_title']}&musical={$num['musical']}'>{$num['number_title']}</a></td>";
			            echo "</tr>";
			        }
		        ?>
		        </tbody>
		    </table>
	        <?
	            echo "<a href='number_form.php?title={$musical['title']}'><button class='button primary small'>넘버 등록</button></a>";
	        ?>
        </p>

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
