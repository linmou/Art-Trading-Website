<?php include "php_function.inc.php" ?>
<?php

date_default_timezone_set('prc');
$servername = "localhost";
$username = "root";
$password = "lxx0401";
$database = "pj2";
$conn = mysqli_connect($servername, $username, $password,$database);
$sql = "SELECT * FROM users";

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["name"]) && isset($_POST["email"]) &&isset($_POST["pwd"]) &&isset($_POST["address"]) &&isset($_POST["phone"])){
    insertUser();
	console.log(1);
}

if (isset($_GET["artworkID"]) && isset($_COOKIE["userID"])){
        if (checkBeBought() != 2){
            $addResult = addCharts();
            echo $addResult;//Ϊ1��0
        }
        else{
            echo 2;//������Ʒ�Ѿ���������
        }
}

if (isset($_POST["title"]) && isset($_POST["author"]) && isset($_POST["description"]) && isset($_POST["genre"]) &&
    isset($_POST["width"]) && isset($_POST["height"]) && isset($_POST["price"]) && isset($_POST["year"])) {
	insertArtWork();
}



if (isset($_GET["deleteID"])){
    deleteCart($_GET['deleteID']);
    jump("ShoppingCart2.php");
}

if (isset($_GET["deleteID2"])){
    deleteUp($_GET['deleteID2']);
    jump("personal1.php");
}


if(isset($_GET["money"])){
	charge();
}

if(isset($_POST["artworkIDs"])&&isset($_POST["totalPrice"])){

	pay();	
}


//�������޸�ͼƬ
function insertArtWork(){
  global $conn;
  $title = $_POST["title"];
 
  $artist = $_POST["author"];
  //echo $artist;
  $description =$_POST["description"];

  $year = $_POST["year"];
  //echo $year;
  $genre= $_POST["genre"];
  //echo $genre;
  $width = $_POST["width"];
  //echo $width;
  $height= $_POST["height"];
  //echo $height;
  $price = $_POST["price"];
  //echo $price;
  $ownerID = $_COOKIE["userID"];
 
  $timeReleased = date('Y-m-d h:i:s', time());
   $sqll = "SELECT * FROM artworks";
   $result = mysqli_query($conn,$sqll);
	while($row = $result->fetch_assoc()){
	
        if ($title === $row["title"] ){
			
			$sql1 = "UPDATE artworks ";
			$sql1 .= "SET artist='$artist'";
			$sql1 .=",yearOfWork='$year'";
			$sql1 .=",genre='$genre'";
			$sql1 .=",width='$width'";
			$sql1 .=",height='$height'";
			$sql1 .=",price='$price'";		
			$sql1 .=",timeReleased='$timeReleased'";
			$sql1 .="WHERE title ='$title'";
			
		
			$result1 = mysqli_query($conn,$sql1);
			if ($result1 ){
				echo "<script>alert('successfully charge')</script>";						
				jump("HomePage.php");
				break;
			 }
		break;
		}else {
		
			$sql2 = "INSERT INTO artworks ".
			"(artist,title,description,yearOfWork,genre,width,height,price,ownerID,timeReleased) ".
			"VALUES ".
			"('$artist','$title','$description','$year','$genre','$width','$height','$price','$ownerID','$timeReleased')";
		
		
			$result2 = mysqli_query($conn,$sql2);
			if ($result2 ){
				echo "<script>alert('successfully upload')</script>";		
				 jump("HomePage.php");
			}else {
			  echo 'Error';
			}
		 break;
		}

  }
 } 	


//ע��
function insertUser(){
    global $conn;
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password =$_POST["pwd"];
    $tel = $_POST["phone"];
    $address = $_POST["address"];
    $balance = 0;
    $sql = "INSERT INTO users ".
        "(name, email,password,tel,address,balance) ".
        "VALUES ".
        "('$name','$email','$password','$tel','$address','$balance')";
    $retval = mysqli_query( $conn, $sql );

    if ($retval){
        creatCookie("username",$name);
        creatCookie("login","1");
        jump("HomePage.php");
    }
}

//ʵ�ֽ�����ת
function jump($url){
	echo '<script language = "javascript">';
	echo 'document.location = "'.$url.'"';
	echo '</script>';
 }


