<?php include 'php_function.inc.php'; ?>
<?php
$artworkID = getDataByURL("artworkID");
 addviews($artworkID);


global $conn;
    $sql = "SELECT * FROM artworks";
    $sql .= " WHERE artworkID='$artworkID'";
    $result = mysqli_query($conn,$sql);
    $row = $result->fetch_assoc();

	$title = $row["title"];
	$artist = $row["artist"];
	$description = $row["description"];
	$price = $row["price"];
	$yearOfWork = $row["yearOfWork"];
	$width = $row["width"];
	$height = $row["height"];
	$genre = $row["genre"];
	$view = $row["view"];
	
	$orderID = $row["orderID"];

	if(isset($orderID)){
		echo'<h3>';
		echo"已出售";
		echo'</h3>';
	}
	

	savePath();

	echo' <link rel="stylesheet" type="text/css" href="css\details.css" />';
?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>detail</title>
	<link rel="stylesheet" type="text/css" href="css\reset.css" />
    <link rel="stylesheet" type="text/css" href="css\details.css" />
    <script src="cookie.js" type="text/javascript"></script>
    <script type="text/javascript">
	var addResult = 3;
	function disp_alert() {
    shopping();
        if (addResult == 0){
            alert("该商品已经在购物车里了");
			
        }
        if (addResult == 2){
            alert("此商品已被买走");
        }
        if (addResult == 1){
           alert("添加成功");
        }
    }
    function  shopping() {			
		let XHR = new XMLHttpRequest();
        XHR.onreadystatechange = function () {
            if (XHR.readyState == 4){
                if (XHR.status >= 200 ){
                    var ch = XHR.responseText;
					var a =ch.length-1;
					addResult=ch.charAt(a );
					console.log(addResult);
					
                } else {
                    alert("Request was unsuccessful: " + XHR.status);
                }
            }
        };
        let artworkID = getURL("artworkID");

        let url = addURLParam("writer.php","artworkID",artworkID);
        XHR.open("get",url,false);
        XHR.send();
    }

	 function getURL(cname) {
        let name = cname + "=";
        let ca = document.URL.split("?");
        let ca1 = ca[1].split("&");

        for (let i= 0;i<ca1.length;i++){
            let c = ca1[i].trim();
            if (c.indexOf(name) == 0){
                return c.substring(name.length,c.length);
            }
        }
        return "";
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

    </script>
</head>
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
    <div class="search">
        <input id="search" form="text" />
        <a href="search2.php">搜索</a>
    </div>
</div>

<div class="main">
    <h2 class="title" id="title"><?php echo$title ?></h2>
    <p class="artist" id="artist"><a href="search2.php" style="text-decoration:underline;color:black;"><?php echo$artist ?></a></p>
    <?php
		echo'<img src=".\resources\img//'.$artworkID.'.jpg" class="img"  height="444" width="330"/ >';
	
	?>
    <div class="details">
        <p class="descripton" id="description" style="font-style: italic;
        font-size: 16px;
        height: 70px;
        width: 300px;
        overflow:scroll;
        margin-bottom: 10px;">
           <?php echo$description ?>
        </p>
        <p class="price">
            PRICE:<strong><?php echo$price ?></strong>
        </p>
        <div class="button1">
            <img src=".\icon\2.ico" onclick="disp_alert()" style="margin-right:15px" >Add to shoppingcart
            <div style="display:block"><img src=".\icon\1.ico" onclick="disp_alert()" style="margin-right:15px">Add to wishlist</div>
        </div>
        <table class="tadetails" style="width=300px;height=200px">
            <tbody>
            <tr>
                <th colspan="2">Product Details</th>
            </tr>
            <tr>
                <td>Date:</td>
                <td class="yearOfWork" id="yearOfWork"><?php echo$yearOfWork ?></td>
            </tr>
            <tr>
                <td>Width:</td>
                <td class="width" id="width"><?php echo$width ?></td>
            </tr>
            <tr>
                <td>Height:</td>
                <td class="height" id="height"><?php echo$height ?></td>
            </tr>
            
            <tr>
                <td>Genres:</td>
                <td class="genre" id="genre"><?php echo$genre ?></td>
            </tr>
            
            <tr>
                <td>View:</td>
                <td class="view" id="view"><?php echo$view ?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="aside">
        <table class="tapoparist" style="width:200px;">
            <tr><th style="background-color:cornflowerblue">Pop Artist</th></tr>
            <tr><td><a href="#">Van Gogh</a></td></tr>
            <tr><td><a href="#">Picasso</a></td></tr>
            <tr><td><a href="#">Monet</a></td></tr>
            <tr><td><a href="#">Da Vinci</a></td></tr>
            <tr><td><a href="#">Paul Cézanne</a></td></tr>
            <tr><td><a href="#">Rousseau</a></td></tr>
        </table>
        <table class="tapopGenre" style="width:200px;">
            <tr><th style="background-color:cornflowerblue">Pop Genres</th></tr>
            <tr><td><a href="#">Classic</a></td></tr>
            <tr><td><a href="#">Neoclassical</a></td></tr>
            <tr><td><a href="#">Impressionism</a></td></tr>
            <tr><td><a href="#"> Cubism</a></td></tr>
            <tr><td><a href="#">surrealism</a></td></tr>
            <tr><td><a href="#">Barbizon</a></td></tr>
        </table>
    </div>

</div>


</body>
</html>