<?php
$servername = "localhost";
$username = "root";
$password = "lxx0401";
$database = "pj2";
// 创建连接
$conn = mysqli_connect($servername, $username, $password,$database);
// 检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM artworks ORDER BY view DESC ";

$cartsTotalPay = 0;


echo' <script src="cookie.js" type="text/javascript"></script>';



//cookie_____________________________________________________________________


//该函数用于创建cookie
function creatCookie($name,$value){
    $expiryTime = time()+60*60*24;
    setcookie($name,$value,$expiryTime);
}

//该函数用于删除cookie
function deleteCookie($name){
    $expiryTime = time() - 100;
    setcookie($name,"",$expiryTime);
}


//HomePage__________________________________________________________________

function NabIN(){
    echo "<li>";
    echo '<a href="personal1.php">';
    
    echo '欢迎'.$_COOKIE["username"];
    echo '</a>';
    echo '</li>';

    echo "<li>";
    echo '<a href="ShoppingCart.php">';
    echo '购物车';
    echo '</a>';
    echo '</li>';

	echo "<li>";
    echo '<a href="upAndChange.php">';
    echo '发布/修改';
    echo '</a>';
    echo '</li>';

    echo "<li>";
    echo '<a href="HomePage.php" onclick="logout()">';
    echo '登出';
    echo '</a>';
    echo '</li>';
}

function NabOUT(){
    echo "<li>";
    echo '<a href="load.php">';
    echo '登陆';
    echo '</a>';
    echo '</li>';

    echo "<li>";
    echo '<a href="register.php">';
    echo '注册';
    echo '</a>';
    echo '</li>';
}

function logout(){
	deleteCookie("username");
	deleteCookie("login");
	NabOUT();
}


//画廊
function showPicList(){
	global $conn;
    global $sql;
    $result = mysqli_query($conn,$sql);
    for ($i = 1; $i < 4; $i++){
        $row = $result->fetch_assoc();
        if (isset($row["orderID"])){
            $i--;
        }
	else{
	    
		$title=$row["title"];
		$artist=$row["artist"];
		$description=$row["description"];
		$artworkID=$row["artworkID"];
		
		$href = "details.php?artworkID=" . $row["artworkID"];
        $href1 = '"' . $href . '"';

		echo'<div class="picture" id="picture'.$i.'">';
		echo'<a name="picture'.$i.'">';
		echo'<img src=".\resources\img//'. $artworkID .'.jpg" class="img">';
        echo'<div class="content" id="content' .$i .'" style="display:block">';
        echo'<p class="name">'.$title.'</p>';
        echo'<p class="author">'.$artist.'</p>';
        echo'<p class="intro">'.$description.'</p>';
        echo'<p class="button">';
		echo'<a href='.$href1.'  >learn more</a>';
		echo'</p>';
        echo'</div>';
        echo'</a>';
        echo'</div>';
		}
	}
}



//最新画作

function showPicNew(){
	global $conn;
    $sql = "SELECT * FROM artworks ORDER BY timeReleased DESC ";
    $result = mysqli_query($conn,$sql);

	for ($i = 1; $i < 4; $i++){
        $row = $result->fetch_assoc();
        if (isset($row["orderID"])){
            $i--;
        }
		else {
		$artworkID=$row["artworkID"];
		$href = "details.php?artworkID=" . $row["artworkID"];
        $href1 = '"' . $href . '"';
		$title=$row["title"];
		$artist=$row["artist"];
		$description=$row["description"];
			
			echo'<td >';
			echo'<img src=".\resources\img//'. $artworkID .'.jpg" class="img2" style="width:100px;height:100px;margin:auto">';
			echo'<div class="name">'.$title.'</div>';
			echo'<div class="author">'.$artist.'</div>';
			echo'<div class="intro" >'.$description.'</div>';
		    echo'<p class="button">';
			echo'<a href='.$href1.'  >learn more</a>';
			echo'<td>';
			
		}
	}
	
}
//------------搜索界面-----------------------------------------------------------------------------------------------------------------------

//返回结果数
function getTotalCount($sql){
    global $conn;
    $result = mysqli_query($conn, $sql);
    if($result)
        $totalCount = $result->num_rows;
    else
        $totalCount = 0;

    return $totalCount;
}

//返回当前界面位置
function getCurrentPage(){
    if(!isset($_GET['page']))
        $currentPage = 1;
    else
        $currentPage = $_GET['page'];

    return $currentPage;
}


function showImg($sql1){
	global $conn;	
	$result = mysqli_query($conn, $sql1);
	while ($row = $result ->fetch_assoc()){
	if(!isset($row["orderID"])){
		$artworkID=$row["artworkID"];
		$href = "details.php?artworkID=" . $row["artworkID"];
		$href1 = '"' . $href . '"';
		echo'<li style=" float: left; padding: 0px;position: relative;overflow: hidden;list-style-type: none;"> ';
		echo'<a href='.$href1.'>';
		echo'<img src=".\resources\img//'. $row["artworkID"]. '.jpg"  style=" height:130px; width:130px;">';
		echo'</a>';				  
		echo'</li>';
	}
	
	}
				
}

