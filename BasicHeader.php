<?php
session_start();
?>
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
                </ul>

                <!-- SideBar-Menu -->
                <div class="ui sidebar right vertical menu">
                    <button style="outline: none; border: none; background: transparent; cursor: pointer;" class="close_position"><i class="side_bar close icon"></i></button>
                    <ul class="sidebar_item_position">
                        <?php
                        // isset -> 변수의 값 유무 확인 (null/true 값 반환)
                        if (!isset($_SESSION['userid'])) { // 세션이 존재하지 않을 때
                            echo "<li><a href='/ChanStyle/page/Login/Login.php' class='side_item_color'>Login</a></li>";
                            echo "<li class='p-t-40'><a href='/ChanStyle/page/Login/Login.php' class='side_item_color'>MyPage</a></li>";
                            echo "<li class='p-t-40'><a href='/ChanStyle/page/Login/Login.php' class='side_item_color'> Cart </a></li>";
                        } else { // 세션이 존재할 때
                            $id = $_SESSION['userid'];
                            if ($id == "admin") { // 로그인한 아이디가 관리자일 경우(admin)
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
                    <button class="menu_btn icon_btn"><i id="menu" class="side_bar align justify icon icon_width"></i>
                    </button>
                </div>
                <script>
                    $(window).load(function () {
                        $('.side_bar').click(function () {
                            $('.ui.sidebar').sidebar('setting', 'transition', 'overlay').sidebar('toggle');
                        });
                    });
                </script>
            </nav>
        </div>
    </div>
</div>



