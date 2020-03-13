
<?php include 'php_function.inc.php'; ?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>register</title>
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

        form {
            position: relative;
            margin-left: 550px;
            margin-top: 5em;
            width: auto;
        }

        input {
            width: 200px;
            height: 20px;
        }

        .name {
            margin-bottom: 1em;
        }

        .pwd {
            margin-bottom: 1em;
        }

        .phone {
            margin-bottom: 1em;
        }

		.email {
            margin-bottom: 1em;
        }

		.address {
            margin-bottom: 1em;
        }

        .submit {
            width: 60px;
            //position: absolute;
            margin-left: 50px;
        }

        .error_box {
            color: red
        }
    </style>
</head>
<body>
<header>
    <h1 id="logo">Art Store</h1>
    <span id="slogan">lalala</span>

</header>

<div class="nav">
    <ul>
        <li><a href="HomePage.php">首页</a></li>
        <li><a href="search2.php">搜索</a></li>
        
    </ul>
    <div class="search">
        <input id="search" form="text" />
        <a href="search.php">搜索</a>
    </div>
</div>

<section>
    <form action="writer.php" method="post" class="form" onsubmit="return checkform(this)">
        <div class="name">
            用户名<br>
            <input type="text" name="name" id="name" onblur="cknamd()" required="required" />
            <div id="name2" class="error_box" style="display:inline-block"></div>
        </div>

        <div class="pwd">
            设置密码<br />
            <input type="password" name="pwd" id="pwd" onblur="ckpwd()" required />
            <div id="pwd2" class="error_box" style="display:inline-block"></div>
        </div>

        <div class="pwd">
            确认密码<br />
            <input type="password" name="repwd" id="repwd" onblur="ckrepwd()" required>
            <div id="pwd3" class="error_box" style="display:inline-block"></div>
        </div>

        <div class="phone">
            您的手机号<br>
            <input type="text" name="phone" id="phone" onblur="ckphone()" required>
            <div id="phone2" class="error_box" style="display:inline-block"></div>
        </div>
		<div class="email">
            您的邮箱<br>
            <input type="text" name="email" id="email" onblur="ckEmail()" required>
            <div id="email2" class="error_box" style="display:inline-block"></div>
        </div>
		<div class="address">
            您的地址<br>
            <input type="text" name="address" id="address" onblur="ckAddress()" required>
            <div id="address2" class="error_box" style="display:inline-block"></div>
        </div>
        <div class="veri">
            <span>请输入验证码</span>
            <input type="text" class="inputcode"  required="required" id="Yzm" style="width: 200px; display:block;" onblur="validate()"  />
            <canvas id="c1" class="canvas"  width="200" height="40" onclick="createCode()" /></canvas>

        </div>
        <input type="submit"  value="注册" class="submit"  />

    </form>

</section>
</body>
</html>

