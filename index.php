<?php
include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>CHANSTYLE </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Title_Icon -->
    <link rel="icon" type="image/png" href="images/icons/title_icon.png"/>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- BootStrap -->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">

    <!-- semantic -->
    <link rel="stylesheet" type="text/css" href="/ChanStyle/vendor/semantic/semantic.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="/ChanStyle/vendor/semantic/semantic.js"></script>

    <!-- Slider -->
    <link rel="stylesheet" type="text/css" href="/ChanStyle/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="/ChanStyle/vendor/slick/slick.css">


</head>

<body>
<!-- Header -->
<header class="header">
    <div class="container-menu-header">
        <div class="wrap-header">
            <!-- Logo -->
            <a class="logo" href="/ChanStyle/index.php">CHANSTYLE</a>

            <!-- Main_Menu -->
            <div class="wrap_menu">
                <nav class="menu">
                    <ul class="main_menu">
                        <li class="active-menu"><a href="/ChanStyle/index.php">Home</a></li>
                        <li class="sale-noti"><a href="/ChanStyle/page/Shop/Shop_Main.php">Shop</a></li>
                        <li><a href="/ChanStyle/board/board.php">Board</a></li>
                        <?php
                        if(!isset($_SESSION['userid'])) {
                            echo "
                                <li><a href='/ChanStyle/page/Login/Login.php' id='notLogin_liveshop' onclick='needLogin()'>LiveShop</a></li>
                            ";
                        } else if(isset($_SESSION['userid']) && $_SESSION['userid'] == 'admin') {
                           echo "
                                <li><a href='/ChanStyle/nodejs/Streaming/Create_LiveShop.php'>LiveShop</a> </li>
                           ";
                        } else {
                            echo "
                                <li>
                                    <form action='http://localhost:3000/form_receiver' method='post'>
                                        <input type='hidden' id='name' name='name' value='$_SESSION[username]'>
                                        <input type='button' id='liveShop' value='LiveShop'>
                                    </form>
                                </li>
                            ";
                        }
                        ?>
                        <li><a href="/ChanStyle/page/About/about.php">About</a> </li>
                    </ul>
                    <script>
                        function needLogin() {
                            alert("로그인이 필요합니다.");
                        }
                    </script>

                    <!-- SideBar-Menu -->
                    <div class="ui sidebar right vertical menu">
                      <button class="close_position"><i class="side_bar close icon"></i></button>
                        <ul class="sidebar_item_position">
                            <?php
                            // isset -> 변수의 값 유무 확인 (null/true 값 반환)
                            if (!isset($_SESSION['userid'])) { // 세션이 존재하지 않을 때
                                echo "<li><a href='/ChanStyle/page/Login/Login.php' class='side_item_color'>Login</a></li>";
                                echo "<li class='p-t-40'><a href='/ChanStyle/page/Login/Login.php' class='side_item_color'>MyPage</a></li>";
                                echo "<li class='p-t-40'><a href='/ChanStyle/page/Login/Login.php' class='side_item_color'> Cart </a></li>";
                            } else { // 세션이 존재할 때
                                $id = $_SESSION['userid'];
                                if($id == "admin"){ // 로그인한 아이디가 관리자일 경우(admin)
                                    echo "<li style='font-size: 15px; margin-bottom: 20px'>관리자 계정입니다.</li>";
                                    echo "<li><a href='/ChanStyle/page/Login/Logout.php' class='side_item_color'>Logout</a></li>";
                                    echo "<li class='p-t-40'><a href='/ChanStyle/page/Admin/adminPage.php' class='side_item_color'>AdminPage</a></li>";
                                    echo "<li class='p-t-40'><a href='/ChanStyle/page/Shop/cart.php' class='side_item_color'> Cart </a></li>";
                                } else { // 일반 사용자 아이디일 경우
                                    $username = $_SESSION['username'];
                                    echo "<li style='font-size: 15px; margin-bottom: 20px'>$username 님 환영합니다.</li>";
                                    echo "<li><a href='/ChanStyle/page/Login/Logout.php' class='side_item_color'>Logout</a></li>";
                                    echo "<li class='p-t-40'><a href='/ChanStyle/page/Client/MyPage.php' class='side_item_color'>MyPage</a></li>";
                                    echo "<li class='p-t-40'><a href='/ChanStyle/page/Shop/cart.php' class='side_item_color'> Cart </a></li>";
                                }
                            }
                            ?>
                            <li class="p-t-40"><a href="/ChanStyle/board/board.php" class="side_item_color"> FAQs </a></li>
                        </ul>
                        <!-- Side Customer Center Info -->
                        <div class="p-t-110">
                            <h2 class="p-l-20" style="color: black;"> CUSTOMER CENTER </h2>
                            <ul class="p-l-30">
                                <li class="p-t-5 side_phone">1544 - 0000</li>
                                <li class="p-t-30 side_cust_info_li">MON-FRI AM 10:00 ~ PM 05:00</li>
                                <li class="p-t-10 side_cust_info_li">[ LUNCH TIME ]</li>
                                <li class="p-t-5">AM 10:00 ~ PM 05:00</li>
                                <li class="p-t-10 side_cust_info_li">SUNDAY/HOLIDAY OFF</li>
                            </ul>
                        </div>

                        <!-- Side Bank Info -->
                        <div class="p-t-60 p-l-30">
                            <h2>BANK INFO</h2>
                            <ul>
                                <li>국민 274102-04-139880</li>
                            </ul>
                        </div>

                    </div>
                    <div class="pusher" style="position: absolute; right: 20px; top: 28px; ">
                        <button class="menu_btn"><i id="menu" class="side_bar align justify icon icon_width"></i></button>
                    </div>
            <script>
                $('.side_bar').click(function () {
                    $('.ui.sidebar').sidebar('setting', 'transition', 'overlay').sidebar('toggle');
                })
            </script>
            </nav>
        </div>
    </div>
