<?php
include "../db.php";
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
            <h4 style="width: 100%;" class="m-text17"> 글쓰기 </h4>
            <div id="board_write">
                <div id="write_area">
                    <form action="write_ok.php" method="post" enctype="multipart/form-data"> <!-- multipart/form-data -> 기존 post방식에서 데이터 전송하는 용량보다 더 큰 용량을 전송할 수 있게 해줌 -->
                        <div id="in_title">
                            <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" required style="overflow: hidden;"></textarea>
                        </div>
                        <div class="wi_line"></div>
                        <div id="in_content">
                            <textarea name="content" id="ucontent" placeholder="내용" required></textarea>
                        </div>
                        <div class="m-t-20">
                            <input name="lockpost" class = "cb_lock" value="1" type="checkbox" onclick="input_disable(this.form)"> <span class="p-l-15" style="font-size: 17px">비공개 설정</span>
                            <input name="pw" class="input_pw" type="text" placeholder="비밀번호" autocomplete="off" disabled>
                            <script>
                                function input_disable(frm) {
                                    if(frm.lockpost.checked == true){
                                        console.log(123);
                                        frm.pw.disabled = false;
                                    } else {
                                        console.log(456);
                                        frm.pw.disabled = true;
                                    }
                                }
                            </script>
                        </div>
                        <div class="m-t-15">
                            <input type="file" name="b_file"/>
                        </div>

                        <div class="bt_se m-b-150">
                            <button class="btn_write" type="submit">글 작성</button>
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







