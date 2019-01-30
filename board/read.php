<?php
include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";
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
    <link rel="stylesheet" type="text/css" href="/ChanStyle/css/board.css">
    <link rel="stylesheet" type="text/css" href="/ChanStyle/css/util.css">
    <link rel="stylesheet" type="text/css" href="/ChanStyle/css/reply.css">
    <link rel="stylesheet" type="text/css" href="/ChanStyle/css/jquery-ui.css">
    <!-- BootStrap -->
    <link rel="stylesheet" type="text/css" href="/ChanStyle/vendor/bootstrap/css/bootstrap.min.css">
    <!-- semantic -->
    <link rel="stylesheet" type="text/css" href="/ChanStyle/vendor/semantic/semantic.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="/ChanStyle/vendor/semantic/semantic.js"></script>
    <!-- jQuery -->
    <!--    <script type="text/javascript" src="/ChanStyle/js/jquery-3.2.1.min.js"></script>-->
    <script type="text/javascript" src="/ChanStyle/js/jquery-ui.js"></script>
    <script type="text/javascript" src="/ChanStyle/js/common.js"></script>
    <!-- includeHTML -->
    <script src="/ChanStyle/js/includeHTML.js"></script>


</head>

<body>
<!-- Header -->
<header class="header" include-html="/ChanStyle/BasicHeader.php">

</header>

