<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="DC.Title" content="<?php print $content_data['db']['Meta_Title'];?>" />
<meta name="description" content="<?php print $content_data['db']['Meta_Description'];?>" />
<meta name="keywords" content="<?php print $content_data['db']['Meta_Keywords'];?>" />
<link rel='shortcut icon' type='image/x-icon' href='<?php print $app_data['asset-sever']; ?>bcms/templates/toho9000/favicon.ico' />
<link href="<?php print $app_data['asset-sever']; ?>bcms/templates/toho9000/style.css" rel="stylesheet" type="text/css" />
<META name="verify-v1" content="o0xWjUe0Pw3ZPJa46VdOUHkEhl8z2te5aFp2nK5VEWU=" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
body {
	background-image: url(<?php print $app_data['asset-sever']; ?>bcms/templates/toho9000/Pics/bg.gif);
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
a:link {
	color: #5273A5;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #5273A5;
}
a:hover {
	text-decoration: none;
	color: #000000;
}
a:active {
	text-decoration: none;
	color: #5273A5;
}
.style2 {
	font-size: 24px;
	font-weight: bold;
}
.style4 {color: #000000}
.style5 {	font-size: 24px;
	font-weight: bold;
	color: #000000;
}
.tableborder {	border: 1px solid #666666;
}
.style6 {color: #FFFFFF}
-->
</style>
</head>

<body>
<center>
<table width="749" border="0" cellpadding="0" cellspacing="0" class="main_border">
  <!--DWLayoutTable-->
  <tr>
    <td height="18" colspan="2" valign="top"><img src="<?php print $app_data['asset-sever']; ?>bcms/templates/toho9000/Pics/toho9000layout2_02.gif" width="662" height="18" align="right"></td>
    <td width="86" background="<?php print $app_data['asset-sever']; ?>bcms/templates/toho9000/Pics/link_background_top.gif" class="top-links"><span class="main_menu"><a href="index.html">Home</a> | <a href="site-map.html">Sitemap</a></span> </td>
    </tr>
  <tr>
    <td height="139" colspan="2" valign="top"><img src="<?php print $app_data['asset-sever']; ?>bcms/templates/toho9000/Pics/toho9000layout2_05.gif" width="662" height="139" align="right"></td>
    <td valign="top"><img src="<?php print $app_data['asset-sever']; ?>bcms/templates/toho9000/Pics/toho9000layout2_06.gif" width="86" height="139"></td>
    </tr>
  <tr><td><?php include($app_data['MODULEBASEDIR']."menu/horizontal.php");?></td></tr>
  <tr>
    <td  colspan="3" valign="top">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <!--DWLayoutTable-->
          <tr>
            <td width="748" valign="top" bgcolor="#FFFFFF" class="content">
            <?php include($app_data['MODULEBASEDIR']."content/display.php");?>
            </td>
          </tr>
          <tr>
            <td height="70" valign="top"><img src="<?php print $app_data['asset-sever']; ?>bcms/templates/toho9000/Pics/toho9000layout2_10.gif" width="748" height="70"></td>
          </tr>
          <tr>
            <td background="https://assets.creaiveweblogic.net/bcms/templates/toho9000/Pics/bottom_bg.gif"  class="content">
                <a href="https://creativeweblogic.net">Website Design Development Programming Promotion Hosting</a>
                 | 
                <a href="http://bubblecms.biz">iCWLNet - Bubble CMS - Website Builder</a>
            </td>
          </tr>
        </table>
    </td>
</tr>
  
</table>
</center>
<?php print $domain_data['db']['Analytics']?></body>
</html>
