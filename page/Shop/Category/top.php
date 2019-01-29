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
    <link rel="stylesheet" type="text/css" href="/ChanStyle/css/shop_main.css">
    <link rel="stylesheet" type="text/css" href="/ChanStyle/css/util.css">
    <!-- BootStrap -->
    <link rel="stylesheet" type="text/css" href="/ChanStyle/vendor/bootstrap/css/bootstrap.min.css">
    <!-- semantic -->
    <link rel="stylesheet" type="text/css" href="/ChanStyle/vendor/semantic/semantic.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="/ChanStyle/vendor/semantic/semantic.js"></script>
    <!-- isotope -->
    <script src="/ChanStyle/js/isotope.pkgd.min.js"></script>
    <!-- includeHTML -->
    <script src="/ChanStyle/js/includeHTML.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.filter li button').on("click", function () {
                value = $(this).attr('data-name');
                console.log(value);
                $('.grid2').isotope({
                    filter: value
                });
            })
        })
    </script>

    <style>
        .grid-item {
            width: 25%;
            padding: 10px;
            margin: 10px;
        }

    </style>
</head>

<body>
<!-- Header -->
<header class="header" include-html="/ChanStyle/BasicHeader.php">

</header>

<main>
    <section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="width: 1500px; margin-left: 225px;background-image: url(../../../images/slide.jpg);"></section>

    <div class="container">
        <div class="row">
            <!-- Product Category -->
            <div class="col-sm-6 col-md-3 col-lg-3 p-b-50">
                <div class="p-r-10 p-r-0-sm">
                    <h4 class="m-text17 p-b-30 p-t-40">Categories</h4>

                    <ul class="p-b-54">
                        <li class="p-t-12"><a href="/ChanStyle/page/Shop/Shop_Main.php" class="s-text13 active1">ALL</a>
                        </li>
                        <li class="p-t-12"><a href="/ChanStyle/page/Shop/Category/top.php" class="s-text13 ">TOP</a>
                        </li>
                        <li class="p-t-12"><a href="/ChanStyle/page/Shop/Category/bottom.php"
                                              class="s-text13">BOTTOM</a></li>
                        <li class="p-t-12"><a href="/ChanStyle/page/Shop/Category/outer.php" class="s-text13">OUTER</a>
                        </li>
                        <li class="p-t-12"><a href="/ChanStyle/page/Shop/Category/shoes.php" class="s-text13">SHOES</a>
                        </li>
                        <li class="p-t-12"><a href="/ChanStyle/page/Shop/Category/bag.php" class="s-text13">BAG</a></li>
                        <li class="p-t-12"><a href="/ChanStyle/page/Shop/Category/accesories.php" class="s-text13">ACCESORIES</a>
                        </li>
                    </ul>

                </div>
            </div>

            <!-- Product_detail_category -->
            <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
                <div class="product_detail_category m-t-30 p-t-15 p-b-15 text-center">
                    <ul class="filter" style="display: inline;">
                        <li style="display: inline; padding-left: 40px">
                            <button data-name='*' class="btn">All</button>
                        </li>
                        <li style="display: inline; padding-left: 40px">
                            <button data-name='.T-shirt' class="btn">T-shirt</button>
                        </li>
                        <li style="display: inline; padding-left: 40px">
                            <button data-name='.Sweat_shirt' class="btn">Sweat shirt</button>
                        </li>
                        <li style="display: inline; padding-left: 40px">
                            <button data-name='.Shirt' class="btn">Shirt</button>
                        </li>
                        <li style="display: inline; padding-left: 40px">
                            <button data-name='.Knite' class="btn">Knite / Sweater</button>
                        </li>
                        <li style="display: inline; padding-left: 40px">
                            <button data-name='.Cardigan' class="btn">Cardigan</button>
                        </li>
                    </ul>
                </div>

                <div class="grid2 m-t-50">
                    <?php
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $sql2 = mq("select * from product where pgroup1='TOP'");
                    $row_num = mysqli_num_rows($sql2);
                    $list = 12;
                    $block_ct = 5;

                    $block_num = ceil($page / $block_ct); // 현재 페이지 블록 구하기 ceil() -> 소수점 자리를 무조건 올리는 함수(올림) (ex. ceil(0.1111) = 1, ceil(88.3) = 89 )
                    $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
                    $block_end = $block_start + $block_ct - 1; // 블록의 마지막 번호

                    $total_page = ceil($row_num / $list); // 페이지 수 구하기

                    if ($block_end > $total_page) { // 블록의 마지막 번호가 페이지수보다 많다면 마지막 번호는 페이지 수
                        // 해당 코드가 없으면 게시글이 없어도 지정해놓은 블록이 다 표시된다.
                        $block_end = $total_page;
                    }
                    $total_block = ceil($total_page / $block_ct); // 블록의 총 개수
                    $start_num = ($page - 1) * $list;

                    $sql5 = mq("select * from product where pgroup1='TOP' order by idx desc limit $start_num,$list;");
                    while ($board = $sql5->fetch_array()) {
                        if ($board['inventory'] <= 0) {
                            ?>
                            <div style="display: inline-block; margin-right: 25px"
                                 class="gird-item <?php echo $board['pgroup2']; ?>">
                                <a href='/ChanStyle/page/Shop/Product.php?idx=<?php echo $board['idx']; ?>'>
                                    <img class='p_img' style='width: 245px;height: 340px; margin-top:50px;'
                                         src='/ChanStyle/images/product/<?php echo $board['pimage'] ?>'>
                                </a>
                                <h6 class="mtext11" style="margin-top: 5px"><span style="color: red;">[품절]</span><?php echo $board['pname'] ?></h6>
                                <h6>￦<?php echo $board['pprice'] ?></h6>
                            </div>
                            <?php
                        } else {
                        ?>
                            <div style="display: inline-block; margin-right: 25px"
                                 class="gird-item <?php echo $board['pgroup2']; ?>">
                                <a href='/ChanStyle/page/Shop/Product.php?idx=<?php echo $board['idx']; ?>'>
                                    <img class='p_img' style='width: 245px;height: 340px; margin-top:50px;'
                                         src='/ChanStyle/images/product/<?php echo $board['pimage'] ?>'>
                                </a>
                                <h6 class="mtext11" style="margin-top: 5px"><?php echo $board['pname'] ?></h6>
                                <h6>￦<?php echo $board['pprice'] ?></h6>
                            </div>
                            <?php }?>
                        <?php
                    }
                    ?>

                    <div class="grid-item">

                    </div>
                </div>

                <div class="text-center m-b-50">
                    <div class="pagination2">
                        <?php
                        if ($page <= 1) {

                        } else {
                            echo "<a href='?page=1'>처음</a>"; // 처음으로
                        }

                        if ($page <= 1) {

                        } else {
                            $pre = $page - 1; // 이전페이지로
                            echo "<a href='?page=$pre'>이전</a>";
                        }

                        for ($i = $block_start; $i <= $block_end; $i++) {
                            if ($page == $i) {
                                echo "<a href='?page=$i' style='color: #09C;'>$i</a>";
                            } else {
                                echo "<a href='?page=$i'>$i</a>";
                            }
                        }

                        if ($page >= $total_page) {

                        } else {
                            $next = $page + 1;
                            echo "<a href='?page=$next'>다음</a>";
                        }

                        if ($page >= $total_page) {

                        } else {
                            echo "<a href='?page=$total_page'>마지막</a>";
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

<footer style="float: left;" id="footer" class="bg3 p-t-50 p-b-20" include-html="/ChanStyle/BasicFooter.php">

</footer>
<script>
    includeHTML();
</script>
<script type="text/javascript" src="/ChanStyle/js/sidebar.js"></script>
</body>
</html>

