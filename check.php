<?php include "php_function.inc.php" ?>
<?php
$servername = "localhost";
$username = "root";
$password = "lxx0401";
$database = "pj2";
$conn = mysqli_connect($servername, $username, $password,$database);
$sql = "SELECT * FROM users";

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET["Rname"])){
    checkRegister($_GET["Rname"]);
}





if (isset($_GET["Lname"]) && isset($_GET["pwd"])){
     checkLoad($_GET["Lname"],$_GET["pwd"]);
	 
}

function checkRegister($Rname){
    global $conn;
    global $sql;
    $tag = 1;  //���ݿ���û��������Ϊ1
    $result = mysqli_query($conn,$sql);
    while($row = $result->fetch_assoc()){
        if ($row["name"] === $Rname){
            $tag = 0;  //���ݿ����Ѿ������־�Ϊ0
            break;
        }
    }
    $response=$tag;
    echo $response;
}

function checkLoad($name,$pwd){
    global $conn;
    global $sql;
    $tag = 0;//û�������ݿ��е��˺������Ӧ�Ͼ�Ϊ��
    $result = mysqli_query($conn,$sql);
    while($row = $result->fetch_assoc()){
        if ($row["name"] === $name && $row["password"] === $pwd){
            $tag = 1;//�����ݿ��е��˺������Ӧ�Ͼ�Ϊ1��
            $userID = $row["userID"];
            creatCookie('userID',$userID);
            break;
        }
    }
    $response = $tag;
    echo $tag;
}

function checkIsSet($title){
	global $conn;
	$sql = "SELECT * FROM artworks";
	$tag = 0;
	$result = mysqli_query($conn,$sql);
	while($row = $result->fetch_assoc()){
        if ($row["title"] === $title ){
            $tag = 1;
            
            break;
        }
    }
    $response = $tag;
    echo $tag;
}

?>