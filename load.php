<?php include 'php_function.inc.php'; ?>


<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>load</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
	<link rel="stylesheet" type="text/css" href="css/StyleSheet1.css" />
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

        .form {
            //position: relative;
            left: 550px;
            //margin-top: 5em;
			//margin:auto;
            //width: auto;
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

        .error_box {
            color: red
        }

        .submit {
            width: 70px;
           
            margin-left: 100px;
            border-radius: 3px;
            background-color: cornflowerblue;
        }
    </style>
</head>
<script src="cookie.js" type="text/javascript"></script>
<body>
<header>
    <h1 id="logo">Art Store</h1>
    <span id="slogan">lalala</span>

</header>

<div class="nav">
    <ul>
        <li><a href="HomePage.php">首页</a></li>
        <li><a href="search.php">搜索</a></li>
        
    </ul>
    <div class="search">
        <input id="search" form="text" />
        <a href="search.php">搜索</a>
    </div>
</div>


    <form action="HomePage.php" method="post" class="form" onsubmit=" return check()">
        <div>用户：<input id="name" type="text" class="name" onblur="ckname()"> <div id="name2" class="error_box"style="display:inline-block"></div></div>
        <div >密码：<input id="pwd" type="password" onblur="ckpwd()" class="pwd"><div id="pwd2" class="error_box"style="display:inline-block"></div></div>
        <input type="submit" value="登录" id="button" class="submit">
    </form>





<script  type="text/javascript">
	var pass = true;
    var checkResult = 0;

    function ckname() {
        var name=document.getElementById("name");
        document.getElementById("name2").innerHTML="";
        if (name.value==="") {
            document.getElementById("name2").innerHTML = " * 用户不能为空" ;
			
			pass = false;
			
        }
		return pass;
    }

    function ckpwd() {
        let pwd=document.getElementById("pwd");
        document.getElementById("pwd2").innerHTML="";
        if (pwd.value===""){
            document.getElementById("pwd2").innerHTML = " * 密码不能为空";
			
			pass = false;
			
        } 
		return pass;

    }

	function addURLParam(url, name, value){
        url += ( url.indexOf("?") == -1 ? "?" : "&" );
        url += encodeURIComponent(name) + "=" + encodeURIComponent(value);
        return url;
    }

    function ajaxCheck(Lname,pwd) {

        let xmlhttp = new XMLHttpRequest();

		let url = addURLParam("check.php","Lname",Lname);
        let url1 = addURLParam(url,"pwd",pwd);

		xmlhttp.open("GET",url1,false);

        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4){
                if (xmlhttp.status >= 200 ){
				
			
                    var ch = xmlhttp.responseText;
					var a =ch.length-1;
					checkResult=ch.charAt(a );
					
					console.log(checkResult);
                } else {
                    alert("Request was unsuccessful: " + xmlhttp.status);
                }
            }
        };

        
        xmlhttp.send();
    }

    function checkNameAndPwd() {

        $Lname = document.getElementById("name").value;
        $pwd = document.getElementById("pwd").value;

        ajaxCheck($Lname,$pwd);
		
		
        if (checkResult == 0){
			
            document.getElementById("pwd2").innerHTML = " * 账号或密码错误";
            pass = false;
			console.log(2);
        }
        else if (checkResult == 1 ) {

			console.log(3);
			pass = true;
            setCookie("username",$Lname);
            setCookie("login","1");
           
			
            
        }
		return pass;
		
    }


	function check(){
		ckname();
		ckpwd();
		
		checkNameAndPwd();
		console.log(pass);
		return pass;
	}

</script>
</body>
</html>