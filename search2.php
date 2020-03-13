
<?php include 'php_function.inc.php';
?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>search</title>
	<link rel="stylesheet" type="text/css" href="css\reset.css">
	<link rel="stylesheet" type="text/css" href="css/StyleSheet1.css" />
</head>
<style>

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
        left: 3em;
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

form{
	
	width:300px;
	position:relative;
	margin:auto;
	margin-top:3em;
}

form p{
	color:black;
}
</style>
<script>
	function logout(){
		deleteCookie("username");
		deleteCookie("login");
		deleteCookie("userID");
		
	}
</script>
<body>
<header>
    <h1 id="logo">Art Store</h1>
    <span id="slogan">lalala</span>
     <ul>
         <?php
        if (isset($_COOKIE["username"])){
            NabIN();
        }
        else{
            NabOUT();
        }
        ?>


    </ul>
</header>
<div class="nav">
        <ul>
            <li><a href="HomePage.php">首页</a></li>
            <li><a href="search2.php">搜索</a></li>
           
        </ul>
</div>
<form action="search.php" method="get">
		<div class="sort">
		<p style="display:inline">
        排序方式：	
		</p>
		<div>
		<input type="radio" value="view" name="sort" style="display:inline" checked ="checked">热度</input>
        <input type="radio" value="price" name="sort" style="display:inline">价格</input>
		</div>
		</div>
		<div class="key">
		<p style="display:inline">
        搜索模式：	
		</p>
		<div >
                <input value="artist" type="checkbox" name="keyWords" >作者</input>
                <input value="title" type="checkbox" name="keyWords"  >名称</input>
                <input value="description" type="checkbox" name="keyWords"  >简介</input>
         </div>
		 </div>
		 <div style="margin:2em;">
        <input id="searchContent" type="text" name="searchContent">
        <button id="search2" type="submit" >搜索</button>
		</div>
	</form>
</body>
</html>