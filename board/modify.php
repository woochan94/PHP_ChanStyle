<?php
include "../db.php";

$bno = $_GET['idx'];
$sql = mq("select * from board where idx='$bno';");
$board = $sql->fetch_array();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>CHANSTYLE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Title Icon -->
    <link rel="icon" type="image/png" href="/ChanStyle/images/icons/title_icon.png"/>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/ChanStyle/css/basicstructure.css">
    <link rel="stylesheet" type="text/css" href="../css/board.css">
    <!-- BootStrap -->
    <link rel="stylesheet" type="text/css" href="/ChanStyle/vendor/bootstrap/css/bootstrap.min.css">
    <!-- semantic -->
    <link rel="stylesheet" type="text/css" href="/ChanStyle/vendor/semantic/semantic.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="/ChanStyle/vendor/semantic/semantic.js"></script>
    <!-- includeHTML -->
    <script src="/ChanStyle/js/includeHTML.js"></script>
</head>

<body>
<!-- Header -->
<header class="header" include-html="/ChanStyle/BasicHeader.php">

</header>

<main>
    <div class="container">
        <div class="row">
            <h4 style="width: 100%;" class="m-text17"> 글수정 </h4>
            <div id="board_write">
                <div id="write_area">
                    <form action="modify_ok.php/<?php echo $board['idx']; ?>" method="post">
                        <input type="hidden" name="idx" value="<?=$bno?>" />
                        <div id="in_title">
                            <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="100" required><?php echo $board['title']; ?></textarea>
                        </div>
                        <div class="wi_line"></div>
                        <div id="in_content">
                            <textarea name="content" id="ucontent" placeholder="내용" required><?php echo $board['content']; ?></textarea>
                        </div>
                        <div class="bt_se m-b-150">
                            <button class="btn_write m-text11" type="submit">글 수정</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<footer id="footer" class="bg3 p-t-50 p-b-20" include-html="/ChanStyle/BasicFooter.php">

</footer>
<script>
    includeHTML();
</script>
<script type="text/javascript" src="/ChanStyle/js/sidebar.js"></script>
</body>
</html>