<?
include "headers.php";
include "configs.php";    //데이터베이스 연결 설정파일
include "utils.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("actor_name", $_GET)) {
    $actor_name = $_GET["actor_name"];
    $query = "select * from actor natural left outer join casting where actor_name = '$actor_name'";
    $res = mysqli_query($conn, $query);
    $actor = mysqli_fetch_assoc($res);
    if (!$actor) {
        msg("해당 배우에 관한 정보가 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3><b><br>배우 정보 상세 보기<br><br></b></h3>

        <?
            echo "
                  <a href='actor_form.php?actor_name={$actor['actor_name']}'><button class='button primary small'>수정</button></a>
                  <button onclick='javascript:deleteConfirm(\"{$actor['actor_name']}\")' class='button danger small'>삭제</button>
                  ";
        ?>
        <p>
            <label for="actor_name">이름</label>
            <input readonly type="text" id="actor_name" name="actor_name" value="<?= $actor['actor_name'] ?>"/>
        </p>

        <p>
            <label for="debut">데뷔</label>
            <input readonly type="text" id="debut" name="debut" value="<?= $actor['debut'] ?>"/>
        </p>

        <p>
            <label for="production_name">소속사 </label><br>
            <?
            	if ($actor['agency'] == null){
            		echo "소속사 정보 없음.";
            	}
            	else {
	            	echo "
	            		 <a href='production_view.php?production_name={$actor['agency']}'>{$actor['agency']}</a>
	            		 ";
            	}
            ?>
        </p>

        <p>
            <label for="casting">출연 정보</label>
            <table class="table table-bordered">
		        <thead>
			        <tr>
			            <th>No.</th>
			            <th>작품 제목</th>
			            <th>삭제</th>
			        </tr>
		        </thead>
		        <tbody>
		        <?
        			$row_index = 1;
    				$res = mysqli_query($conn, $query);
			        while ($row = mysqli_fetch_array($res)) {
			        	if ($row['title'] != null){
				            echo "<tr>";
				            echo "<td>{$row_index}</td>";
				            echo "<td><a href='musical_view.php?title={$row['title']}'>{$row['title']}</a></td>";
				            echo "<td width='17%'>
				                  <button onclick='javascript:deleteConfirmCast(\"{$actor['actor_name']}\", \"{$row['title']}\")' class='button danger small'>삭제</button>
				                  </td>";
				            echo "</tr>";
			        	}
            			$row_index++;
			        }
		        ?>
		        </tbody>
		    </table>
	        <?
	            echo "<a href='cast_form.php?actor_name={$actor['actor_name']}'><button class='button primary small'>작품 등록</button></a>";
	        ?>
        </p>

    <script>
    	function deleteConfirm(name){
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "actor_delete.php?actor_name=" + name;
            }else{   //취소
                return;
            }
    	}
        function deleteConfirmCast(name, title) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "cast_delete.php?actor_name=" + name + "&title=" + title;
            }else{   //취소
                return;
            }
        }
    </script>
    </div>
<? include("footer.php") ?>
