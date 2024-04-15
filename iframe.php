<?php

$link = ''; //change it
$textButtonDownload = 'ดาวน์โหลด'; //change it


?>
<html>
<head>
<style>
 .download {
    max-width: 160px;
    line-height: 37px;
    color: #FFF;
    text-align: center;
    display: block;
    margin-left: auto;
    margin-right: auto;
    background: #027826;
    font-size: 20px;
    font-weight: bold;
    padding: 0 25px;
    border-radius: 10px;
    text-decoration: none;

}
	
</style>
</head>

<body>
  <a class="download" href="<?php echo $link; ?>" id="Download"><?php  echo $textButtonDownload; ?></a>

</body>

</html>