//����Ƿ��ѱ�����
function checkBeBought(){
    global $conn;
    $artworkID = $_GET["artworkID"];
    $sql = "SELECT * FROM artworks";
    $sql .= " WHERE artworkID='$artworkID'";

    $result = mysqli_query($conn,$sql);
    $row = $result->fetch_assoc();
    if (isset($row["orderID"])){
        return 2;
    }
    else
        return 3;
}

//�����ܺ���
function pay(){
	checkChange();
    //$totalPrice = $_GET["totalPrice"];
	$totalPrice=isset($_POST['totalPrice']) ? $_POST['totalPrice'] : '';
	$artworkIDs=isset($_POST['artworkIDs']) ? $_POST['artworkIDs'] : '';
	//$datas = '';
	$tag = '';
    if ($totalPrice== 0){
        $tag = 3;	
    }

    global $conn;
    
	$sql = "SELECT * FROM users";
    $userID = $_COOKIE["userID"];
    $sql .= " WHERE userID='$userID'";
    $result = mysqli_query($conn,$sql);
    $row = $result->fetch_assoc();
    $userBalance = (int)($row["balance"]);
	$aid ='';

    if (checkCarts() == 0){
        $tag = 2;//��Щ��Ʒ��������������
		
    }else if ($userBalance >= $totalPrice){
		for($i=0;$i<count($artworkIDs);$i++){	
			$finalMoney = $userBalance - $totalPrice;
			$sql2 = "UPDATE users ".
			 "SET balance = '$finalMoney'".
				"WHERE userID='$userID'";
			$result1 = mysqli_query($conn,$sql2);
			$aid = $artworkIDs[$i];
			creatOrder($aid);
			setOrderID($userID,$aid);
			checkCarts();
			$tag = 1;
		}
        	
    }else if ($userBalance < $totalPrice){
        $tag = 0;
	}

	echo $tag;
	}

//��鹺�ﳵ�Ƿ����ѱ����µ�����Ʒ�����У���ɾ��
function checkCarts(){
    global $conn;
    $beBought = 1;
    $userID = $_COOKIE["userID"];
    $sql = "SELECT *  FROM carts";
    $sql .= " WHERE userID='$userID'";

    $result = mysqli_query($conn,$sql);
    for ($i = 0;$i<$result ->num_rows;$i++){
        $row = $result ->fetch_assoc();
        $artworkID = $row["artworkID"];
        $sql1 = "SELECT *  FROM artworks";
        $sql1 .= " WHERE artworkID='$artworkID'";

        $result1 = mysqli_query($conn,$sql1);
        $row = $result1->fetch_assoc();

        if (isset($row["orderID"])){
            deleteCart($artworkID);
            $beBought = 0;
        }
    }
    return $beBought;
}

//�����Ϣ�Ƿ�仯
function checkChange(){
	global $conn;
	global $conn;
    $beChange = 1;
    $userID = $_COOKIE["userID"];
    $sql = "SELECT *  FROM carts";
    $sql .= " WHERE userID='$userID'";
    $result = mysqli_query($conn,$sql);
    for ($i = 0;$i<$result ->num_rows;$i++){
        $row = $result ->fetch_assoc();
		$timeReleased1 = $row['time'];
        $artworkID = $row["artworkID"];
        $sql1 = "SELECT *  FROM artworks";
        $sql1 .= " WHERE artworkID='$artworkID'";

        $result1 = mysqli_query($conn,$sql1);
        $row1 = $result1->fetch_assoc();

		if($row1["timeReleased"]!=$row['time']){
			echo "<script>alert('INFORMATION HAS CHANGED!PLEASE F5')</script>";
			break;
		}
	}
}

//�µ�
function setOrderID($orderID,$artworkID){
    global $conn;
    $userID = $_COOKIE["userID"];
    $sql = "SELECT *  FROM carts";
    $sql .= " WHERE userID='$orderID'";

    $result = mysqli_query($conn,$sql);
    for ($i = 0;$i<$result ->num_rows;$i++){
        $row = $result ->fetch_assoc();
        
        payForOwner($artworkID);
        $sql1 = "UPDATE artworks ".
            "SET orderID = '$orderID'".
            "WHERE artworkID='$artworkID'";
        $result1 = mysqli_query($conn,$sql1);
    }
}