</div>
</header>
<!-- Main_Banner -->
<section class="section-slide">
    <div class="wrap-slick1 rs1-slick1">
        <div class="slick1">
            <div class="item-slick1" style="background-image: url(/ChanStyle/images/slide-03_1900x570.jpg);">
                <div class="container h-full">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30">
                        <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-202 cl2 respon2">
									Men Collection 2018
								</span>
                        </div>
                        <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                            <h2 class="ltext-104 cl2 p-t-19 p-b-43 respon1">
                                New arrivals
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="item-slick1" style="background-image: url(/ChanStyle/images/slide-02.jpg);">
                <div class="container h-full">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30">
                        <div class="layer-slick1 animated visible-false" data-appear="rollIn" data-delay="0">
								<span class="ltext-202 cl2 respon2">
									Men New-Season
								</span>
                        </div>

                        <div class="layer-slick1 animated visible-false" data-appear="lightSpeedIn" data-delay="800">
                            <h2 class="ltext-104 cl2 p-t-19 p-b-43 respon1">
                                Jackets & Coats
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="/ChanStyle/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="/ChanStyle/vendor/slick/slick.min.js"></script>
<script src="/ChanStyle/js/slick-custom.js"></script>

<!-- Category_Title -->
<div class="p-b-32">
    <h3 class="ltext-105 cl5 txt-center respon1 category">Category</h3>
</div>
<!-- Banner -->
<div class="sec-banner bg0">
    <div class="flex-w flex-c-m">
        <div class="size-202 m-lr-auto respon4">
            <!-- Block1 -->
            <div class="block1 wrap-pic-w">
                <img src="images/banner-02.jpg">
                <a href="/ChanStyle/page/Shop/Shop_Main.php" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                    <div class="block1-txt-child1 flex-col-l">
                        <span class="block1-name ltext-102 trans-04 p-b-8">
                            Men
                        </span>
                    </div>
                    <div class="block1-txt-child2 p-b-4 trans-05">
                        <div class="block1-link stext-101 cl0 trans-09">
                            Shop Now
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="size-202 m-lr-auto respon4">
            <!-- Block1 -->
            <div class="block1 wrap-pic-w">
                <img src="images/banner-06.jpg">
                <a href="/ChanStyle/page/Shop/Category/bag.php" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                    <div class="block1-txt-child1 flex-col-l">
                        <span class="block1-name ltext-102 trans-04 p-b-8">
                            Bag
                        </span>
                    </div>
                    <div class="block1-txt-child2 p-b-4 trans-05">
                        <div class="block1-link stext-101 cl0 trans-09">
                            Shop Now
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="size-202 m-lr-auto respon4">
            <!-- Block1 -->
            <div class="block1 wrap-pic-w">
                <img src="images/banner-07.jpg">
                <a href="/ChanStyle/page/Shop/Category/accesories.php" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                <div class="block1-txt-child1 flex-col-l">
                        <span class="block1-name ltext-102 trans-04 p-b-8">
                            Accessory
                        </span>
                    </div>
                    <div class="block1-txt-child2 p-b-4 trans-05">
                        <div class="block1-link stext-101 cl0 trans-09">
                            Shop Now
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Best Seller -->
<div class="p-b-32">
    <h3 class="ltext-105 cl5 txt-center respon1">BEST SELLER</h3>
