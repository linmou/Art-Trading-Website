<?php include 'php_function.inc.php';
	header("content-type:text/html;charset=utf-8");?>

<!DOCTYPE html>
<html lang="en" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="utf-8">
    <title>details</title>
    <link rel="stylesheet" type="text/css" href="css/personal.css"/>
    <link rel="stylesheet" type="text/css" href="css/reset.css"/>
	<link rel="stylesheet" type="text/css" href="css/StyleSheet1.css" />
</head>
<body>
    <header>
        <h1 id="logo">Art Store</h1>
        <span id="slogan">lalala</span>
        <ul>
            <li>
                <p style="display:inline-block">欢迎 </p>
				<?php echo $_COOKIE["username"];?>
            </li>
            <li>
                <a href="HomePage1.html">登出</a>
            </li>

        </ul>
    </header>

    <div class="nav">
        <ul>
            <li><a href="HomePage.php">首页</a></li>
            <li><a href="search.php">搜索</a></li>
           
        </ul>
        <div class="search">
            <input id="search" form="text" />
            <a href ="search2.html">搜索</a>
        </div>
    </div>
    
    <div class="main">
        <div class="card">
            <table>
                <tr>
                    <td>名称：</td>
                    <td>xiaoqi</td>
                </tr>
                <tr>
                    <td>邮箱：</td>
                    <td>18302010075@fudan.edu.cn</td>
                </tr>
                <tr>
                    <td>电话：</td>
                    <td>18350132375</td>
                </tr>
                <tr>
                    <td>地址：</td>
                    <td></td>
                </tr>
                <tr>
                    <td>余额：</td>
                    <td>$1000000</td>
                </tr>
            </table>
            <a href="topup.html">充值</a>
           
        </div>
        <div style="display:inline;position:absolute;width:750px;right:0px; top:150px;height:650px;">
            <div class="upload">
                <h3>上传的艺术品</h3>
            <p>您未上传艺术品</p></div>
            <div class="buy">
                <h3>购买的艺术品</h3>
                <table class="tabuy">
                    <tr>
                        <th>订单编号</th>
                        <th>商品名称</th>
                        <th>订单时间</th>
                        <th>订单金额</th>
                    </tr>
                    <tr>
                        <td>201904010314</td>
                        <td>Massacre Of The Innocents</td>
                        <td>2019.04.01</td>
                        <td>150000$</td>
                    </tr>
                    <tr>
                        <td>201904010845</td>
                        <td>Irises</td>
                        <td>2019.04.01</td>
                        <td>250000$</td>
                    </tr>
                </table>
            </div>
            <div class="sold">
                <h4>出售的艺术品</h4>
            <p>您未卖出艺术品</p></div>
        </div>


    </div>
</body>
</html>