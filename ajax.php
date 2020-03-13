<?php

	//include 'php_function.inc.php'; 
	
	$servername = 'localhost';
	$username = 'root';
	$password = 'lxx0401';
	$database = 'pj2';

	$conn = mysqli_connect($servername, $username, $password,$database);
	

	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	if(isset($_POST['currentPage'])){
		
		getData();
	}
	
	
	$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	


	function getData(){
		//$sql='';

		$totalCount = 5;
		$currentPage=isset($_POST['currentPage']) ? $_POST['currentPage'] : '';
		$sql=isset($_POST['sql']) ? $_POST['sql'] : '';
		global $conn;
		$datas='';
	
		 if ($totalCount != 0){

			$pageSize = 45;
			$totalCount	= 20 ;
			$totalPage = 5 ;
			$mark = ($currentPage-1)*$pageSize;
			
			$sql .= ' limit ' . $mark . ',' . $pageSize ;
			$result = mysqli_query($conn, $sql);
			
			$datas = [				
				'totalCount' => $totalCount,
				'totalPage'=> $totalPage ,];	
			while($row=mysqli_fetch_array($result)){ 
				

				$datas['artworkID'][] = $row['artworkID'];
				
			}  
		 
			
		 }
	
	
	echo json_encode($datas,true);
	}

if (isset($_GET["title"])){
    checkIsSet($_GET["title"]);
}


function checkIsSet($title){
	global $conn;
	$sql = "SELECT * FROM artworks";
	
	$datas='';

	$result = mysqli_query($conn,$sql);
	while($row = $result->fetch_assoc()){
        if ($row["title"] === $title ){
            $datas = [				
				'artist' => $row['artist'],
				'description'=> $row['description'] ,
				'year'=> $row['yearOfWork'] ,
				'genre'=> $row['genre'] ,
				'width'=> $row['width'] ,
				'height'=> $row['height'] ,
				'price'=> $row['price'] ,
				'artworkID'=> $row['artworkID'] ,
			];
            
            break;
        }
    }
    echo json_encode($datas,true);
}

?>