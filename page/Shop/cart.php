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
    <link rel="stylesheet" type="text/css" href="/ChanStyle/css/util.css">
    <link rel="stylesheet" type="text/css" href="/ChanStyle/css/cart.css">


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
    <section class="cart bgwhite p-t-70 p-b-100">
        <div class="container">
            <div class="m-text17 m-b-30">장바구니</div>
            <form id="cart_form" method="post">
                <table>
                    <tr>
                        <th width="50px" style="padding-left: 12px;"><input type="checkbox" id="checkHead"/></th>
                        <th width="250px">상품 이미지</th>
                        <th width="250px">상품이름</th>
                        <th width="200px">판매가</th>
                        <th width="150px">수량</th>
                        <th width="150px">합계</th>
                    </tr>
                    <?php
                    $sql = mq("select * from cart where userid = '$_SESSION[userid]';");
                    while ($board = $sql->fetch_array()) {
                        ?>
                        <tr style="text-align: center" data-tr_value="<?= $board['idx'] ?>">
                            <td width="50px"><input type="checkbox" class="checktbl" value="<?= $board['idx'] ?>"
                                                    name="check_list[]"></td>
                            <td width="200px"><img style="width: 120px;height: 130px;"
                                                   src="/ChanStyle/images/product/<?php echo $board['pimage'] ?>"></td>
                            <td width="150px"><?php echo "$board[pname]($board[psize])"; ?></td>
                            <input type="hidden" name="psize" value="<?php echo $board['psize'];?>"/>
                            <td width="100px" style="font-size: 22px"><?php echo number_format($board['pprice']) ?>원
                            </td>
                            <td width="150px">
                                <input id="minor_bt<?= $board['idx'] ?>" class="btn-num-product-down my_input my_-count"
                                       type="button" value="-" onclick="minor(<?= $board['idx'] ?>)">
                                <input class="my_input my_count" id="count<?= $board['idx'] ?>" type="text" value="1" name="count<?= $board['idx'] ?>">
                                <input id="plus_bt<?= $board['idx'] ?>" class="btn-num-product-up my_input my_+count"
                                       type="button" value="+" onclick="plus(<?= $board['idx'] ?>)">
                            </td>
                            <td width="100px" style="text-align: center">
                                <input id="total_price<?= $board['idx'] ?>" type="text"
                                       value="<?php echo $board['pprice'] ?>" style="background-color: transparent"
                                       hidden="hidden">
                                <input id="total_price_view<?= $board['idx'] ?>" type="text"
                                       value="<?php echo number_format($board['pprice']) ?>원"
                                       style="background-color: transparent; font-size: 22px; text-align: center"
                                       disabled>
                                <input type="hidden" name="bno" value="<?php echo $board['pid'] ?>">
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    <!-- 총 합계 -->
                    <tr>
                        <td colspan="7">
                            <?php
                            $sql2 = mq("select * from cart where userid = '$_SESSION[userid]';");
                            $t_price = 0;
                            while ($board2 = $sql2->fetch_array()) {
                                $t_price += $board2['pprice'];
                            }
                            ?>
                            <span class="m-text11" style="margin-left: 825px">총 구매금액 :</span>
                            <input style="display: inline-block; width: 52px; margin-left: 10px; color: red;"
                                   id="total_buy_price" class="m-text11" value="<?php echo $t_price ?>" name="total">
                            <span class="m-text11">원</span>
                        </td>
                    </tr>

                </table>

                <div style="display: inline;">
                    <button id="delete" class="order_all_btn" style="display: inline; margin-right: 840px">삭제하기</button>
                    <input type="button" onclick="p_buy()" value="주문하기" class="order_all_btn"
                           style="margin-top: 20px; display: inline;">
                </div>
                <script type="text/javascript">
                    function p_buy() {
                        var isChk = false;
                        var arr_check = document.getElementsByName("check_list[]");
                        for(var i = 0; i < arr_check.length; i++) {
                            if(arr_check[i].checked == true) {
                                isChk = true;
                                var p_form = document.getElementById("cart_form");
                                p_form.action = '/ChanStyle/page/Shop/paymentPage.php';
                                p_form.submit();
                                break;
                            }
                        }

                        if(!isChk) {
                            alert("주문할 상품을 선택해주세요");
                            return false;
                        }

                    }
                </script>

            </form>
        </div>
    </section>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#checkHead').click(function () {
                if ($("#checkHead").prop("checked")) {
                    $("input[type=checkbox").prop("checked", true);
                } else {
                    $("input[type=checkbox").prop("checked", false);
                }
            });

            $('#delete').click(function () {
                $('input[class="checktbl"]:checked').each(function () {
                    var tr_value = $(this).val();
                    var tr = $("tr[data-tr_value='" + tr_value + "']");

                    var total_price = document.getElementById("total_price" + tr_value);
                    var total_buy_price = document.getElementById("total_buy_price");
                    var count = Number(document.getElementById("count" + tr_value).value);
                    total_buy_price.value = Number(total_buy_price.value) - Number(total_price.value * count);

                    tr.remove();

                    $.ajax({
                        type: 'post',
                        url: '/ChanStyle/page/Shop/cart_delete.php',
                        data: {param1: tr_value},
                        dataType: 'json',
                        success: function () {

                        }
                    })
                })
            });
        });
    </script>

    <script type="text/javascript">
        function plus(idx) {
            var count = Number(document.getElementById("count" + idx).value);
            var countEI = document.getElementById("count" + idx);
            var total_price = document.getElementById("total_price" + idx);
            var total_price_view = document.getElementById("total_price_view" + idx);
            var total_buy_price = document.getElementById("total_buy_price");
            count++;
            countEI.value = count;
            total_price_view.value = numberWithCommas(total_price.value * countEI.value) + '원';
            total_buy_price.value = Number(total_buy_price.value) + Number(total_price.value);
        }

    </script>

    <script type="text/javascript">
        function minor(idx) {
            var count = Number(document.getElementById("count" + idx).value);
            var countEI = document.getElementById("count" + idx);
            var total_price = document.getElementById("total_price" + idx);
            var total_price_view = document.getElementById("total_price_view" + idx);
            var total_buy_price = document.getElementById("total_buy_price");
            if (count > 1) {
                count--;
                countEI.value = count;
                total_price_view.value = numberWithCommas(total_price.value * countEI.value) + '원';
                total_buy_price.value = Number(total_buy_price.value) - Number(total_price.value);
            }
        }
    </script>

    <!-- 1000의 자리마다 , 찍는 함수 -->
    <script type="text/javascript">
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    </script>

    <!-- 총합 구하기 -->
    <!--    <script type="text/javascript">
            $(document).ready(function () {
                var price = document.getElementById("total_buy_price");
                var test = document.getElementById("total_price_view" + 2).value;
                $('#total_price_view2').change(function () {
                    console.log(1);
                });

            });
        </script>-->

</main>

<footer id="footer" class="bg3 p-t-50 p-b-20" include-html="/ChanStyle/BasicFooter.php">

</footer>
<script>
    includeHTML();
</script>
<script type="text/javascript" src="/ChanStyle/js/sidebar.js"></script>
</body>
</html>