//��ӵ���ߴ�Ǯ
function payForOwner($artworkID){
    global $conn;
    $sql = "SELECT *  FROM artworks";
    $sql .= " WHERE artworkID='$artworkID'";
    $result = mysqli_query($conn,$sql);
    $row = $result ->fetch_assoc();

    $ownerID = $row["ownerID"];
    $payMoney = (int)($row["price"]);
    //���ϵõ���Ҫ��Ǯ��id�ͼ�Ǯ������

    $sql1 = "SELECT *  FROM users";
    $sql1 .= " WHERE userID='$ownerID'";
    $result1 = mysqli_query($conn,$sql1);
    $row1 = $result1 ->fetch_assoc();
    $basicMoney = (int)($row1["balance"]);
    //���ϵõ�����Ʒӵ���߱�����Ǯ������

    $nowBalance = $payMoney + $basicMoney;
    $sql2 = "UPDATE users ".
        "SET balance = '$nowBalance'".
        "WHERE userID='$ownerID'";
    $result2 = mysqli_query($conn,$sql2);
}


//����Ʒ���빺�ﳵ
function addCharts( ){
    global $conn;
    $artworkID = $_GET["artworkID"];
    $userID = $_COOKIE["userID"];
    $sql = "SELECT * FROM artworks";
    $sql .= " WHERE artworkID='$artworkID'";
    $result = mysqli_query( $conn, $sql );
	$row= $result ->fetch_assoc();
	$timeReleased = $row["timeReleased"];

	if(!isset($row['orderID'])){
		$sql1 = "SELECT * FROM carts";
		$sql1 .= " WHERE artworkID='$artworkID'";
		$result1 = mysqli_query( $conn, $sql1 );
		if ($result1 ->num_rows != 0){
			$row1 = $result1 ->fetch_assoc();
			if($row1['orderID']==$userID){
				return 0;
			}else{
				$sql2 = "INSERT INTO carts ".
				     "(userID,artworkID,time) ".
					 "VALUES ".
					 "('$userID','$artworkID','$timeReleased')";
				$retval = mysqli_query( $conn, $sql2 );
				return 1;
			}
		}else{
			 $sql3 = "INSERT INTO carts ".
				     "(userID,artworkID,time) ".
					 "VALUES ".
					 "('$userID','$artworkID','$timeReleased')";
			 $retval = mysqli_query( $conn, $sql3 );
			 return 1;
			}
	}
 }  

       
   


//ɾ�����ﳵ�е���Ʒ
function deleteCart($deleteID){
    global $conn;
    $sql = "DELETE FROM carts";
    $sql .= " WHERE artworkID='$deleteID'";
    $result =  mysqli_query( $conn, $sql );
}

function deleteUp($deleteID2){
    global $conn;
    $sql = "DELETE FROM artworks";
    $sql .= " WHERE artworkID='$deleteID2'";
    $result =  mysqli_query( $conn, $sql );
}


function charge(){
    global $conn;
    global $sql;
    $Money = (int)($_GET["money"]);
    $username = $_COOKIE["username"];

    $sql .= " WHERE name='$username'";
    $result = mysqli_query($conn,$sql);
    $row = $result ->fetch_assoc();

    $basicMoney = (int)($row['balance']);
    $finalMoney = $Money + $basicMoney;

    $sql1 = "UPDATE users ".
        "SET balance = '$finalMoney'".
        "WHERE name='$username'";

    $result1 = mysqli_query($conn,$sql1);
    if ($result1){
		echo "<script>alert('successfully charge!')</script>";
        jump("personal1.php");
    }
}

//�������ɣ����ҷ������ɶ�����orderID
function creatOrder($artworkID){
    global $conn;
	$artworkID1 = $artworkID;
    $orderID = $_COOKIE["userID"];
	$sql1 = "SELECT * FROM artworks ";
	$sql1 .= " WHERE artworkID='$artworkID1'";
	
	$result =  mysqli_query( $conn ,$sql1 );
	$row = $result ->fetch_assoc();
	$ownerID = $row["ownerID"];
	$price = $row["price"];
	$currentTime = date('Y-m-d H:i:s');
	
	$odID = $orderID + $artworkID1 + $currentTime;


    $sqll = "INSERT INTO orders ".
        "(artworkID,ownerID,orderID,price,timeCreated,odID) ".
        "VALUES ".
        "('$artworkID1','$ownerID','$orderID','$price','$currentTime','$odID')";
	
    $result2 = mysqli_query($conn,$sqll);
	
	return $odID;
    
    }

?>