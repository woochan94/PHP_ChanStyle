<?php
include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";

$bno = $_GET['idx'];
$sql = mq("select * from product where idx='" . $bno . "'"); /* 받아온 idx값을 선택 */
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
    <link rel="stylesheet" type="text/css" href="/ChanStyle/css/product.css">
    <link rel="stylesheet" type="text/css" href="/ChanStyle/css/util.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- BootStrap -->
    <link rel="stylesheet" type="text/css" href="/ChanStyle/vendor/bootstrap/css/bootstrap.min.css">
    <!-- semantic -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="/ChanStyle/vendor/semantic/semantic.js"></script>
    <!-- includeHTML -->
    <script src="/ChanStyle/js/includeHTML.js"></script>

    <script type="text/javascript" src="/ChanStyle/js/common.js"></script>

    <script type=text/javascript>
        $(document).ready(function(){

            $(".return-top").hide(); // 탑 버튼 숨김
            $(function () {
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 100) { // 스크롤 내릴 표시
                        $('.return-top').fadeIn();
                    } else {
                        $('.return-top').fadeOut();
                    }
                });

                $('.return-top').click(function () {
                    $('body,html').animate({
                        scrollTop: 0
                    }, 800);  // 탑 이동 스크롤 속도
                    return false;
                });
            });

        });
    </script>

    <style>
        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            right: 0;
            background-color: white;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        }

        .sidenav a {
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
            padding-top: 15px;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }
    </style>
</head>

<body>
<!-- Header -->
<header class="header">
    <div class="container-menu-header">
        <div class="wrap-header">
            <!-- Logo  -->
            <a class="logo" href="/ChanStyle/index.php">CHANSTYLE</a>

            <!-- Main_Menu -->
            <div class="wrap_menu">
                <nav class="menu">
                    <ul class="main_menu">
                        <li class="active-menu"><a href="/ChanStyle/index.php">Home</a></li>
                        <li class="sale-noti"><a href="/ChanStyle/page/Shop/Shop_Main.php">Shop</a></li>
                        <li><a href="/ChanStyle/board/board.php">Board</a></li>
                        <li>
                            <form action="http://localhost:3000/form_receiver" method="post">
                                <input type="hidden" id="name" name="name" value="<?php echo $_SESSION['username'];?>";/>
                                <input id="liveShop" type="submit" value="LiveShop">
                            </form>
                        </li>
                        <li><a href="/ChanStyle/page/About/about.php">About</a> </li>
                        <span style="font-size:30px;cursor:pointer; position: fixed; right: 20px;" onclick="openNav()">&#9776;</span>
                    </ul>

                    <div id="mySidenav" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <ul class="sidebar_item_position2">
                            <?php
                            // isset -> 변수의 값 유무 확인 (null/true 값 반환)
                            if (!isset($_SESSION['userid'])) { // 세션이 존재하지 않을 때
                                echo "<li><a href='/ChanStyle/page/Login/Login.php' class='side_item_color'>Login</a></li>";
                                echo "<li class='p-t-40'><a href='page/Login/Login.php' class='side_item_color'>MyPage</a></li>";
                                echo "<li class='p-t-40'><a href='/ChanStyle/page/Login/Login.php' class='side_item_color'> Cart </a></li>";
                            } else { // 세션이 존재할 때
                                $id = $_SESSION['userid'];
                                if($id == "admin"){ // 로그인한 아이디가 관리자일 경우(admin)
                                    echo "<li style='font-size: 15px; margin-bottom: 20px'>관리자 계정입니다.</li>";
                                    echo "<li><a href='/ChanStyle/page/Login/Logout.php' class='side_item_color'>Logout</a></li>";
                                    echo "<li class=''><a href='/ChanStyle/page/Admin/adminPage.php' class='side_item_color'>AdminPage</a></li>";
                                    echo "<li class='p-t-40'><a href='/ChanStyle/page/Shop/cart.php' class='side_item_color'> Cart </a></li>";
                                } else { // 일반 사용자 아이디일 경우
                                    $username = $_SESSION['username'];
                                    echo "<li style='font-size: 15px; margin-bottom: 20px'>$username 님 환영합니다.</li>";
                                    echo "<li><a href='/ChanStyle/page/Login/Logout.php' class='side_item_color'>Logout</a></li>";
                                    echo "<li><a href='/ChanStyle/page/Client/MyPage.php' class='side_item_color'>MyPage</a></li>";
                                    echo "<li class='p-t-40'><a href='/ChanStyle/page/Shop/cart.php' class='side_item_color'> Cart </a></li>";
                                }
                            }
                            ?>
                            <li class="p-t-40"><a href="/ChanStyle/board/board.php" class="side_item_color"> FAQs </a></li>
                        </ul>
                        <!-- Side Customer Center Info -->
                        <div class="p-t-60" style="padding-left: 16px;">
                            <h4 class="p-l-20" style="color: black;"> CUSTOMER CENTER </h4>
                            <ul class="p-l-30">
                                <li class="p-t-5 side_phone">1544 - 0000</li>
                                <li class="p-t-30 side_cust_info_li">MON-FRI AM 10:00 ~ PM 05:00</li>
                                <li class="p-t-10 side_cust_info_li">[ LUNCH TIME ]</li>
                                <li class="p-t-5">AM 10:00 ~ PM 05:00</li>
                                <li class="p-t-10 side_cust_info_li">SUNDAY/HOLIDAY OFF</li>
                            </ul>
                        </div>
                        <!-- Side Bank Info -->
                        <div class="p-t-30" style="padding-left: 16px">
                            <h4 class="p-l-20">BANK INFO</h4>
                            <ul>
                                <li class="p-l-20">국민 274102-04-139880</li>
                            </ul>
                        </div>
                    </div>

                    <script>
                        function openNav() {
                            document.getElementById("mySidenav").style.width = "300px";
                        }

                        function closeNav() {
                            document.getElementById("mySidenav").style.width = "0";
                            document.body.style.backgroundColor = "white";
                        }
                    </script>
                </nav>
            </div>
        </div>
    </div>
