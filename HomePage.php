<?php
    include 'php_function.inc.php';
    header("content-type:text/html;charset=utf-8");
	//savePath();
?>

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="utf-8">
    <title>Art Store</title>
    <link rel="stylesheet" type="text/css" href="css/StyleSheet1.css" />
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
	<script src="cookie.js" type="text/javascript"></script>

</head>
<body>
<header>
    <h1 id="logo">Art Store</h1>
    <span id="slogan">lalala</span>
    <ul>
        <li>
            <a href="HomePage.php">首页</a>
        </li>
        
        <li>
            <a href="search2.php">搜索</a>
        </li>
        <?php
        if (isset($_COOKIE["username"])){
            NabIN();
        }
        else{
            NabOUT();
        }
        ?>
    </ul>
	<div class="path">
	
	</div>
</header>


<script>
    function openLogin() {
        document.getElementById("load").style.display = "";

    }
    function closeLogin() {
        document.getElementById("load").style.display = "none";

    }

	
</script>




<div id="display">
    <div class=" container">


        <div class="picturelist">

		
            <?php
                showPicList();
            ?>

            <ul class="dolls" id="dolls">
                <li><a href="#" class="dol dol1"></a></li>
                <li><a href="#" class="dol dol2"></a></li>
                <li><a href="#" class="dol dol3"></a></li>

            </ul>
        </div>





    </div>
</div>
<div id="picNew" >
    <table class="content2" style="text-align:center">
        <?php
            showPicNew();
        ?>
    </table>
</div>

</body>

</html>
<script>
	function logout(){
		deleteCookie("username");
		deleteCookie("login");
		deleteCookie("userID");
		
	}


    function ckname() {
        var name = document.getElementById("name");
        document.getElementById("name2").innerHTML = "";
        if (name.value == "") {
            document.getElementById("name2").innerHTML = "* 用户不能为空";
        } else {
            var figure = /^\d+$/;
            var letter = /^[a-zA-Z]+$/;
            if (figure.test(name.value) || letter.test(name.value) || (name.value.length < 6)) {
                document.getElementById("name2").innerHTML = "*用户不存在";
                name.value = "";
            }
        }
    }

    function ckpwd() {
        var pwd = document.getElementById("pwd");
        document.getElementById("pwd2").innerHTML = "";
        if (pwd.value == "") {
            document.getElementById("pwd2").innerHTML = "* 密码不能为空";
        } else {

            if (pwd.value.length < 6) {
                document.getElementById("pwd2").innerHTML = "* 密码错误";
                pwd.value = "";
            }
        }
    }
</script>
