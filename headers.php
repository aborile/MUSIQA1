<!DOCTYPE html>
<html lang='ko'>
<head>
    <title>MUSIQA1</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<form action="musical_list.php" method="post">
    <div class='navbar fixed'>
        <div class='container'>
            <a class='pull-left title' href="index.php">MusiQa1</a>
            <ul class='pull-right'>
                <li>
                    <input type="text" name="search_keyword" placeholder="뮤지컬정보검색">
                </li>
                <li><a href='musical_list.php'>뮤지컬 목록</a></li>
                <li><a href='review_list.php'>공연 후기</a></li>
                <li><a href='actor_list.php'>배우</a></li>
            </ul>
        </div>
    </div>
</form>
