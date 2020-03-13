<?php include 'php_function.inc.php';
		?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>ShoppingCart</title>
    <link rel="stylesheet" type="text/css" href="css\Shoppingcart.css">
    <link rel="stylesheet" type="text/css" href="css\reset.css">
	<script src="cookie.js" type="text/javascript"></script>
	<script src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
</head>
<script>

window.onload = tan();
	function logout(){
		deleteCookie("username");
		deleteCookie("login");
		deleteCookie("userID");
		}
		
	

	//calprice();
	
function buy(){
		
	var price1 = document.getElementById("allprice").innerHTML;
	
	buying(price1);
}

function buying(price1) {
	//var price = document.getElementById("price").innerHTML;
	var artworkIDs = "";
	artworkIDs = calprice();
	var checkResult1 ="";
	//console.log(artworkIDs[0]);
	  $.ajax({
            url:"writer.php",
            type:'POST',
            data: {'artworkIDs':artworkIDs, 'totalPrice':price1},
			//dataType:'JSON',
            success:function(result){    
			checkResult1 = result;
			 
			var a =checkResult1.length-1;
					
			var checkResult=checkResult1.charAt(a );
			console.log(checkResult);
					if (checkResult == 0){
					alert("余额不足");
					}
					if (checkResult == 1){
					alert("购买成功");
					history.go(0);
					}
					if (checkResult == 2){
					alert("信息变动");
					}
		    }, error: function (XMLHttpRequest, textStatus, errorThrown) { 
　　              //$("#p_test").innerHTML = "there is something wrong!";
 　　               alert(XMLHttpRequest.status); 
　　                 alert(XMLHttpRequest.readyState); 
　　                 alert(textStatus);        
 　　		},     
           
       });	 
    }
	

function calprice(){
	var prandid=new Array();
	var artworkID=new Array();
	var price = 0;
	//var arrPara=new Array(); 
	
	var total = document.getElementById("allprice");
	var num =  document.getElementsByName("choose");
		for(var i=0;i<num.length;i++){
			if(num[i].checked == true ){
				 prandid[i]= num[i].value;
				if(prandid[i]!=null){
				 arrPara = prandid[i].split("&");
				
				 artworkID[i]=arrPara[1];
				 price += Number(arrPara[0]);
				
				}
			}
		}
		total.innerHTML=price;
		return artworkID;
}
	

	function del(deleteID){
		let XHR = new XMLHttpRequest();
        XHR.onreadystatechange = function () {
            if (XHR.readyState == 4){
                if ((XHR.status >= 200 && XHR.status < 300) || XHR.status == 304){
                    checkResult = XHR.responseText;
					console.log(checkResult);
					document.getElementById(deleteID).innerHTML = "";
                } else {
                    alert("Request was unsuccessful: " + XHR.status);
                }
            }
        };

         let url1 = addURLParam("writer.php","deleteID",deleteID);
         XHR.open("get",url1,false);
         XHR.send();
			location.replace(location.href);
    }

function addURLParam(url, name, value){
        url += ( url.indexOf("?") == -1 ? "?" : "&" );
        url += encodeURIComponent(name) + "=" + encodeURIComponent(value);
        return url;
}

function tan() {
        if (getCookie("username") === "") {
		alert("please load first")
           window.location.href="load.php" ; 
        }
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
			windows.location.href("load.php");
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


<div class="main">

    <table>
        <tbody>
        <?php showCart() ?>
        </tbody>
    </table>

    
</div>
<div class="pay" onclick="buy()">付款:<strong id="allprice"></strong></div>


</body>
</html>