<main>
    <?php
    $bno = $_GET['idx'];
    $hit = mysqli_fetch_array(mq("select * from board where idx ='" . $bno . "'"));
    $hit = $hit['hit'] + 1;
    $fet = mq("update board set hit = '" . $hit . "' where idx = '" . $bno . "'");
    $sql = mq("select * from board where idx='" . $bno . "'"); /* 받아온 idx값을 선택 */
    $board = $sql->fetch_array();
    ?>
    <div class="container m-t-50">
        <table border="1" bordercolor="#e6e6e6" id="tb_read" class="m-b-20">
            <tr>
                <td id="tb_head_read" colspan="4" class="text-center m-text11"><?php echo $board['title'] ?></td>
            </tr>
            <tr class="m-text11 text-center" height="50">
                <td>작성자</td>
                <td><?php echo $board['name'] ?></td>
                <td>조회수</td>
                <td><?php echo $hit ?></td>
            </tr>
            <tr>
                <td id="tb_content_text" class="text-center m-text11" colspan="4">내용</td>
            </tr>
            <tr>
                <td class="td_content" colspan="4" style="padding: 20px;">
                    <?php
                    $file = $board['file'];
                    if ($file == "null") {

                    } else {
                        echo "<div style='width: 100%; text-align: center'><img src='../images/$file' style='width: 70%; margin-bottom: 30px;'> </div>";
                    }
                    ?>
                    <?php
                    $content = $board['content'];
                    echo "<span class='m-text11' style='margin-left: 158px; padding-top: 30px'>$content</span>";
                    ?>
                </td>
            </tr>
        </table>
        <?php
        if (!isset($_SESSION['userid'])) {
            echo "<div style='padding-left: 1020px; margin-bottom: 50px'><button class='btn_write2'><a style='color:black;' href='/ChanStyle/board/board.php'>목록으로</a></button></div>";
        } else {
            if ($board['id'] === $_SESSION['userid']) { // 글작성자의 아이디와 현재 로그인된 계정의 아이디가 같아야만 수정,삭제가 가능하다.
                $idx = $board['idx'];
                echo "<span style='margin-bottom: 50px'><button class='btn_write2' style='margin-bottom: 50px'><a style='color: black' href='modify.php?idx=$idx'>수정</a></button></span>";
                echo "<span style='padding-left: 30px'><button class='btn_write2'><a style='color: black' href='delete.php?idx=$idx'>삭제</a></button></span>";
                echo "<span style='padding-left: 880px'><button class='btn_write2'><a style='color: black' href='/ChanStyle/board/board.php'>목록으로</a></button></span>";
            } else if ($_SESSION['userid'] === "admin") { // 현재 로그인된 계정이 admin이라면 게시물을 삭제할 수 있는 권한을 준다.
                $idx = $board['idx'];
                echo "<span><button class='btn_write2 m-b-30'><a style='color: black' href='delete.php?idx=$idx'>삭제</a></button></span>";
                echo "<span style='padding-left: 970px'><button class='btn_write2'><a style='color: black' href='/ChanStyle/board/board.php'>목록으로</a></button></span>";
            } else {
                echo "<span class='m-b-30' style='padding-left: 1030px'><button class='btn_write2'><a style='color: black' href='/ChanStyle/board/board.php'>목록으로</a></button></span>";
            }
        }
        ?>
    </div>
    <!-- 댓글 불러오기 -->
    <div class="container">
        <h3>댓글 (해당 글 작성자 및 관리자만 댓글을 등록할 수 있습니다.)</h3>
        <?php
        $sql3 = mq("select * from reply where con_num='" . $bno . "' order by idx desc");
        while ($reply = $sql3->fetch_array()) {
            ?>
            <div class="dap_lo">
                <div>
                    <b class="comt_edit" style="margin-right: 20px"><?php echo $reply['name']; ?></b>
                    <?php echo "<span>$reply[date]</span>"; ?>
                    <?php
                    if (isset($_SESSION['userid']) && $_SESSION['userid'] === "admin") {
                        echo "<sapn class='rep_me rep_menu'><a class='dat_delete_bt' href='#' style='margin-left: 8px'>삭제</a></sapn>";
                    } else if (isset($_SESSION['userid']) && $reply['name'] == $_SESSION['username']) {
                        echo "<sapn class='rep_me rep_menu'><a class='dat_edit_bt' href='#'>수정</a><a class='dat_delete_bt' href='#' style='margin-left: 8px'>삭제</a></sapn>";
                    }
                    ?>
                </div>
                <div class="dap_to"><?php echo nl2br("$reply[content]"); ?></div>
                <?php
                if (!isset($_SESSION['userid'])) {

                } else if (isset($_SESSION['userid']) && $_SESSION['userid'] == "admin") {
                    ?>
                    <button id="sc1<?= $reply['idx'] ?>" class="re_reply_btn" onclick="st1(<?= $reply['idx'] ?>)">답글</button>
                    <?php
                } else if (isset($_SESSION['userid']) && $reply['name'] != $_SESSION['username']) {

                } else {
                    ?>
                    <button id="sc1<?= $reply['idx'] ?>" class="re_reply_btn" onclick="st1(<?= $reply['idx'] ?>)">답글</button>
                    <?php
                }
                ?>
                <!-- 대댓글 -->
                <?php
                $sql4 = mq("select * from re_reply where con_num = $reply[idx] and re_num = $bno;");
                while ($re_reply = $sql4->fetch_array()) {
                    ?>
                    <div style="margin-left: 40px; margin-top: 10px">
                        ┗<b class="comt_edit" style="margin-right: 20px"><?php echo $re_reply['name']; ?></b>
                        <?php echo "<span>$re_reply[date]</span>" ?>
                        <?php
                        if (isset($_SESSION['userid']) && $_SESSION['userid'] === "admin") {
                            echo "<sapn class='rep_me2 rep_menu'>
                                        <button id='re_dat_edit_bt' onClick='re_reply($re_reply[idx])' style='color: #4183C4'>수정</button>
                                        <button class='re_dat_delete_bt' onclick='re_reply_delete($re_reply[idx])' style='margin-left: 8px; color: #4183C4;'>삭제</button>
                                    </sapn>";
                        } else if (isset($_SESSION['userid']) && $reply['name'] == $_SESSION['username']) {
                            echo "<sapn class='rep_me2 rep_menu'><button id='re_dat_edit_bt' onClick='re_reply($re_reply[idx])' style='color: #4183C4'>수정</button><button class='re_dat_delete_bt' onclick='re_reply_delete($re_reply[idx])' style='margin-left: 8px; color: #4183C4;'>삭제</button></sapn>";
                        }
                        ?>
                        <!-- 대댓글 수정 폼 -->
                        <div class="re_dat_edit" id="re_dat_edit<?= $re_reply['idx'] ?>">
                            <form method="post" action="reply_reply_modify_ok.php">
                                <input type="hidden" name="rno" value="<?php echo $re_reply['idx']; ?>"/>
                                <input type="hidden" name="b_no" value="<?php echo $bno; ?>">
                                <textarea name="content"
                                          class="dap_edit_t"><?php echo $re_reply['content']; ?></textarea>
                                <input type="submit" value="수정하기" class="re_mo_bt">
                            </form>
                        </div>
                        <!-- 대댓글 삭제 -->
                        <div class='re_dat_delete' id="re_dat_delete<?= $re_reply['idx'] ?>">
                            <form action="reply_reply_delete.php" method="post">
                                <input type="hidden" name="rno" value="<?php echo $re_reply['idx']; ?>"/>
                                <?php echo "<script>console.log( 're_reply: " . $re_reply['idx'] . "' );</script>"; ?>
                                <input style="height: 50px; margin-top: 15px" type="submit" value="확인"
                                       class="btn-block">
                            </form>
                        </div>
                    </div>
                    <div class="dap_to" style="margin-left: 75px"><?php echo nl2br("$re_reply[content]"); ?></div>
                    <?php
                }
                ?>
                <!-- 대댓글 폼 -->
                <div id="sb1<?= $reply['idx'] ?>"
                     style="display: none; margin-left: 40px; margin-top: 5px; margin-bottom: 20px">
                    <form action="reply_reply_ok.php" method="post" style="position: relative">
                        <input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>"/>
                        <input type="hidden" name="r_rno" value="<?php echo $reply['con_num']; ?>"/>
                        <input type="hidden" name="b_no" value="<?php echo $bno; ?>">
                        ┗<textarea placeholder="답글을 입력해 주세요" name="content"
                                   style="border: 1px solid #e6e6e6; width: 990px; display: inline-block;position: absolute; top: 0px; margin-left: 10px; padding-top: 12px; padding-left: 10px; resize: none"></textarea>
                        <button type="submit"
                                style="position: absolute; right: 5px; border: none; background-color: #ccc; padding: 3.2px 12px; height: 45px; ">
                            등록
                        </button>
                    </form>
                </div>

                <!-- 댓글 수정 폼 dialog -->
                <div class="dat_edit">
                    <form method="post" action="reply_modify_ok.php">
                        <input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>"/>
                        <input type="hidden" name="b_no" value="<?php echo $bno; ?>">
                        <textarea name="content" class="dap_edit_t"><?php echo $reply['content']; ?></textarea>
                        <input type="submit" value="수정하기" class="re_mo_bt">
                    </form>
                </div>
                <!-- 답글 달기 폼 -->
                <div class="dat_reply">
                    <form method="post" action="/ChanStyle/board/reply_reply_ok.php">
                        <input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>"/>
                        <input type="hidden" name="r_rno" value="<?php echo $reply['con_num']; ?>"/>
                        <input type="hidden" name="b_no" value="<?php echo $bno; ?>">
                        <textarea name="content" class="dap_edit_t"></textarea>
                        <input type="submit" value="답글달기" class="re_mo_bt">
                    </form>
                </div>
                <!-- 댓글 삭제 -->
                <div class='dat_delete'>
                    <form action="reply_delete.php" method="post">
                        <input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>"/>
                        <input style="height: 50px; margin-top: 15px" type="submit" value="확인" class="btn-block">
                    </form>
                </div>

            </div>
        <?php } ?>
        <!--- 댓글 입력 폼 -->
        <?php
        if (isset($_SESSION['userid'])) { /*&& $board['id'] == $_SESSION['userid'] || $_SESSION['userid'] === "admin") {*/
            if ($board['id'] == $_SESSION['userid'] || $_SESSION['userid'] === "admin") {
                echo "<div class='dap_ins'>
                    <form method='post' class='reply_form'>
                        <input type='hidden' name='bno' value='$bno'>
                        <div class='m-b-30' style='margin-top: 10px'>
                            <textarea style=\"border: 1px solid #e6e6e6; display: inline-block;\" name=\"content\" class=\"reply_content m-text11\" id=\"re_content\" placeholder=\"댓글을 입력해주세요\"></textarea>
                            <button class=\"re_bt\" type=\"submit\" style=\"float: right\">등록</button>
                        </div>
                    </form>
                </div>";
            }
        }
        ?>
    </div>

    <script type="text/javascript">
        function st1(idx) {
            var name = "#sb1" + idx;
            if (document.getElementById("sc1" + idx).innerHTML == "답글") {
                $(name).css("display", "block");
                document.getElementById("sc1" + idx).innerHTML = "취소";
            } else {
                $(name).css("display", "none");
                document.getElementById("sc1" + idx).innerHTML = "답글";
            }
        };
    </script>

    <script type="text/javascript">
        function re_reply(idx) {
            $("#re_dat_edit" + idx).dialog({
                modal: true,
                height: 180,
                width: 600,
                title: "대댓글수정"
            });
        }
    </script>

    <script type="text/javascript">
        function re_reply_delete(idx) {
            $("#re_dat_delete" + idx).dialog({
                modal: true,
                width: 400,
                title: "대댓글 삭제"
            });
        }
    </script>


</main>

<footer id="footer" class="bg3 p-t-50 p-b-20" include-html="/ChanStyle/BasicFooter.php">

</footer>
<script>
    includeHTML();
</script>
<script type="text/javascript" src="/ChanStyle/js/sidebar.js"></script>
</body>
</html>
