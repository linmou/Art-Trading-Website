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
                <p style="display:inline-block">��ӭ </p>
				<?php echo $_COOKIE["username"];?>
            </li>
            <li>
                <a href="HomePage1.html">�ǳ�</a>
            </li>

        </ul>
    </header>

    <div class="nav">
        <ul>
            <li><a href="HomePage.php">��ҳ</a></li>
            <li><a href="search.php">����</a></li>
           
        </ul>
        <div class="search">
            <input id="search" form="text" />
            <a href ="search2.html">����</a>
        </div>
    </div>
    
    <div class="main">
        <div class="card">
            <table>
                <tr>
                    <td>���ƣ�</td>
                    <td>xiaoqi</td>
                </tr>
                <tr>
                    <td>���䣺</td>
                    <td>18302010075@fudan.edu.cn</td>
                </tr>
                <tr>
                    <td>�绰��</td>
                    <td>18350132375</td>
                </tr>
                <tr>
                    <td>��ַ��</td>
                    <td></td>
                </tr>
                <tr>
                    <td>��</td>
                    <td>$1000000</td>
                </tr>
            </table>
            <a href="topup.html">��ֵ</a>
           
        </div>
        <div style="display:inline;position:absolute;width:750px;right:0px; top:150px;height:650px;">
            <div class="upload">
                <h3>�ϴ�������Ʒ</h3>
            <p>��δ�ϴ�����Ʒ</p></div>
            <div class="buy">
                <h3>���������Ʒ</h3>
                <table class="tabuy">
                    <tr>
                        <th>�������</th>
                        <th>��Ʒ����</th>
                        <th>����ʱ��</th>
                        <th>�������</th>
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
                <h4>���۵�����Ʒ</h4>
            <p>��δ��������Ʒ</p></div>
        </div>


    </div>
</body>
</html>