<script>

    window.onload=createCode();

    function cknamd() {
        var re = true;
        var name = document.getElementById("name");
        document.getElementById("name2").innerHTML = "";
        if (name.value == "") {
            document.getElementById("name2").innerHTML = "* 用户不能为空";
            re = false;
        } else {
	    re = ajaxCheck();
		
        }
		console.log(re);
        return re;

    }

    function ckpwd() {
        var pwd = document.getElementById("pwd");
        var name = document.getElementById("name");
		var re = true;
        document.getElementById("pwd2").innerHTML = "";
        if (pwd.value == "") {
            document.getElementById("pwd2").innerHTML = "* 密码不能为空";
            re= false;
        } else if (pwd.value == name.value) {
                document.getElementById("pwd2").innerHTML = "*密码不能与用户名一致";
                pwd.value = "";
                re= false;
            }
			
        
		console.log(re);
		return re;

    }

    function ckrepwd() {
        var repwd = document.getElementById("repwd");
		var re = true;
        document.getElementById("pwd3").innerHTML = "";
        if (repwd.value == "") {
            document.getElementById("pwd3").innerHTML = "* 此处不能为空";
            re= false;
        } else {
            var pwd = document.getElementById("pwd").value;
            if (repwd.value != pwd) {
                document.getElementById("pwd3").innerHTML = "* 确认密码错误";
                repwd.value = "";
                re= false;
            }
			
        }
		console.log(re);
		return re;
    }

    function ckphone() {
		var re = true;
        var ph = document.getElementById("phone");
        document.getElementById("phone2").innerHTML = "";
        if (ph.value == "") {
            document.getElementById("phone2").innerHTML = "* 此处不能为空";
            re= false;
        } else {
            var reg = /^((0\d{2,3}-\d{7,8})|(1[3584]\d{9}))$/;
            if (!reg.test(ph.value)) {
                document.getElementById("phone2").innerHTML = "* 号码错误,请输入正确的中国大陆手机号";
                ph.value = "";
                re= false;
            }
		
        }
		console.log(re);
		return re;
    }


	function ckAddress() {
		var re = true;
        var ad = document.getElementById("address");
		document.getElementById("address2").innerHTML = "";
        if (ad.value == ""){
            document.getElementById("address2").innerHTML="* 地址不能为空";
            re= false;
        }

      
        console.log(re);
		return re;
    }

	  function ckEmail() {
		var re = true; 
        var email = document.getElementById("email");
		  document.getElementById("email2").innerHTML="";
        if(email.value ==""){
            document.getElementById("email2").innerHTML="*邮箱不能为空";
            
            re = false;
        }else{
            var vemail = /^[0-9a-zA-Z]+(?:[\_\.\-][a-z0-9\-]+)*@[a-zA-Z0-9]+(?:[-.][a-zA-Z0-9]+)*\.[a-zA-Z]+$/i;
            if(!vemail.test(email.value)){
                document.getElementById("email2").innerHTML="*邮箱格式错误";
                
                re =false;
            }
        }
      
        console.log(re);
		return re;
    }

    //在全局定义验证码
    //产生验证码
  
    var code="";   
    function createCode() {

		var num = [];
		var canvas = document.getElementById("c1");
		var canvas_width = c1.width;
		var canvas_height = c1.height;
		var context = canvas.getContext("2d");
		context.clearRect(0, 0, canvas_width, canvas_height);


       

        var ran = new Array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');//随机数
        for (var i = 0; i < 4; i++) {//循环操作
        var j = Math.floor(Math.random() * 36);
        var deg = Math.random() * 30 * Math.PI / 180;
        var txt = ran[j];
        //num[i] = txt.toLowerCase();
		code += txt;
        var x = 10 + i * 20;
        var y = 20 + Math.random() * 8;
        context.font = "bold 26px 微软雅黑";
        context.translate(x, y);
        context.rotate(deg);
        context.fillStyle = randomColor();
        context.fillText(txt, 0, 0);
        context.rotate(-deg);
        context.translate(-x, -y);
		}

		console.log(code);
       

    }

	 function randomColor() {
        var r = Math.floor(Math.random() * 256);
        var g = Math.floor(Math.random() * 256);
        var b = Math.floor(Math.random() * 256);
        return "rgb(" + r + "," + g + "," + b + ")";
    }



    var YZM;
    function validate() {
		
		
        var inputCode = document.getElementById("Yzm").value.toUpperCase(); //取得输入的验证码并转化为大写
        if (inputCode.length <= 0) { //若输入的验证码长度为0
            alert("请输入验证码！"); //则弹出请输入验证码
            //$("#Yzm").focus();
            YZM = false;
        }
        else if (inputCode != code) { //若输入的验证码与产生的验证码不一致时
            alert("验证码输入错误！@_@"); //则弹出验证码输入错误
            createCode();//刷新验证码
            Yzm.value = "";//清空文本框
            //$("#Yzm").focus();//重新聚焦验证码框
            YZM = false;
        }
        else { //输入正确时

            YZM = true;

        }
        //validate();
		console.log(YZM);
        return YZM;

    };


	function addURLParam(url, name, value){
        url += ( url.indexOf("?") == -1 ? "?" : "&" );
        url += encodeURIComponent(name) + "=" + encodeURIComponent(value);
        return url;
    }

    function ajaxCheck() {
		var re =true;
		var checkResult = 1 ;
		var Rname = document.getElementById("name").value;
		
        let xmlhttp = new XMLHttpRequest();

		let url = addURLParam("check.php","Rname",Rname);
        
		xmlhttp.open("GET",url,true);

        xmlhttp.onreadystatechange = function () {

            if (xmlhttp.readyState == 4){

                if (xmlhttp.status >= 200 ){
							
                    var ch = xmlhttp.responseText;
					var a =ch.length-1;
					
					checkResult=ch.charAt(a );
					if (checkResult == 0 ) {
					document.getElementById("name2").innerHTML = " * 用户名已存在";

					re = false;
					checkResult=1;
			  
					} 
					
					
                } else {
                    alert("Request was unsuccessful: " + xmlhttp.status);
                }
            }
        };

	

        xmlhttp.send();
		return re;
		   

    }


    function checkform() { 
        if (YZM == true & cknamd() == true & ckphone() == true & ckpwd() == true & ckrepwd() == true & ckEmail() == true & ckAddress() == true ) {
            alert("注册成功");

            return true;
        }
        else {
			alert("注册失败");
            return false;
        }

    }





</script>
