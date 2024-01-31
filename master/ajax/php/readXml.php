<?php
$q=$_GET["q"];

//$param="department_code=".$q;
$param="";
//$url="GenXmlResponse.php?".$param;


$url="aa.xml.php";
$url="ajax/php/divisionXml.php";


$xmlDoc = new DOMDocument;
$xmlDoc->load($url);

$x=$xmlDoc->getElementsByTagName('DIVISION_ROW');

for ($i=0; $i<=$x->length-1; $i++) {
  //Process only element nodes
  if ($x->item($i)->nodeType==1) {
    // if ($x->item($i)->childNodes->item(0)->nodeValue == $q) {
    //   $y=($x->item($i)->parentNode);
    // }
    echo "</br>division_code:".$x->item($i)->childNodes->item(0)->nodeValue;
    echo "</br>division_name:".$x->item($i)->childNodes->item(1)->nodeValue;
  }
  //echo "node:".$x->item($i)->nodeType;
}
//echo "end";

/*
$cd=($y->childNodes);

for ($i=0;$i<$cd->length;$i++) {
  //Process only element nodes
  if ($cd->item($i)->nodeType==1) {
    echo("<b>" . $cd->item($i)->nodeName . ":</b> ");
    echo($cd->item($i)->childNodes->item(0)->nodeValue);
    echo("<br>");
  }
}
*/