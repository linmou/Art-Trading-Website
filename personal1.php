<?php include 'php_function.inc.php';
	header("content-type:text/html;charset=gb2312");?>
<?php
	$servername = "localhost";
	$username = "root";
	$password = "lxx0401";
	$database = "pj2";
// 创建连接
	$conn = mysqli_connect($servername, $username, $password,$database);
	if(isset($_COOKIE["username"])){$username = $_COOKIE["username"];}
	$sql = "SELECT * FROM users";
	$sql .= " WHERE name='$username'";
	$result = mysqli_query($conn,$sql);
	
	
	if ($result ->num_rows != 0){
	 for ($i=0;$i < $result ->num_rows;$i++){
		$row = $result ->fetch_assoc();
		$name = $row['name'];
		$tel = $row['tel'];
		$email = $row['email'];
		$address = $row['address'];
		$balance = $row['balance'];
		}
	}

	
	
?>

	
<!DOCTYPE html>
<html lang="en" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312"/>
	<link href="bootstrap-3.0.0/dist/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css\reset.css">
	<script src="cookie.js" type="text/javascript"></script>
   <title>personal</title>
</head>

<script >
	window.onload = tan();

	function del(deleteID){
		let XHR = new XMLHttpRequest();
			XHR.onreadystatechange = function () {
            if (XHR.readyState == 4){
                if ((XHR.status >= 200 && XHR.status < 300) || XHR.status == 304){
                    checkResult = XHR.responseText;
					document.getElementById(deleteID).innerHTML = "";
                } else {
                    alert("Request was unsuccessful: " + XHR.status);
                }
            }
			 };

         let url1 = addURLParam("writer.php","deleteID2",deleteID);
         XHR.open("get",url1,false);
         XHR.send();
        location.replace(location.href);
	}

	function addURLParam(url, name, value){
        url += ( url.indexOf("?") == -1 ? "?" : "&" );
        url += encodeURIComponent(name) + "=" + encodeURIComponent(value);
        return url;
    }

	function logout(){
		deleteCookie("username");
		deleteCookie("login");
		deleteCookie("userID");
		
	}
	 function tan() {
        if (getCookie("username") === "") {
		alert("please load first")
           window.location.href="load.php" ; 
        }
		
    }

</script>
<style>
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
    right: 5.5em;
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



.search {
    float: right;
    margin: auto 60px;
    display: inline;
    margin-top: 13px;
    margin-right: 5.6em;
}

    .search a {
        background-color: aliceblue;
        padding: 5px 10px;
        display: inline;
        color: black;
        font-size: 14px;
    }
	    .black_overlay{
        display: none;
        position: absolute;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 150%;
        background-color: black;
        z-index:1001;
        -moz-opacity: 0.8;
        opacity:.80;
        filter: alpha(opacity=88);
    }
   .white_content {
        display: none;
        position: absolute;
        top: 30%;
        left: 35%;
        width: 15em;
        height: 10em;
        padding: 20px;
        border: 10px solid grey;
        background-color: lightblue; 
        z-index:1002;
        overflow: auto;
    }
    .white_content a{
        color: blue;
        padding: 0.5em;
    }

.card {
    background-color: lightblue;
    margin-left:5em;
    top:4em;
    width: 350px;
    padding: 1em;
    position:relative;
    height: 150px;
    
    
    
}

    .card a{
        position:absolute;
        background-color:azure;
        right:1em;
        bottom:1em;
        color:black;
        padding:2px 8px;
    }



.upload {
    background-color: burlywood;
    height: 150px;
    width: 650px;
    right: 1em;
    margin-bottom: 1em;
    text-align:center;
    padding:10px;
    position:relative;
}
    .upload p {
        position: relative;
        transform: translateY(-50%);
        top: 40%;
    }

