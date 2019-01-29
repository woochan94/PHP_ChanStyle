<?php
include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>CHANSTYLE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 타이틀 아이콘 -->
    <link rel="icon" type="image/png" href="../../images/icons/title_icon.png"/>
    <!-- 부트스트랩 -->
    <link rel="stylesheet" type="text/css" href="../../vendor/bootstrap/css/bootstrap.min.css">
    <!-- 아이콘 -->
    <link rel="stylesheet" type="text/css" href="../../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../../css/login_util.css">
    <link rel="stylesheet" type="text/css" href="../../css/login_main.css">

    <!-- jQuery -->
    <script type="text/javascript" src="../../js/jquery-3.2.1.js"></script>
    <!-- 아이디 중복 검사 -->
    <script>
        $(document).ready(function (e) {
            $(".check_id").on("keyup",function () { // check_id 라는 클래스에 입력을 감지
                var self = $(this);
                var userid;

                if(self.attr("id") === "userid") {
                    userid = self.val();
                }

                $.post (    // post방식으로 id_check.php에 입력한 userid값을 넘김
                    "id_check.php",
                    { userid : userid },
                    function (data) {
                        if(data) { // 만약 data값이 전송되면
                            self.parent().parent().find("#id_check").html(data); //id_check를 찾아 html방식으로 data를 뿌려줌
                           /* self.parent().parent().find("#id_check").css("color", "#008000");*/
                        }
                    }
                );
            });
        });
    </script>
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
            <form method="post" action="Sign_up_ok.php" class="login100-form validate-form flex-sb flex-w">
                <span class="login100-form-title p-b-32">SIGN UP</span>
                <span class="txt1 p-b-11">Username</span>
                <div class="wrap-input100 validate-input m-b-12">
                    <input class="input100" type="text" name="username" autocomplete="off" required>
                    <span class="focus-input100"></span>
                </div>

                <span class="txt1 p-b-11">ID</span>
                <div class="wrap-input100 validate-input m-b-12">
                    <input id="userid" class="input100 check_id" type="text" name="userid" autocomplete="off" required>
                    <span class="focus-input100"></span>
                    <div id="id_check"></div>
                </div>

                <span class="txt1 p-b-11">
						Password
					</span>
                <div class="wrap-input100 validate-input m-b-12">
                    <input id="pwd1" class="input100 check_pw" type="password" name="pwd1" required>
                    <span class="focus-input100"></span>
                </div>

                <span class="txt1 p-b-11">
						Confirm Password
					</span>
                <div class="wrap-input100 validate-input m-b-12">
                    <input id="pwd2" class="input100" type="password" name="pwd2" required>
                    <span class="focus-input100"></span>
                    <div class="m-t-10" id="alert-success" style="color: #008000;">비밀번호가 일치합니다.</div>
                    <div class="m-t-10" id="alert-danger" style="color: #FF0000;">비밀번호가 일치하지 않습니다.</div>
                </div>
                <!-- 비밀번호 확인 -->
                <script type="text/javascript">
                    $(function(){
                        $("#alert-success").hide();
                        $("#alert-danger").hide();
                        $("input").keyup(function(){
                            var pwd1=$("#pwd1").val();
                            var pwd2=$("#pwd2").val();
                            if(pwd1 != "" || pwd2 != ""){
                                if(pwd1 == pwd2){
                                    $("#alert-success").show();
                                    $("#alert-danger").hide();
                                    $("#submit").removeAttr("disabled");
                                }else{
                                    $("#alert-success").hide();
                                    $("#alert-danger").show();
                                    $("#submit").attr("disabled", "disabled");
                                }
                            }
                        });
                    });
                </script>

                <span class="txt1 p-b-11"> Email</span>
                <div class="wrap-input100 validate-input m-b-12">
                    <input class="input100" type="email" name="useremail" autocomplete="off" required>
                    <span class="focus-input100"></span>
                </div>

                <span class="txt1 p-b-11"> PHONE</span>
                <div class="my_wrap-input100 validate-input m-b-12">
                    <select class="my_input_phone" name="phone1">
                        <option value="010">010</option>
                        <option value="011">011</option>
                        <option value="017">017</option>
                        <option value="019">019</option>
                    </select> -
                    <input class="my_input_phone" type="text" name="phone2" autocomplete="off" required> -
                    <input class="my_input_phone" type="text" name="phone3" autocomplete="off" required>
                </div>

                <table>
                    <ul>
                        <li><span class="txt1 p-b-11"> ADDRESS </span></li>
                        <li class="p-b-11">
                            <input class="my_input_addr1" type="text" id="sample4_postcode" placeholder="우편번호" name="postnum" autocomplete="off" required>
                            <input class="my_input_addrbtn" type="button" onclick="sample4_execDaumPostcode()"
                                   value="우편번호 찾기"><br>
                        </li>
                        <li class="p-b-11">
                            <input class="my_input_addr2" type="text" id="sample4_roadAddress" placeholder="도로명주소" name="useraddress1" autocomplete="off" required>
                            <!--<input class="my_input_addr2" type="text" id="sample4_jibunAddress" placeholder="지번주소">-->
                        </li>
                        <li class="p-b-30">
                            <span id="guide" style="color:#999;display:none"></span>
                            <input class="my_input_addr3" type="text" id="sample4_detailAddress" placeholder="상세주소" name="useraddress2" autocomplete="off" required>
                        </li>
                    </ul>
                </table>

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


                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        SIGN UP
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>