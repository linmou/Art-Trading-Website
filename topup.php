<?php include 'php_function.inc.php'; ?>


<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>recharge</title>
    <link rel="stylesheet" type="text/css" href="css\reset.css" />
    <style type="text/css">
        a {
            text-decoration: none;
            color: white;
        }

        * {
            margin: 0;
            padding: 0;
        }

        ul {
            list-style: none;
        }

        body {
            background-color: beige;
            min-width: 1280px;
            position: relative;
            margin: 0;
        }

        header {
            background-color: black;
        }

        #logo {
            display: inline;
            color: white;
            padding-left: 3em;
            font-size: 200%;
        }

        #slogan {
            display: inline;
            color: white;
            font-family: "Times New Roman";
        }

        header ul {
            display: inline;
            list-style: none;
            position: absolute;
            top: 0.5em;
            right: 5em;
        }

        header li {
            display: inline;
            list-style: none;
            padding-left: 0.5em;
        }

        header li a {
            color: white;
        }

        header li a:hover {
            background-color: red;
        }

        .nav {
            position: relative;
            width: 100%;
            height: 50px;
            background-color: darkgrey;
        }

        .nav ul {
            display: inline;
            list-style: none;
            position: absolute;
            top: 0.7em;
            left: 5em;
        }

        .nav ul li {
            display: inline;
            list-style: none;
            padding-left: 3em;
        }

        .nav ul li a {
            color: white;
            font-size: 120%;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            text-decoration: underline;
        }

        .search {
            float: right;
            margin: auto 60px;
            display: inline;
            margin-top: 13px;
        }

        .search a {
            background-color: aliceblue;
            padding: 10px;
            display: inline;
            color: black;
            font-size: 14px;
        }

        .top-up {
            position: relative;
            margin: auto;
            margin-top: 8em;
            background-color: gainsboro;
            padding: 10px;
        }

        .top-up td {
            padding: 10px 5px;
        }
    </style>

</head>

<body>
<header>
    <h1 id="logo"> Art Store</h1>
    <span id="slogan"> lalala</span>
	 <ul>
            <li style="color:white">
                <a href="personal1.php" style="display:inline-block">欢迎</a>
				<?php echo $_COOKIE["username"];?>
            </li>
            <li>
                <a href="HomePage.php" onclick="logout()">登出</a>
            </li>

    </ul>
</header>

<div class="nav">
    <ul>
        <li> <a href="HomePage.php"> 首页</a> </li>
        <li> <a href="search.php"> 搜索</a> </li>
        
    </ul>
    <div class="search">
        <input id="search" form="text" / >
        <a href="search2.html"> 搜索</a>
    </div>
</div>

<table class="top-up">
<form action="writer.php" method="get" class="form" onsubmit="return checkform(this)">
    <tr>
	<td>
        <div class="money" style="display:inline">
            充值金额：<br>
            <input type="text" name="money" id="money" onblur="ckMoney()" required="required" />
            <div id="money2" class="error_box" style="display:inline-block"></div>
        </div>
	</td>
    </tr>
    <tr>
        
        <td>
            <input type="radio" name="way" checked / > 支付宝
            <input type="radio" name="way" / > 微信支付
        </td>
    </tr>
    <tr>
        <td colspan="2" style="font-size:12px"> <input type="radio" checked / > 同意《本站虚拟货币交易服务协定》</td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:center">
        <button type="submit" class="submit" > 立即充值</button> 

        </td>
    </tr>
	</form>
</table>
</body>
</html>
<script>
window.onload = tan();
 function tan() {
        if (getCookie("username") === "") {
		alert("please load first")
           window.location.href="load.php" ; 
        }
		
    }
    function x() {
        alert("充值成功,到账需要一定时间，请耐心等待")
    }
</script>