.buy {
    background-color:burlywood;
    height: 150px;
    width: 650px;
    right: 1em;
    margin-bottom: 1em;
    text-align: center;
    padding: 10px;
    position:relative;
}
    
    .tabuy{
        
        margin:0 auto;
        border:1px solid black;
        border-collapse:collapse;
        position:relative;
        transform:translateY(-50%);
        top:50%;
        width:95%;
        height:70%;

    }

        .tabuy td, th {
            border: 1px solid black;
            padding:5px 8px;
        }
        .tabuy tr {
            border: 1px solid black;
        }
        

.sold {
    background-color: burlywood;
    height: 150px;
    width: 650px;
    right: 1em;
    text-align: center;
    padding: 10px;
    position:relative;
}

    .sold p {
        position: relative;
        transform: translateY(-50%);
        top: 40%;
    }
</style>
<body>

    <header>
	<div id="light" class="white_content">
    <p id="tanTip">您还没有操作该页面的权限</p>
    <br>
    <br>
    <button id="yes" style="display: none" onclick="buttonClick()">确认</button>
    <p id="tanContral">
        请先<a href="register.php">注册</a>或<a href="load.php">登陆</a>
    </p>
	</div>
	<div id="fade" class="black_overlay"></div>
        <h1 id="logo">Art Store</h1>
        <span id="slogan">lalala</span>
        <ul>
            <li style="color:white">
                <a href="personal1.php" style="display:inline-block">欢迎</a>
				<?php echo $_COOKIE["username"];?>
            </li>
			<li>
                <a href="ShoppingCart.php">购物车</a>
            </li>
			<li>
               <a href="upAndChange.php">发布/修改</a>
            </li>
            <li>
                <a href="HomePage.php" onclick="logout()">登出</a>
            </li>

        </ul>
    </header>

    <div class="nav">
        <ul>
            <li><a href="HomePage.php">首页</a></li>
            <li><a href="search2.php">搜索</a></li>
           
        </ul>
        <div class="search">
            <input id="search" form="text" />
            <a href ="search2.php">搜索</a>
        </div>
    </div>
    
    <div class="main">
        <div class="card">
            <table class="tacard">
                <tr>
                    <td class="username">名称：</td>
                    <td class="username"><?php echo $name ?></td>
                </tr>
                <tr>
                    <td class="email">邮箱：</td>
                    <td class="email"><?php echo $email ?></td>
                </tr>
                <tr>
                    <td class="tel">电话：</td>
                    <td class="tel"><?php echo$tel?></td>
                </tr>
                <tr>
                    <td class="address">地址：</td>
                    <td class="address"><?php echo$address?></td>
                </tr>
                <tr>
                    <td class="balance">余额：</td>
                    <td class="balance"><?php echo$balance?></td>
                </tr>
            </table>
            <a href="topup.php">充值</a>
           
        </div>
        <div style="display:inline;position:absolute;width:750px;right:0px; top:150px;height:650px;">
            <div class="upload">
                <h5>上传的艺术品</h5>
            <table class="tabuy" class="text-nowrap">
                    <tr>
                        <th>名称</th>
                        <th>价格</th>
                        <th>上传时间</th>
                        <th></th>
						<th></th>
                    </tr>
<?php 
	MyUpLoad();
	
	function MyUpLoad(){
		global $conn;
		$userID = $_COOKIE["userID"];
		
	    $sql1 =  "SELECT * FROM artworks ";
		$sql1 .= " WHERE ownerID = '$userID'";
		$result = mysqli_query( $conn , $sql1 );

		if ($result ->num_rows != 0){
			for ($i=0;$i < $result ->num_rows;$i++){
				$row = $result ->fetch_assoc();
				$title = $row["title"];
				$price = $row["price"];
				$time = $row["timeReleased"];
				$artworkID = $row["artworkID"];
				$href = "details.php?artworkID=" . $row["artworkID"];
				$href1 = '"' . $href . '"';
				$href2 = "upAndChange.php?title=" . $row["title"];
				$href3 = '"' . $href2 . '"';
				echo'<tr id="'.$artworkID.'">';
				echo'<td><a href='.$href1.' style="color:black">'.$title.'</a></td>';
				echo'<td>'.$price.'</td>';
				echo'<td>'.$time.'</td>';
				echo'<td><button id="change" ><a href='.$href3.' style="color:black" >修改</a></button></td>';
				echo'<td>';
				echo'<button id="del" onclick="del('.$artworkID.')" >';
				echo' 删除 </button></td>';
				echo'</tr>';
			}
		}
	}