</div>
<div class="container-fluid">
    <div class="row">
            <?php
            $sql = mq("select * from product order by sales desc limit 4");

            while($board = $sql->fetch_array()) {
                ?>
                <?php
                if($board['inventory'] <= 0) {
                    ?>
                    <div class="col-sm-3">
                        <a href="/ChanStyle/page/Shop/Product.php?idx=<?php echo $board['idx']; ?>"><img style="width: 300px; height: 400px;" class="customImg" src="/ChanStyle/images/product/<?php echo $board['pimage'];?>"></a>
                        <ul>
                            <li class="best"><span style="color: red;">[품절]</span><?php echo $board['pname'];?></li>
                            <li class="best">￦<?php echo $board['pprice'];?></li>
                        </ul>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="col-sm-3">
                        <a href="/ChanStyle/page/Shop/Product.php?idx=<?php echo $board['idx']; ?>"><img style="width: 300px; height: 400px;" class="customImg" src="/ChanStyle/images/product/<?php echo $board['pimage'];?>"></a>
                        <ul>
                            <li class="best"><?php echo $board['pname'];?></li>
                            <li class="best">￦<?php echo $board['pprice'];?></li>
                        </ul>
                    </div>
                    <?php
                }
                ?>

            <?php
            }
            ?>
    </div>
</div>

<!-- New Product -->
<div class="p-b-32">
    <h3 class="ltext-105 cl5 txt-center newproduct"> NEW PRODUCT </h3>
</div>
<div class="container-fluid">
    <div class="row">
        <?php
        $sql2 = mq("select * from product order by pdate desc limit 4");

        while($board2 = $sql2 -> fetch_array()) {
            ?>
            <div class="col-sm-3">
                <a href="/ChanStyle/page/Shop/Product.php?idx=<?php echo $board2['idx']; ?>"><img style="width: 300px; height: 400px;" class="customImg" src="/ChanStyle/images/product/<?php echo $board2['pimage'];?>"></a>
                <ul>
                    <li class="best"><?php echo $board2['pname'];?></li>
                    <li class="best">￦<?php echo $board2['pprice'];?></li>
                </ul>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<!-- Information -->
<section class="shipping bgwhite p-t-40 p-b-46">
    <div class="flex-w-info p-l-15 p-r-15">
        <div class="flex-col-c1 w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon_info">
            <h4 class="m-text12 t-center">
                Delivery
            </h4>

            <span class="s-text11 t-center">
                total price 30,000 ↑ FREE
            </span>
            <span class="s-text11 t-center">
                basic delivery 2,500
            </span>

        </div>

        <div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 bo2 respon2">
            <h4 class="m-text12 t-center">
                30 Days Return
            </h4>

            <span class="s-text11 t-center">
					Simply return it within 30 days for an exchange.
				</span>
        </div>

        <div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
            <h4 class="m-text12 t-center">
                Store Opening
            </h4>

            <span class="s-text11 t-center">
					Shop open from Monday to Sunday
				</span>
        </div>
    </div>
</section>

<footer class="bg3 p-t-50 p-b-20">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Categories
                </h4>

                <ul>
                    <li class="p-b-10">
                        <a href="/ChanStyle/page/Shop/Shop_Main.php" class="stext-107 cl7 hov-cl1 trans-04">
                            Men
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="/ChanStyle/page/Shop/Category/bag.php" class="stext-107 cl7 hov-cl1 trans-04">
                            Bag
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="/ChanStyle/page/Shop/Category/accesories.php" class="stext-107 cl7 hov-cl1 trans-04">
                            Accessory
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Help
                </h4>

                <ul>
                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Review
                        </a>
                    </li>
                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Shipping
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            FAQs
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    GET IN TOUCH
                </h4>

                <p class="stext-107 cl7 size-201">
                    Any questions? Let us know in store at Teamnova
                </p>

                <div class="p-t-27">
                    <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-facebook"></i>
                    </a>

                    <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-instagram"></i>
                    </a>

                    <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-pinterest-p"></i>
                    </a>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Newsletter
                </h4>

                <form>
                    <div class="wrap-input1 w-full p-b-4">
                        <input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email"
                               placeholder="teamnova@example.com">
                        <div class="focus-input1 trans-04"></div>
                    </div>
                </form>
            </div>
        </div>

        <div class="p-t-10">
            <p class="stext-107 cl6 txt-center">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a
                        href="https://colorlib.com" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
        </div>
    </div>
</footer>
</body>
</html>