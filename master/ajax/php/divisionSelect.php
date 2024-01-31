<?php

// require_once(__DIR__ . '/../../../config.php');
// require_once($CFG->dirroot . '/my/lib.php');
//define('ABSPATH', dirname(__FILE__));
$deparment_code="";
if(!empty($_REQUEST["department_code"])){
$deparment_code=$_REQUEST["department_code"];
}

$param="department_code=".$deparment_code;
// print_r( $_SERVER ) ;
//$contextPath=  "divisionXml.php?";
//$contextPath= "http://localhost/moodle/master/ajax/php/divisionXml.php?";
$contextPath='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/divisionXml.php?";
//echo "url:".$contextPath."</br>";
$url=$contextPath.$param;

$str="";

$xmlDoc = new DOMDocument;
$xmlDoc->load($url);
$str=$str."<select name='division_code' class='custom-select' onclick='showSection(document.getElementById(\"form1\").department_code.value,document.getElementById(\"form1\").division_code.value)'><option value=''></option>";
$x=$xmlDoc->getElementsByTagName('DIVISION_ROW');

for ($i=0; $i<=$x->length-1; $i++) {
   
  //Process only element nodes
  if ($x->item($i)->nodeType==1) {
  
   $str=$str."<option value='".$x->item($i)->childNodes->item(0)->nodeValue."'>".$x->item($i)->childNodes->item(0)->nodeValue.":".$x->item($i)->childNodes->item(1)->nodeValue."</option>";
  }
  
}
$str=$str."</selected>";
echo $str;