?>
            </table>
			
			</div>
            <div class="buy">
                <h5>购买的艺术品</h5>
                <table class="tabuy">
                    <tr>
                        <th>订单编号</th>
                        <th>商品名称</th>
                        <th>订单时间</th>
                        <th>订单金额</th>
                    </tr>
<?php 
	MyBought();
	
	function MyBought(){
		global $conn;
		$userID = $_COOKIE["userID"];
	    $sql =  "SELECT * FROM orders ";
		$sql .= " WHERE orderID ='$userID'";
		$result = mysqli_query( $conn, $sql );

		if ($result ->num_rows != 0){
			for ($i=0;$i < $result ->num_rows;$i++){
				$row = $result ->fetch_assoc();
				
				$price = $row["price"];
				$time = $row["timeCreated"];
				$artworkID = $row["artworkID"];
				$odID = $row["odID"];
				$href = "details.php?artworkID=" . $row["artworkID"];
				$href1 = '"' . $href . '"';
				$sql1 =  "SELECT * FROM artworks ";
				$sql1 .= " WHERE artworkID ='$artworkID'";
				$result1 = mysqli_query( $conn, $sql1 );
					if ($result1 ->num_rows != 0){
						for ($i=0;$i < $result1 ->num_rows;$i++){
						$row1 = $result1 ->fetch_assoc();
						$title = $row1["title"];
						echo'<tr id="'.$artworkID.'">';
						echo'<td>'.$odID.'</td>';
						echo'<td><a href='.$href1.' style="color:black">'.$title.'</a></td>';
						echo'<td>'.$time.'</td>';
						echo'<td>'.$price.'</td>';
				
						echo'</tr>';
						}
					}

			}
		}
	}
?>
                </table>
            </div>
            <div class="sold">
                <h5>出售的艺术品</h5>
            <table class="tabuy">
                    <tr>
                        <th>商品名称</th>
                        <th>出售时间</th>
                        <th>出售金额</th>
                        <th>用户名</th>
						<th>邮箱</th>
						<th>电话</th>
						<th>地址</th>
                    </tr>
   <?php 
					

	MySolt();
	

	function MySolt(){
		global $conn;
		$userID = $_COOKIE["userID"];
	    $sql =  "SELECT * FROM orders ";
		$sql .= " WHERE ownerID ='$userID'";
		$result = mysqli_query( $conn, $sql );

		if ($result ->num_rows != 0){
			for ($i=0;$i < $result ->num_rows;$i++){
				$row = $result ->fetch_assoc();
				$title = $row["title"];
				$price = $row["price"];
				$time = $row["timeCreated"];
				$artworkID = $row["artworkID"];
				$orderID = $row["orderID"];
				$href = "details.php?artworkID=" . $row["artworkID"];
				$href1 = '"' . $href . '"';
				$sql1 =  "SELECT * FROM users ";
				$sql1 .= " WHERE userID ='$orderID'";
				$result1 = mysqli_query( $conn, $sql1 );
					if ($result ->num_rows != 0){
						for ($i=0;$i < $result ->num_rows;$i++){
							$row = $result ->fetch_assoc();
							$email = $row["email"];
							$tel = $row["tel"];
							$add = $row["address"];
							echo'<tr>';
							
							echo'<td><a href='.$href1.' style="color:black">'.$title.'</a></td>';
							echo'<td>'.timeCreated.'</td>';
							echo'<td>'.$price.'</td>';
							echo'<td>'.$orderID.'</td>';
							echo'<td>'.$email.'</td>';
							echo'<td>'.$tel.'</td>';
							echo'<td>'.$address.'</td>';
				
							echo'</tr>';
						}
					}

				
			
			}
		}
	}
?>

                </table>
			</div>
        </div>


    </div>
</body>

</html>
