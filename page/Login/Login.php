<?php session_start();
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-1800, '/');
}
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
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
            <form method="post" action="Login_ok.php" class="login100-form validate-form flex-sb flex-w">
					<span class="login100-form-title p-b-32">
						Account Login
					</span>

                <span class="txt1 p-b-11">
						ID
					</span>
                <div class="wrap-input100 validate-input m-b-36" data-validate = "Username is required">
                    <input class="input100" type="text" name="userid" required >
                    <span class="focus-input100"></span>
                </div>

                <span class="txt1 p-b-11">
						Password
					</span>
                <div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
                    <input class="input100" type="password" name="userpwd" required >
                    <span class="focus-input100"></span>
                </div>

                <div class="flex-sb-m w-full p-b-48">
                    <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me" value="0">
                        <label class="label-checkbox100" for="ckb1">
                            Remember me
                        </label>
                    </div>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>
            </form>
        </div>
        <div class="wrap-signup"><a id="sign_up_text" class="a_signup" href="Sign_up.php">Create New Account</a></div>
    </div>
</div>

</body>
</html>