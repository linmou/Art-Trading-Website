<?php include 'php_function.inc.php';
 ?>
<?php
$servername = "localhost";
$username = "root";
$password = "lxx0401";
$database = "pj2";
// 创建连接
$conn = mysqli_connect($servername, $username, $password,$database);
// 检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());}
	
?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>search result</title>
    <link rel="stylesheet" type="text/css" href="css\search.css">
    <link rel="stylesheet" type="text/css" href="css\reset.css">
	
	<script src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>

	
</head>
<style>
	ul li{
		display:inline;
	}

	.page{
		display:block;
	}
</style>
<script>

var curPage = 1; //当前页码
var total,pageSize,totalPage; //总记录数，每页显示数，总页数
	getData(1);

	function logout(){
		deleteCookie("username");
		deleteCookie("login");
		deleteCookie("userID");
		
	}

function getUrlVal(para){
    var search=location.search; //页面URL的查询部分字符串
    var arrPara=new Array(); //参数数组。数组单项为包含参数名和参数值的字符串，如“para=value”
    var arrVal=new Array(); //参数值数组。用于存储查找到的参数值

    if(search!=""){
        var index=0;
        search=search.substr(1); //去除开头的“?”
        arrPara=search.split("&");

        for(i in arrPara){
            var paraPre=para+"="; //参数前缀。即参数名+“=”，如“para=”
            if(arrPara[i].indexOf(paraPre)==0&& paraPre.length<arrPara[i].length){
                arrVal[index]=decodeURI(arrPara[i].substr(paraPre.length)); //顺带URI解码避免出现乱码
                index++;
            }
        }
    }

    if(arrVal.length==1){
        return arrVal[0];
    }else if(arrVal.length==0){
        return null;
    }else{
        return arrVal;
    }
}



 function getData(page){
					
	var sql = 'select * from artworks where orderID is null ';
	
	var keyWords = getUrlVal("keyWords");
	var sort = getUrlVal("sort");
	var content = getUrlVal("searchContent");
		
	if(content != null){
		if(keyWords.length<4){
			if(content!= null&&keyWords!=null){
				sql += "AND "+keyWords[0]+" LIKE '%"+ content +"%'";
				for(i = 1 ; i< keyWords.length;i++){
				sql += " or "+keyWords[i]+" LIKE '%"+ content+"%'";
				} 
			}
		}else {
		sql += "AND "+keyWords+" LIKE '%"+ content +"%'";
		}
	}
	
	sql += ' ORDER BY '+sort+' DESC';

	if(page>0){
        $.ajax({
            url:"ajax.php",
            type:'POST',
            data: {'currentPage':page, 'sql':sql},
			dataType:'JSON',
            success:function(result){               
               total = result.totalPage;
			   artworks = result.artworkID;
			   string = "";

			   if(page>0&&page<=total){
					if(artworks.length == 0){
						string+="none";
						}else{
							for(i=0;i<artworks.length;i++){
			   	   				href = "details.php?artworkID=" + artworks[i];
								href1 = '"' + href + '"';
								string +='<li style=" float: left; padding: 0px;position: relative;overflow: hidden;list-style-type: none;"> ';
								string +='<a href='+href1+'>';
								string +='<img src=".//resources//img//'+ artworks[i]+ '.jpg"  style=" height:130px; width:130px;">';
								string +='</a>';				  
								string +='</li>';
							 }
						}
				}
			   if(page==total+1){string += "已是最后页"}

			   $(".showarea").html(string);
			                
            },
           
        });

		curPage = page;
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
<div class="head">
	
    <p style="display:inline-block;margin-left:7em;margin-top:2em;">搜索结果：</p>
</div>

<div class="main" style="margin:1em 5em;height:730px;position:relative">
    <list class="showarea" id="showarea">
     
    </list>
</div>

    <div>
        <ul class="page" style="text-align:center;">
            <li class="page_li">
                <button class="page_btn" style="width:70px" onclick="getData(curPage-1)">上一页</button>
            </li>
            <li class="page_li" >
                <button class="page_btn" onclick="getData(1)">1</button>
            </li>
            <li class="page_li">
                <button class="page_btn" onclick="getData(2)">2</button>
            </li>
            <li class="page_li">
                <button class="page_btn" onclick="getData(3)">3</button>
            </li>
            <li class="page_li">
                <button class="page_btn" onclick="getData(4)">4</button>
            </li>
            <li class="page_li">
                <button class="page_btn">5</button>
            </li>
            <li class="page_li">
                <button class="page_btn">6</button>
            </li>
            <li class="page_li">
                <button class="page_btn">7</button>
            </li>
            <li class="page_li">
                <button class="page_btn" style="width:70px" onclick="getData(curPage+1)">下一页</button>
            </li>
        </ul>
	</div>


</body>
</html>


	   
	