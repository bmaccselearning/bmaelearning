<?php
 
$param="";
//$url="divisionXml.php?".$param;
$contextPath='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/mpCeeXml.php?";
$url=$contextPath.$param;
//$url="mpCeeXml.php?".$param;

$str="";

$xmlDoc = new DOMDocument;
$xmlDoc->load($url);
$str=$str."<table class=\"admintable generaltable table-sm\" id=\"department_table\">";
$str=$str."<thead>
<tr>
<td class=\"header c0\" style=\"\"></td>
<th class=\"header c1\" style=\"\" scope=\"col\">รหัสประเภทระดับ</th>
<th class=\"header c2\" style=\"width:30%\" scope=\"col\">ชื่อเต็มประเภทระดับ</th>
<th class=\"header c3\" style=\"width:30%\" scope=\"col\">ประเภท</th>
<th class=\"header c4\" style=\"width:30%\" scope=\"col\">ระดับ</th>
<th class=\"header c5\" style=\"width:10%\" scope=\"col\">action</th>
<td class=\"header c6\" style=\"\"></td>
</tr>
</thead><tbody>";
$x=$xmlDoc->getElementsByTagName('ROW');

for ($i=0; $i<=$x->length-1; $i++) {
   
  //Process only element nodes
  if ($x->item($i)->nodeType==1) {
    $str=$str."<tr class=\"lastrow\">
    <td class=\"cell c0\" style=\"\"></td>
    <td class=\"cell c2\" style=\"\">".$x->item($i)->childNodes->item(0)->nodeValue."</td>
    <td class=\"cell c3\" style=\"\">".$x->item($i)->childNodes->item(1)->nodeValue."</td>
    <td class=\"cell c4\" style=\"\">".$x->item($i)->childNodes->item(2)->nodeValue."</td>
    <td class=\"cell c5\" style=\"\">".$x->item($i)->childNodes->item(3)->nodeValue."</td>
    <td class=\"cell c6 lastcol\" style=\"\"><a href=\"userDelete.php?delete=50&amp;sesskey=6FYiHTqhj0\"><i class=\"icon fa fa-trash fa-fw \" aria-hidden=\"true\"  ></i></a> <a href=\"user/editAdvance.php?department_code=50\"><i class=\"icon fa fa-cog fa-fw \" aria-hidden=\"true\"  ></i></a></td>
    </tr>";
   //$str=$str."<option value='".$x->item($i)->childNodes->item(0)->nodeValue."'>".$x->item($i)->childNodes->item(0)->nodeValue.":".$x->item($i)->childNodes->item(1)->nodeValue."</option>";
  }
  
}
$str=$str."</tbody></table>";
echo $str;
