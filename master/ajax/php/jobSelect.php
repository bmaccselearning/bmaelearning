<?php
$deparment_code=$_REQUEST["department_code"];
$division_code=$_REQUEST["division_code"];
$section_code=$_REQUEST["section_code"];
$param="department_code=".$deparment_code."&division_code=".$division_code."&section_code=".$section_code;
//$url="divisionXml.php?".$param;
$contextPath='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/jobXml.php?";
$url=$contextPath.$param;

$str="";

$xmlDoc = new DOMDocument;
$xmlDoc->load($url);
$str=$str."<select name='job_code' class='custom-select' ><option value=''></option>";
$x=$xmlDoc->getElementsByTagName('DIVISION_ROW');

for ($i=0; $i<=$x->length-1; $i++) {
   
  //Process only element nodes
  if ($x->item($i)->nodeType==1) {
  
   $str=$str."<option value='".$x->item($i)->childNodes->item(0)->nodeValue."'>".$x->item($i)->childNodes->item(0)->nodeValue.":".$x->item($i)->childNodes->item(1)->nodeValue."</option>";
  }
  
}
$str=$str."</selected>";
echo $str;
