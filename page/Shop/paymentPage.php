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
    <link rel="stylesheet" type="text/css" href="/ChanStyle/css/payment.css">
    <!-- BootStrap -->
    <link rel="stylesheet" type="text/css" href="/ChanStyle/vendor/bootstrap/css/bootstrap.min.css">
    <!-- semantic -->
    <link rel="stylesheet" type="text/css" href="/ChanStyle/vendor/semantic/semantic.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="/ChanStyle/vendor/semantic/semantic.js"></script>
    <!-- includeHTML -->
    <script src="/ChanStyle/js/includeHTML.js"></script>
    <!-- 결제(iamport) -->
    <script src="https://cdn.bootpay.co.kr/js/bootpay-2.0.20.min.js" type="application/javascript"></script>

    <style>
        #total {
            margin: 0px;
            border: none;
            background: transparent;
            display: inline-block;
            color: black;
            padding-left: 20px;
        }
    </style>
</head>

<body>
<!-- Header -->
<header class="header" include-html="/ChanStyle/BasicHeader.php">

</header>

<main>
    <div class="container">
        <div class="m-text17 m-t-50">주문/결제</div>
        <table class="buy_product m-t-50 m-l-50 m-b-30">
            <tr>
                <th width="250">상품 이미지</th>
                <th width="250">상품이름</th>
                <th width="100">사이즈</th>
                <th width="200">판매가</th>
                <th width="100">수량</th>
                <th width="200">합계</th>
            </tr>
            <?php
            // 장바구니를 통해 구매페이지로 왔을 때
            if (!empty($_POST['check_list'])) {
                // 체크박스에 체크된 value값이 $data로 넘어온다.
                foreach ($_POST['check_list'] as $data) {
                    $bno = $_POST['bno'];
                    $sql5 = mq("select * from cart where idx='$data';");
                    $board5 = $sql5->fetch_array();
                    $sql6 = mq("select * from product where idx='$board5[pid]';");
                    $count = $_POST['count' . $data];
                    $sql = mq("select * from product where idx = '$bno';");

                    while ($board = $sql6->fetch_array()) {
                        ?>
                        <tr>
                            <td><img src="/ChanStyle/images/product/<?php echo $board['pimage']; ?>"
                                     style="width: 150px; padding: 10px;"/></td>
                            <td style="text-align: center" id="pname"><?php echo $board['pname']; ?></td>
                            <td><?php echo $board5['psize']; ?></td>
                            <td><?php echo $board5['pprice']; ?></td>
                            <td><?php echo $count ?></td>
                            <td><?php echo $board5['pprice'] * $count ?>원</td>
                        </tr>
                        <?php
                    }
                    ?>
                    <?php
                }
                ?>
                <tr>
                    <td colspan="6">
                        <span> 총 합계 :<input value="<?php echo $_POST['total']?>" id="total" disabled><span style="position: absolute; left: 1000px;">원</span>
                    </td>
                </tr>
                <?php
            }
            // 상품 페이지에서 바로 구매하기를 통해 구매페이지로 왔을 때
            else {
                $bno = $_POST['bno'];
                $size = $_POST['size'];
                $sql = mq("select * from product where idx = '$bno';");
                $board = $sql->fetch_array();
                ?>
                <tr>
                    <td><img src="/ChanStyle/images/product/<?php echo $board['pimage']; ?>"
                             style="width: 150px; padding: 10px;"/></td>
                    <td style="text-align: center" id="pname"><?php echo $board['pname']; ?></td>
                    <td><?php echo $size; ?></td>
                    <td><?php echo $board['pprice']; ?></td>
                    <td>1</td>
                    <td><?php echo $board['pprice']; ?></td>
                </tr>
                <tr>
                    <td colspan="6">
                        <span>총 합계 :<input value="<?php echo $board['pprice']?>" id="total" disabled><span style="position: absolute; left: 1000px;">원</span></span>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>


    <div id="container" class="container">
        <div class="row">
            <div class="col-75 m-b-50">
                <div class="container">
                    <form name="order_form" id="order_form" action="buy_ok.php" method="post">
                        <div class="row">
                            <div class="col-50 m-l-50">
                                <div class="m-b-30 m-t-30">
                                   <span class="m-text17">배송지 정보</span>
                                    <input type="checkbox" id="cbox" style="margin-left: 330px; margin-right: 5px;" value="0"><label class="m-text11" for="cbox">주문자 정보와 동일</label>
                                </div>
                                <label for="fname">수령인</label>
                                <input type="text" id="fname" name="firstname" autocomplete="off" placeholder="수령인 이름">

                                <label for="email">이메일</label>
                                <input type="text" id="email" name="email" placeholder="john@example.com"
                                       autocomplete="off">

                                <div style="margin-bottom: 10px"> 배송지 주소</div>
                                <input class="my_input_addr1" type="text" id="sample4_postcode" placeholder="우편번호"
                                       name="postnum" autocomplete="off" required>

                                <input class="my_input_addrbtn" type="button" onclick="sample4_execDaumPostcode()"
                                       value="우편번호 찾기"><br>
                                <input class="my_input_addr2" type="text" id="sample4_roadAddress" placeholder="도로명주소"
                                       name="useraddress1" autocomplete="off" required>

                                <span id="guide" style="color:#999;display:none"></span>
                                <input class="my_input_addr3" type="text" id="sample4_detailAddress" placeholder="상세주소"
                                       name="useraddress2" autocomplete="off" required>

                                <label for="phone">전화번호</label>
                                <input type="text" id="phone" name="phone"
                                       placeholder="전화번호를 입력해 주세요." autocomplete="off">

                                <label for="memo">배송 메모</label>
                                <input type="text" id="memo" name="memo" placeholder="ex) 부재시 경비실에 맡겨주세요."
                                       autocomplete="off">

                                <?php
                                if(!empty($_POST['check_list'])) {
                                    foreach($_POST['check_list'] as $data) {
                                        echo "<input type='hidden' name='test[]' value='$data'>";
                                        $count2 =  $_POST['count'.$data];
                                        echo "<input type='hidden' name='count[]' value='$count2'>";
                                    }
                                } else {
                                    echo "<input type='hidden' name='pnum' value='$board[idx]'>";
                                }
                                ?>
                            </div>
                        </div>
                        <input value="결제하기" class="btn" style="margin-top: 11px; margin-bottom: 11px" onclick="buy()">

                        <!-- 카카오 우편번호 api -->
                        <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
                        <script>
                            //본 예제에서는 도로명 주소 표기 방식에 대한 법령에 따라, 내려오는 데이터를 조합하여 올바른 주소를 구성하는 방법을 설명합니다.
                            function sample4_execDaumPostcode() {
                                new daum.Postcode({
                                    oncomplete: function (data) {
                                        // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                                        // 도로명 주소의 노출 규칙에 따라 주소를 표시한다.
                                        // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                                        var roadAddr = data.roadAddress; // 도로명 주소 변수
                                        var extraRoadAddr = ''; // 참고 항목 변수

                                        // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                                        // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                                        if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
                                            extraRoadAddr += data.bname;
                                        }
                                        // 건물명이 있고, 공동주택일 경우 추가한다.
                                        if (data.buildingName !== '' && data.apartment === 'Y') {
                                            extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                                        }
                                        // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                                        if (extraRoadAddr !== '') {
                                            extraRoadAddr = ' (' + extraRoadAddr + ')';
                                        }

                                        // 우편번호와 주소 정보를 해당 필드에 넣는다.
                                        document.getElementById('sample4_postcode').value = data.zonecode;
                                        document.getElementById("sample4_roadAddress").value = roadAddr;
                                        //document.getElementById("sample4_jibunAddress").value = data.jibunAddress;

                                        var guideTextBox = document.getElementById("guide");
                                        // 사용자가 '선택 안함'을 클릭한 경우, 예상 주소라는 표시를 해준다.
                                        if (data.autoRoadAddress) {
                                            var expRoadAddr = data.autoRoadAddress + extraRoadAddr;
                                            guideTextBox.innerHTML = '(예상 도로명 주소 : ' + expRoadAddr + ')';
                                            guideTextBox.style.display = 'block';

                                        } else if (data.autoJibunAddress) {
                                            var expJibunAddr = data.autoJibunAddress;
                                            guideTextBox.innerHTML = '(예상 지번 주소 : ' + expJibunAddr + ')';
                                            guideTextBox.style.display = 'block';
                                        } else {
                                            guideTextBox.innerHTML = '';
                                            guideTextBox.style.display = 'none';
                                        }
                                    }
                                }).open();
                            }
                        </script>

                        <?php
                        $userInfo = mq("select * from userInfo where name='$_SESSION[username]'");
                        $userInfoboard = $userInfo->fetch_array();
                        ?>

                        <script type="text/javascript">
                            $("#cbox").click(function () {
                                if($("input:checkbox[id='cbox']").is(":checked") == true) {
                                    var name = "<?php echo $userInfoboard['name']?>";
                                    var email = "<?php echo $userInfoboard['email']?>";
                                    var postnum = "<?php echo $userInfoboard['postnum']?>";
                                    var address1 = "<?php echo $userInfoboard['address1']?>";
                                    var address2 = "<?php echo $userInfoboard['address2']?>";
                                    var phone = "<?php echo $userInfoboard['phone']?>";
                                    $(document).ready(function () {
                                        $("#fname").val(name);
                                        $("#email").val(email);
                                        $("#sample4_postcode").val(postnum);
                                        $("#sample4_roadAddress").val(address1);
                                        $("#sample4_detailAddress").val(address2);
                                        $("#phone").val(phone);
                                    });
                                } else {
                                    $(document).ready(function () {
                                        $("#fname").val('');
                                        $("#email").val('');
                                        $("#sample4_postcode").val('');
                                        $("#sample4_roadAddress").val('');
                                        $("#sample4_detailAddress").val('');
                                        $("#phone").val('');
                                    });
                                }
                            });
                        </script>

                        <!-- 결제api -->
                        <script type="text/javascript">
                            function buy() {
                                var id = document.getElementById("fname");
                                var email = document.getElementById("email");
                                var postnum = document.getElementById("sample4_postcode");
                                var address1 = document.getElementById("sample4_roadAddress");
                                var address2 = document.getElementById("sample4_detailAddress");
                                var phone = document.getElementById("phone");

                                var total = document.getElementById("total");
                                console.log(total.value);

                                var address = address1.value + address2.value;

                                if (id.value == "") {
                                    alert("수령인 정보를 입력해주세요");
                                } else if (email.value == "") {
                                    alert("이메일 정보를 입력해주세요");
                                } else if (postnum.value == "") {
                                    alert("우편번호 정보를 입력해주세요");
                                } else if (address2.value == "") {
                                    alert("상세주소를 입력해주세요");
                                } else if (phone.value == "") {
                                    alert("전화번호 정보를 입력해주세요");
                                } else {
                                    //실제 복사하여 사용시에는 모든 주석을 지운 후 사용하세요
                                    BootPay.request({
                                        price: total.value, //실제 결제되는 가격
                                        application_id: "5c3ad625396fa6488e77e4da",
                                        name: 'ChanStyle 의류', //결제창에서 보여질 이름
                                        pg: 'inicis',
                                        method: 'card', //결제수단, 입력하지 않으면 결제수단 선택부터 화면이 시작합니다.
                                        show_agree_window: 0, // 부트페이 정보 동의 창 보이기 여부
                                        user_info: {
                                            username: '정우찬',
                                            email: email,
                                            addr: address,
                                            phone: phone
                                        },
                                        order_id: '111', //고유 주문번호로, 생성하신 값을 보내주셔야 합니다.
                                        params: {
                                            callback1: '그대로 콜백받을 변수 1',
                                            callback2: '그대로 콜백받을 변수 2',
                                            customvar1234: '변수명도 마음대로'
                                        },
                                    }).error(function (data) {
                                        //결제 진행시 에러가 발생하면 수행됩니다.
                                        console.log(data);
                                    }).cancel(function (data) {
                                        //결제가 취소되면 수행됩니다.
                                        console.log(data);
                                    }).ready(function (data) {
                                        // 가상계좌 입금 계좌번호가 발급되면 호출되는 함수입니다.
                                        console.log(data);
                                    }).close(function (data) {
                                        // 결제창이 닫힐때 수행됩니다. (성공,실패,취소에 상관없이 모두 수행됨)
                                        console.log(data);
                                    }).done(function (data) {
                                        //결제가 정상적으로 완료되면 수행됩니다
                                        //비즈니스 로직을 수행하기 전에 결제 유효성 검증을 하시길 추천합니다.
                                        console.log(data);
                                        $("#order_form").submit();
                                    });
                                }

                            }
                        </script>
                    </form>
                </div>
            </div>

            <div class="col-25">
                <div class="container">
                    <?php
                    $sql2 = mq("select * from userInfo where name = '$_SESSION[username]';");
                    $board2 = $sql2->fetch_array();
                    ?>
                    <div class="m-text17 m-t-30 m-b-120">주문자 정보</div>
                    <div style="text-align: left" class="m-b-20">
                        <label class="m-text15 m-b-10">이름 : </label>
                        <label class="m-text15 m-l-30 m-b-20"><?php echo $board2['name']; ?></>
                    </div>

                    <div class="m-b-30">
                        <div class="m-text15 m-b-10">이메일</div>
                        <label class="m-text11"><?php echo $board2['email']; ?></label>
                    </div>

                    <div class="m-b-30">
                        <div class="m-text15 m-b-10">전화번호</div>
                        <label class="m-text11"><?php echo $board2['phone']; ?></label>
                    </div>

                    <div style="text-align: left" class="m-b-20">
                        <label class="m-text15 m-b-10">우편번호 : </label>
                        <label class="m-text15 m-l-30 m-b-20"><?php echo $board2['postnum']; ?></>
                    </div>

                    <div class="m-b-110">
                        <div class="m-text15 m-b-10">주소</div>
                        <label class="m-text11"><?php echo $board2['address']; ?></label>
                    </div>

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


