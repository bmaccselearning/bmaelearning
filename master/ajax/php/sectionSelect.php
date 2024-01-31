<?php
$deparment_code="";
if(!empty($_REQUEST["department_code"])){
  $deparment_code=$_REQUEST["department_code"];
}
$division_code="";
if(!empty($_REQUEST["division_code"])){
$division_code=$_REQUEST["division_code"];
}
$param="department_code=".$deparment_code."&division_code=".$division_code;
//$url="divisionXml.php?".$param;
$contextPath='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/sectionXml.php?";
$url=$contextPath.$param;
//$url="sectionXml.php?".$param;
//echo $url;
$str="";

$xmlDoc = new DOMDocument;
$xmlDoc->load($url);
$str=$str."<select name='section_code' class='custom-select' onclick='showJob(document.getElementById(\"form1\").department_code.value,document.getElementById(\"form1\").division_code.value,document.getElementById(\"form1\").section_code.value)'><option value=''></option>";
$x=$xmlDoc->getElementsByTagName('DIVISION_ROW');

for ($i=0; $i<=$x->length-1; $i++) {
   
  //Process only element nodes
  if ($x->item($i)->nodeType==1) {
  
   $str=$str."<option value='".$x->item($i)->childNodes->item(0)->nodeValue."'>".$x->item($i)->childNodes->item(0)->nodeValue.":".$x->item($i)->childNodes->item(1)->nodeValue."</option>";
  }
  
}
$str=$str."</selected>";
echo $str;
