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
    <link rel="stylesheet" type="text/css" href="/ChanStyle/css/board.css">
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
<header class="header" include-html="/ChanStyle/BasicHeader.php"></header>

<main>
    <?php
    // 검색 변수
    $category = $_GET['catgo'];
    $search_con = $_GET['search'];
    if(isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page=1;
    }
    ?>
    <div class="container">
        <div class="row">
            <h4 class="m-text17">검색결과</h4>
            <div class="m-t-70">

                <!-- 검색 -->
                <div id="search_box">
                    <form action="search_result.php" method="get">
                        <select id="search_sel" name="catgo">
                            <option value="title">제목</option>
                            <option value="name">글쓴이</option>
                        </select>
                        <input id="search_input" placeholder="Search" style="display: inline;" type="text" name="search"
                               size="40" autocomplete="off" required="required"/>
                        <button class="btn_search">검색</button>
                    </form>
                </div>

                <table class="list-table">
                    <thead>
                    <tr>
                        <th width="70">번호</th>
                        <th style="text-align: center" width="500">제목</th>
                        <th width="120">글쓴이</th>
                        <th width="100">작성일</th>
                        <th width="100">조회수</th>
                    </tr>
                    </thead>
                    <?php
                    $sql2 = mq("select * from board where $category like '%$search_con%' order by idx desc");
                    $row_num = mysqli_num_rows($sql2);
                    $list = 1;
                    $block_ct = 5;

                    $block_num = ceil($page/$block_ct);
                    $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
                    $block_end = $block_start + $block_ct - 1; // 블록의 마지막 번호

                    $total_page = ceil($row_num / $list); // 페이지 수 구하기

                    if ($block_end > $total_page) { // 블록의 마지막 번호가 페이지수보다 많다면 마지막 번호는 페이지 수
                        // 해당 코드가 없으면 게시글이 없어도 지정해놓은 블록이 다 표시된다.
                        $block_end = $total_page;
                    }
                    $total_block = ceil($total_page / $block_ct); // 블록의 총 개수
                    $start_num = ($page - 1) * $list;

                    $sql = mq("select * from board where $category like '%$search_con%' order by idx desc limit $start_num, $list");

                    while($board = $sql -> fetch_array()) {
                        $title = $board["title"];
                        ?>
                        <tbody>
                        <tr>
                            <td style="padding-right: 45px" width="120"><?php echo $board['idx'] ?></td>
                            <td width="500"><?php
                                $lockimg = "<img src='../images/lock1.png' alt='lock' title='lock' width='17' height='17' />";
                                if($board['lock_post']=="1") {
                                ?><a style="color: #000;" href='ck_read.php?idx=<?php echo $board["idx"];?>'><?php echo $lockimg, $title;
                                    } else {
                                    ?>
                                    <a style="color: #000;" href='read.php?idx=<?php echo $board["idx"]; ?>'><?php echo $title; }?></a></td>
                            </td>
                            <td style="padding-right: 35px" width="120"><?php echo $board['name'] ?></td>
                            <td width="100"><?php echo $board['date'] ?></td>
                            <td width="100"><?php echo $board['hit']; ?></td>
                        </tr>
                        </tbody>
                    <?php } ?>
                </table>
                <div class="text-center m-b-50">
                    <div class="pagination2">
                        <?php
                        if ($page <= 1) {

                        } else {
                            echo "<a href='?catgo=$category&search=$search_con&page=1'>처음</a>"; // 처음으로
                        }

                        if ($page <= 1) {

                        } else {
                            $pre = $page - 1; // 이전페이지로
                            echo "<a href='?catgo=$category&search=$search_con&page=$pre'>이전</a>";
                        }

                        for ($i = $block_start; $i <= $block_end; $i++) {
                            if ($page == $i) {
                                echo "<a href='?catgo=$category&search=$search_con&page=$i' style='color: #09C;'>$i</a>";
                            } else {
                                echo "<a href='?catgo=$category&search=$search_con&page=$i'>$i</a>";
                            }
                        }

                        if ($page >= $total_page) {

                        } else {
                            $next = $page + 1;
                            echo "<a href='?catgo=$category&search=$search_con&page=$next'>다음</a>";
                        }

                        if ($page >= $total_page) {

                        } else {
                            echo "<a href='?catgo=$category&search=$search_con&page=$total_page'>마지막</a>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<footer id="footer" class="bg3 p-t-50 p-b-20" include-html="/ChanStyle/BasicFooter.php"></footer>
<script>
    includeHTML();
</script>
<script type="text/javascript" src="/ChanStyle/js/sidebar.js"></script>
</body>
</html>

