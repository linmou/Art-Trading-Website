<?php include 'php_function.inc.php'; 
		
header("content-type:text/html;charset=gb2312");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312"/>
    <title>upAndChange</title>
    <link rel="stylesheet" type="text/css" href="css\reset.css">
	 
	<link href="bootstrap-3.0.0/dist/css/bootstrap.css" rel="stylesheet">
	<script src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
    <script src="cookie.js" type="text/javascript"></script>
</head>
<style>
a { text-decoration: none;
    color:white;
}
* { margin: 0; padding: 0;}
ul { list-style: none;}

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

body {
    background-color: beige;
    min-width: 1280px;
    min-height:850px;
}

    img{
        width: 30%;
        height: 30%;
    }

    ul{
        padding: 0.5em 0em;
        margin: 0em;
        list-style-type: none;
        background: darkgrey;
    }
    li{
        display: inline;
        color: white;
        padding: 0em 1em;
    }
    a{
        text-decoration: none;
        color: white;
        padding: 0.5em;
    }
    li a:hover{
        background-color:wheat;
    }
    .artFond{
        font-style: italic;
        font-family:"Times New Roman", Times, serif;
    }
    li img{
        height: 16px;
        width: 16px;
    }
    #head{
        text-align: right;
        color: white;
        font-size: 80%;
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
    input{
        width: 250px;
        padding-left: 10px;
        height: 30px;
        color: #333;
        font-size: 14px;
        margin-bottom: 10px;
    }
    .tip{
        color: red;
        font-size: 70%;
    }
    form{
        width: 1000px;
        overflow: hidden;
        margin: 50px auto;
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
        <li>
            <a href="HomePage.php">首页</a>
        </li>
        
        <li>
            <a href="search2.php">搜索</a>
        </li>
		
		<li style="color:white">
                <a href="personal1.php" style="display:inline-block">欢迎
				<?php echo $_COOKIE["username"];?>
				</a>
        </li>
        <li>
                <a href="HomePage.php" onclick="logout()">登出</a>
        </li>
    </ul>
	<div class="path">
	
	</div>
</header>


<section>
    <form action="writer.php" method="post" class="form" onsubmit="return checkAll(this)" role="form">
        <fieldset>
            <legend>UPLOAD ARTWORK</legend>
            <div class="form-group">
                <label for="title">Artwork Title:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="艺术品的名称" onblur="checkTitle()">
                <label class="tip" id="title1"></label><br />
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" class="form-control" id="author" name="author" placeholder="作者的名称" onblur="checkAuthor()">
                <label class="tip" id="author1"></label><br />
            </div>  
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" class= "form-control" rows="3" name="description" placeholder="作品简介" onblur="checkDescription()"></textarea>
                <label class="tip" id="description1"></label><br />
            </div>
            <div class="form-group">
                <label for="genre">Genre:</label>
                <input type="text" class="form-control" id="genre" placeholder="流派" name="genre" onblur="checkGenre()">
                <label class="tip" id="genre1"></label><br />
            </div>
            <div class="form-group">
                <label for="size">Size:</label>
                <input type="text" class="form-control" id="width" placeholder="宽" name="width" onblur="checkWidth()">
                <label class="tip" id="width1"></label><br />
                <input type="text" class="form-control" id="height" placeholder="高" name="height" onblur="checkHeight()">
            <label class="tip" id="height1"></label><br />
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="price" placeholder="价格" name="price" onblur="checkPrice()">
                <label class="tip" id="price1"></label><br />
            </div>
            <div class="form-group">
                <label for="year">Year Of Work: </label>
                <input type="text" class="form-control" id="year" placeholder="年代" name="year" onblur="checkYear()">
                <label class="tip" id="year1"></label><br />
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" name="pic" accept="image/*" onchange="preview(this)">
            </div>
            <div id="preview"></div>
            <div>
                <button type="submit" class="submit" name="submit">Submit</button>
                <button type="reset" class="submit" name="reset" onclick="del()">Clear</button>
            </div>
        </fieldset>
    </form>
</section>

</body>
<script>

window.onload = tan();
	
function tan(){
        if (getCookie("username") === "") {
            document.getElementById('light').style.display = 'block';
            document.getElementById('fade').style.display = 'block';
        }else {isSetTitle();}
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

function isSetTitle(){
	
		var title1 = getUrlVal("title");
		var title = unescape(title1,"UTF-8");
		console.log(title);
		if(title!=null){
		
			document.getElementById("title").value = title;
			checkTitle();
		}
}


	
  function checkDescription() {
       let description = document.getElementById("description");
       if (description.value === ""){
           document.getElementById("description1").innerHTML = "*此处不能为空";
           light = 0;
           return false;
       }
       else{
           document.getElementById("description1").innerHTML = "";
		   return true;
       }
   }
    function checkAuthor() {
        let author = document.getElementById("author");
        if (author.value === ""){
            document.getElementById("author1").innerHTML = "*此处不能为空";
            light = 0;
            return false;
        }
        else{
            document.getElementById("author1").innerHTML = "";
			return true;
        }
    }
    function checkTitle() {
		change();
        let title = document.getElementById("title");
        if (title.value === ""){
            document.getElementById("title1").innerHTML = "*此处不能为空";
            light = 0;
            return false;
        }
        else{
            document.getElementById("title1").innerHTML = "";
			return true;
        }
    }
    function checkGenre() {
        let genre = document.getElementById("genre");
        if (genre.value === ""){
            document.getElementById("genre1").innerHTML = "*此处不能为空";
            light = 0;
            return false;
        }
        else{
            document.getElementById("genre1").innerHTML = "";
			return true;
        }

    }
    function checkYear() {
        let title = document.getElementById("year");
        if (title.value === ""){
            document.getElementById("year1").innerHTML = "*此处不能为空";
            light = 0;
            return false;
        }
        else{
            let type="^[0-9]*[1-9][0-9]*$";
            let re = new RegExp(type);
            if(title.value.match(re)==null) {
                document.getElementById("year1").innerHTML = "*请输入正整数";
                light = 0;
                return false;
            }else{
				return true;
			}
        }
        document.getElementById("year1").innerHTML = "";
    }
    function checkPrice() {
        let title = document.getElementById("price");
        if (title.value === ""){
            document.getElementById("price1").innerHTML = "*此处不能为空";
            light = 0;
            return false;
        }
        else{
            let type="^[0-9]*[1-9][0-9]*$";
            let re = new RegExp(type);
            if(title.value.match(re)==null) {
                document.getElementById("price1").innerHTML = "*请输入正整数";
                light = 0;
                return false;
            }else{
				return true;
			}
            document.getElementById("price1").innerHTML = "";
        }
    }
    function checkWidth() {
        let title = document.getElementById("width");
        if (title.value === ""){
            document.getElementById("width1").innerHTML = "*此处不能为空";
            light = 0;
            return false
        }
        else{
            let width = Number(title.value);
            if (width < 0){
                document.getElementById("width1").innerHTML = "*请输入正数";
                light = 0;
                return false;
            }else{
				return true;
			}
            document.getElementById("width1").innerHTML = "";
        }

    }
    function checkHeight() {
        let title = document.getElementById("height");
        if (title.value === ""){
            document.getElementById("height1").innerHTML = "*此处不能为空";
            light = 0;
            return false
        }
        else{
            let height = Number(title.value);
            if (height < 0){
                document.getElementById("height1").innerHTML = "*请输入正数";
                light = 0;
                return false
            }else{
				return true;
			}
            document.getElementById("height1").innerHTML = "";
        }
    }


    //检查输入的函数
    function checkAll() {
		if(checkAuthor()==true && checkDescription()==true &&checkGenre()==true && checkHeight() ==true && checkPrice() ==true && checkTitle()==true &&checkWidth()==true&&checkYear()==true){
			return true;
			alert("修改成功");
		}
        
        else {
            return false
        }
    }

    function preview(file) {
        var prevDiv = document.getElementById('preview');
        if (file.files && file.files[0]) {
            var reader = new FileReader();
            reader.onload = function (evt) {
                prevDiv.innerHTML = '<img src="' + evt.target.result + '" />';
            }
            reader.readAsDataURL(file.files[0]);
        } else {
            prevDiv.innerHTML = '<div class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + file.value + '\'"></div>';
        }
    }

	function del(){
		var prevDiv = document.getElementById('preview');
		prevDiv.innerHTML = "";
	}

	function logout(){
		deleteCookie("username");
		deleteCookie("login");
		deleteCookie("userID");
		
	}

	function change(){
		var title = document.getElementById("title").value;
		console.log(title);
		  $.ajax({
            url:"ajax.php",
            type:'GET',
            data: {'title':title},
			dataType:'JSON',
            success:function(result){               
               
			   
			   strng = "";
			   artworkID = "";

			   document.getElementById("author").value = result.artist;
			   document.getElementById("description").value =result.description;
			   document.getElementById("year").value = result.year;
			   document.getElementById("genre").value = result.genre;
			   document.getElementById("width").value = result.width;
			   document.getElementById("height").value = result.height;
			   document.getElementById("price").value =result.price;
			   artworkID = result.artworkID;

			  

			   var prevDiv = document.getElementById('preview');
			   prevDiv.innerHTML = '<img style=" height:130px; width:130px;" src=\'./resources/img/' + artworkID + '.jpg\'>';            
			    
			
            },error: function(XMLHttpRequest, textStatus, errorThrown) {
				 alert(XMLHttpRequest.status);
				alert(XMLHttpRequest.readyState);
				 alert(textStatus);
			},
           
        });
        
	}

</script>
</html>