//-------------------------------------购物车----------------------------------------------------------------------------
$cartsTotalPay = 0;
function showCart(){
global $conn;
$userID = $_COOKIE["userID"];
$sql = "SELECT * FROM carts  ";
$sql .= " WHERE userID='$userID'";
$result = mysqli_query($conn,$sql);
if ($result ->num_rows != 0){
        for ($i=0;$i < $result ->num_rows;$i++){
			$row = $result ->fetch_assoc();
            $artworkID = $row["artworkID"];
			$sql1 = "SELECT * FROM artworks ";
			$sql1 .= " WHERE artworkID='$artworkID'";
			$result1 = mysqli_query($conn,$sql1);
			for ($k = 0;$k<$result1 ->num_rows;$k++){
				global $cartsTotalPay;
				$href = "details.php?artworkID=" . $row["artworkID"];
				$href1 = '"' . $href . '"';
				$row1 = $result1->fetch_assoc();
				$artworkID = $row1['artworkID'];		
				$title = $row1["title"];
				$artist = $row1["artist"];
				$description = $row1["description"];
				$price2 = $row1["price"];
				$cartsTotalPay += (int)($row1["price"]);
			    echo'<tr>';
				echo'<td style="background-color:aliceblue;padding:10px 10px;" id="'.$artworkID.'"><div class="pic"><a href='.$href1.'>';
				echo'<img src=".\resources\img//'.$artworkID.'.jpg" class="img"  style="height:200px;width:200px"/ ></a></div></td>';
				echo'<td class="content">';
				echo'<div>';
                echo'<p class="name">'.$title .'</p>';
                echo'<p class="author"><a href="search.html" style="color:black">'.$artist .'</a></p>';
                echo'<div class="intro">'.$description .'</div>';
		        echo'</td>';
			    echo'<td style="background-color:aliceblue;padding:10px 10px;">';
                echo'<div class="button">';
                echo'<div class="price">'.$price2 .'</div>';
                echo'<div class="choose"  id="'.$artworkID.'"><label><input type="checkbox" name="choose" value="'.$price2.'&'.$artworkID.'" onclick="calprice()" style="margin-right:2px;" />选择</label></div>';
                echo'<div class="delete" onclick="del('.$artworkID.')">删除</div>';
                echo'</div>';
	            echo'</td>';
			    echo'</tr>';
			}
		
		}
}
		
}

function totalPay(){
global $cartsTotalPay;
	echo $cartsTotalPay;
}

//--------------------------------个人信息--------------------------

/*function MyUpLoad(){
	
	global $conn;
	$userID = $_COOKIE["userID"];
	$sql =  "SELECT * FROM artworks ";
	$sql .= " WHERE ownerID='$userID'";
	$result = mysqli_query( $conn, $sql );

    if ($result ->num_rows != 0){
        for ($i=0;$i < $result ->num_rows;$i++){
		$row = $result ->fetch_assoc();
		$title = $row["title"];
		$price = $row["price"];
		$time = $row["timeReleased"];
		echo'<tr>';
		echo'<td>'.$title.'</td>';
		echo'<td>'.$price.'</td>';
		echo'<td>'.$time.'</td>';
		echo'<td><button id="change">修改</button></td>';
		echo'<td><button id="del">删除</button></td>';
		}
	}
	
}*/


	
	 


//取出URL的信息

function getDataByURL($toGet){
    $data="";
	$j=0;
    $url =  'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];//获取完整url
    $array = explode("?",$url);//分割
    $url1 = $array[1];
    $array1 = explode("&",$url1);

    for ($i = 0;$i<count($array1);$i++){
		$data1 ="";
        $array2 = explode("=",$array1[$i]);
        if ($array2[0] === $toGet){    
            $data += $array2[1];
			
        }
		
    }
    return $data;
}

//返回用户ID
function getUserID($username){
    global $conn;
    $sql = "SELECT * FROM users";
    $sql .= " WHERE name='$username'";

    $result = mysqli_query( $conn, $sql );
    $row = $result ->fetch_assoc();

    return $row["userID"];
}

//存储足迹
function savePath(){
    $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	
	for($i=0;$i<=2;$i++){
    
        if (!isset($_COOKIE["history$i"]) ){
            setcookie("history$i",$url);
        }else{
			continue;
		}
		break;

	}	
 }



 //增加访问量
function addviews($artworkID){
    global $conn;
    $sql = "SELECT * FROM artworks";
    $sql .= " WHERE artworkID='$artworkID'";
    $result = mysqli_query($conn,$sql);
    $row = $result->fetch_assoc();

    $finalViews = (int)($row["view"]) + 1;

    $sql1 = "UPDATE artworks ".
        "SET view = '$finalViews'".
        "WHERE artworkID='$artworkID'";

    $result1 = mysqli_query($conn,$sql1);
}


?>