</header>

<main>
    <!-- Product Info -->
    <!-- Product Main_Image -->
    <div class="container bgwhite p-t-10 p-b-80">
        <div class="flex-w flex-sb">
            <div class="w-size13 p-t-10 respon5">
                <div class="wrap-slick3 flex-sb flex-w">
                    <div class="slick3">
                        <div class="item-slick3" data-thumb="images/thumb-item-01.jpg">
                            <div class="wrap-pic-w">
                                <?php echo "<img src='/ChanStyle/images/product/$board[pimage]' style='height: 610px;'>" ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Info_detail -->
            <div class="w-size14 p-t-60 respon5">
                <?php
                if($board['inventory'] <= 0) {
                    echo "<h4 class=\"m-text17 p-b-5\"><span style='color: red;'>[품절]</span> [ $board[pname] ] </h4>";
                }else {
                    echo "<h4 class=\"m-text17 p-b-5\"> [ $board[pname] ] </h4>";
                }
                ?>
                <div class="p-t-30">
                    <span>PRICE</span>
                </div>
                <div class="p-t-10">
                    <?php
                    $p_price = number_format($board['pprice']);
                    echo " <h3 style='color: red'>￦ $p_price</h3>";
                    ?>
                </div>

                <!-- 여백 선  -->
                <hr class="m-t-20" style="width: 350px;">

                <div class="p-t-10 m-t-40">
                    <span>SIZE</span>
                </div>

                <form id="product_form" method="post">
                    <select name="size" class="size_select m-t-5">
                        <option value="small">S</option>
                        <option value="medium">M</option>
                        <option value="large">L</option>
                        <option value="x-large">XL</option>
                    </select>


                    <!-- 여백 선  -->
                    <hr class="m-t-50" style="width: 350px;">

                    <div class="p-t-30 m-t-5">
                        <span>TOTAL</span>
                    </div>
                    <div class="p-l-220 p-t-10">
                        <input id="total_price" type="text" value="35000" style="background-color: transparent" hidden="hidden">
                        <input class="p-l-30" id="total_price_view" type="text" value="￦ <?php echo $board['pprice'];?>" style="background-color: transparent; font-size: 25px; display: inline;" disabled>
                    </div>

                    <hr class="m-t-25" style="width: 350px;">
                    <?php
                    if(!isset($_SESSION['userid'])) {
                        echo "<button class='s-text15 buy_btn' onclick='Login()'>BUY</button>";
                        echo "<button class='m-l-50 s-text15 cart_btn' onclick='Login()'>ADD TO CART</button>";
                    } else {
                        echo "<button class='s-text15 buy_btn' onclick='go_buyPage()'>BUY</button>";
                        echo "<input id='bno' type='hidden' name='bno' value='$bno'>";
                        echo "<button class='m-l-50 s-text15 cart_btn' onclick='go_cart()'>ADD TO CART</button>";
                    }

                    ?>
                    <script type="text/javascript">
                        function go_buyPage() {
                            var idx = $("#bno").serialize();

                            $.ajax({
                                url : '/ChanStyle/page/Shop/check_inventory.php',
                                type : 'post',
                                data : idx,
                                success: function (data) {
                                    if(data == 1) {
                                        alert('이미 품절된 상품입니다.');
                                    }else {
                                        var form = document.getElementById("product_form");
                                        form.action = "/ChanStyle/page/Shop/paymentPage.php"
                                        form.submit();
                                    }
                                }
                            });
                        }
                    </script>
                    <script type="text/javascript">
                        function go_cart() {
                            var idx = $('#bno').serialize();

                            $.ajax({
                                url : '/ChanStyle/page/Shop/check_inventory.php',
                                type : 'post',
                                data : idx,
                                success: function (data) {
                                    if(data == 1) {
                                        alert('이미 품절된 상품입니다.');
                                    }else {
                                        var form = document.getElementById("product_form");
                                        form.action = "/ChanStyle/page/Shop/cart_ok.php"
                                        form.submit();
                                        alert("해당 상품이 장바구니에 담겼습니다.");
                                    }
                                }
                            });
                        }
                    </script>
                    <script type="text/javascript">
                        function Login() {
                            alert('로그인이 필요합니다.');
                        }
                    </script>

                </form>
            </div>
        </div>
    </div>
    <!-- Tab Menu-->
    <div class="container">
        <div>
            <div class="w3-bar p-b-10" style="border-bottom: 1px solid #e6e6e6;">
                <button class="w3-bar-item w3-button m-text11" onclick="fnMove('1')">Product Detail</button>
                <button class="w3-bar-item w3-button m-text11" onclick="fnMove('2')">Size</button>
                <button class="w3-bar-item w3-button m-text11" onclick="fnMove('3')">Review</button>
            </div>

            <div id="div1">
               <?php echo "<img src='/ChanStyle/images/product/$board[pdetail_image]' style=' width: 100%;height: 80%;'>"?>
            </div>
            <div id="div2" class="m-t-30">
                <?php echo "<img src='/ChanStyle/images/product/$board[size_detail]' style=' width: 100%;height: 10%;'>"?>
            </div>
            <!-- 리뷰 입력 폼 -->
            <div id="div3" class="m-t-10 m-b-30">
                <hr>
                <form id="review_form" method="post">
                    <div class="m-text15 m-b-10"> Review</div>
                    <input type="hidden" name="bno" value="<?php echo $bno ?>">
                    <textarea id="review_content" name="content" style="width: 100%; height: 150px; border: 1px solid #dadada; padding-top: 10px; padding-left: 10px" placeholder="리뷰를 작성해주세요"></textarea>
                    <input id="review_submit" class="m-t-10 m-b-30" type="submit" value="등록하기" style="padding: 10px; margin-left: 1035px; display: inline" >
                </form>

                <hr>
            </div>
            <div class="review_box">
                <div>
                    <?php
                    $sql2 = mq("select * from review where con_num='$bno'");
                    while($review = $sql2->fetch_array()) {
                        ?>
                        <div>작성자 : <?php echo $review['name'];?></div>
                        <div><?php echo $review['content'];?></div>
                        <hr>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <img src="/ChanStyle/images/icons/go_up.png" class="return-top" style="right:50px; bottom:15px; position:fixed; z-index:9999;" width="50px">

    <script type="text/javascript">
        function goTop(){
            $('html,body').animate({scrollTop : 0}, 300);
            // scrollTop 메서드에 0 을 넣어서 실행하면 끝 !!
            // 간혹 이 소스가 동작하지 않는다면
            // $('html, body') 로 해보세요~
        }
    </script>

    <script type="text/javascript">
        function fnMove(seq) {
            var offset = $("#div"+seq).offset();
            $('html, body').animate({scrollTop : offset.top}, 300);
        }
    </script>

</main>

<footer style="float: left;" id="footer" class="bg3 p-t-50 p-b-20" include-html="/ChanStyle/BasicFooter.php">

</footer>
<script>
    includeHTML();
</script>
<script type="text/javascript" src="/ChanStyle/js/sidebar.js"></script>

</body>
</html>







