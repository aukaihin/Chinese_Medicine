<meta charset="UTF-8">
<?php
$myfile = fopen("chinese_medicine.txt", "r") or die("Unable to open file!");
echo fread($myfile,filesize("chinese_medicine.txt"));
fclose($myfile);
?>