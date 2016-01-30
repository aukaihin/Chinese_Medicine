<meta charset="UTF-8">
<?php
include "config.php";
function startsWith($haystack, $needle)
{
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}
function checkHotness($medicine_property)
{
    $hotness = -99;
    $pos = strpos($medicine_property,"缺");
  	if ($pos !== false){
  		$hotness = 10;
  	}
   
  	$pos = strpos($medicine_property,"寒");
  	if ($pos !== false){
  		$hotness = -5;
  	}
  	
  	$pos = strpos($medicine_property,"冷");
  	if ($pos !== false){
  		$hotness = -3;
  	}
  	$pos = strpos($medicine_property,"凉");
  	if ($pos !== false){
  		$hotness = -2;
  	}
    $pos = strpos($medicine_property,"平");
  	if ($pos !== false){
  		$hotness = 0;
  	}
  	//大热、热、大温、温、微温、平、凉、微寒、大寒
  	
  	$pos = strpos($medicine_property,"温");
  	if ($pos !== false){
  		$hotness = 2;
  	}
  	$pos = strpos($medicine_property,"暖");
  	if ($pos !== false){
  		$hotness = 3;
  	}
  	
  	$pos = strpos($medicine_property,"热");
  	if ($pos !== false){
  		$hotness = 5;
  	}
  	 $pos = strpos($medicine_property,"大寒");
  	if ($pos !== false){
  		$hotness = -6;
  	}
  	$pos = strpos($medicine_property,"微凉");
  	if ($pos !== false){
  		$hotness = -1;
  	}
  	$pos = strpos($medicine_property,"微寒");
  	if ($pos !== false){
  		$hotness = -4;
  	}
  	$pos = strpos($medicine_property,"微温");
  	if ($pos !== false){
  		$hotness = 1;
  	}
  	$pos = strpos($medicine_property,"大温");
  	if ($pos !== false){
  		$hotness = 4;
  	}
  	$pos = strpos($medicine_property,"大热");
  	if($pos !== false){
  		$hotness = 6;
  	}
    return $hotness;
}
$i=0;
$file = fopen("chinese_medicine.txt", "r") or die("Unable to open file!");
while(!feof($file)){
  	$line = trim(fgets($file));
  	//echo $line;
	if (substr($line, 0, 8)=="<篇名>"){
		$hotness = checkHotness($medicine_property);
  		//if (($display)){
		if (($display)&&($hotness == -5)){
			$i++;
			echo $i.".";
			echo $medicine_name."<br>";
			if ($medicine_part !=""){
				echo $medicine_part."<br>";
			}
			echo $medicine_property."<br>";
			echo $hotness."<br>";
			echo $medicine_cure."<br>";
			echo "<br>";
  		}
		$medicine_name = trim(substr($line, 8, strlen($line)-8));
		$medicine_part = "";
		$current_is_property = FALSE;
		$current_is_cure = FALSE;
		$display = FALSE;
		$hotness == 0;
		
  	}
  	if (substr($line, 0, 2)=="\x"){
  		$hotness = checkHotness($medicine_property);
  		//if (($display)){
		if (($display)&&($hotness == -5)){
			$i++;
			echo $i.".";
  			echo $medicine_name."<br>";
			if ($medicine_part !=""){
				echo $medicine_part."<br>";
			}
			echo $medicine_property."<br>";
			echo $hotness."<br>";
			echo $medicine_cure."<br>";
			echo "<br>";
  		}
  		
		$medicine_part = substr($line, 2, strlen($line));
		$pos_part = strpos($medicine_part,"\x");
		$medicine_part = substr($medicine_part, 0,$pos_part);
		$display = FALSE;
		$hotness == 0;
		
  	}
  	if (substr($line, 0, 3)=="【"){
  		$current_is_property = FALSE;
		$current_is_cure = FALSE;
  	}
  	/*if ($current_is_property){
  		$medicine_property = $medicine_property.$line;
  	}*/
  	if ($current_is_cure){
  		$medicine_cure = $medicine_cure.$line;
  	}
  	if (substr($line, 0, 12)=="【气味】"){
		$medicine_property = substr($line, 12, strlen($line)-12);
		$pos = strpos($medicine_property,"。");
		$medicine_property = substr($medicine_property, 0, $pos+3);
		$current_is_property = TRUE;
  	}
  	
  	if (substr($line, 0, 12)=="【发明】"){
		$current_is_cure = FALSE;
		$display = TRUE;
  	}
  	
  	if (substr($line, 0, 12)=="【主治】"){
		$medicine_cure = substr($line, 12, strlen($line)-12);
		$current_is_property = FALSE;
		$current_is_cure = TRUE;
  	}
  	
  	
  	
  	
}

/*echo $medicine_part."<br>";
echo $medicine_property."<br>";
echo $medicine_cure."<br>";*/
fclose($file);
?>