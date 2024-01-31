<?php

$department_code="";
$division_code="";
$section_code="";
$job_code="";

if(isset($_REQUEST["department_code"])){
$department_code=$_REQUEST["department_code"];
}
if(isset($_REQUEST["division_code"])){
$division_code=$_REQUEST["division_code"];
}
if(isset($_REQUEST["section_code"])){
$section_code=$_REQUEST["section_code"];
}
if(isset($_REQUEST["job_code"])){
$job_code=$_REQUEST["job_code"];
}

$param="department_code=".$department_code."&division_code=".$division_code."&section_code=".$section_code."&job_code=".$job_code;
//$url="divisionXml.php?".$param;
$contextPath='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/userXml.php?";
$url=$contextPath.$param;
//$url="userXml.php?".$param;

$str="";

$xmlDoc = new DOMDocument;
$xmlDoc->load($url);
$str=$str."<table class=\"admintable generaltable table-sm\" id=\"department_table\">";
$str=$str."<thead>
<tr>
<td class=\"header c0\" style=\"\"></td>
<th class=\"header c1\" style=\"\" scope=\"col\">USERNAME</th>
<th class=\"header c2\" style=\"\" scope=\"col\">ชื่อ นามสกุล</th>
<th class=\"header c3\" style=\"\" scope=\"col\">ตำแหน่งทางสายงาน</th>
<th class=\"header c3\" style=\"\" scope=\"col\">ประเภทระดับ</th>
<th class=\"header c3\" style=\"\" scope=\"col\">ตำแหน่งทางการบริหาร</th>
<th class=\"header c4\" style=\"\" scope=\"col\">ชื่อหน่วยงาน</th>
<th class=\"header c5\" style=\"\" scope=\"col\">สำนักงานเขต/ส่วนราชการ</th>
<th class=\"header c6\" style=\"\" scope=\"col\">ฝ่ายกลุ่ม</th>
<th class=\"header c7\" style=\"\" scope=\"col\">งาน</th>
<th class=\"header c8\" style=\"width:10%\" scope=\"col\">action</th>
<td class=\"header c9\" style=\"\"></td>
</tr>
</thead><tbody>";
$x=$xmlDoc->getElementsByTagName('USER_ROW');

for ($i=0; $i<=$x->length-1; $i++) {
   
  //Process only element nodes
  if ($x->item($i)->nodeType==1) {
    $str=$str."<tr class=\"lastrow\">
    <td class=\"cell c0\" style=\"\"></td>
    <td class=\"cell c1\" style=\"\">".$x->item($i)->childNodes->item(0)->nodeValue."</td>
    <td class=\"cell c2\" style=\"width:15%\">".$x->item($i)->childNodes->item(1)->nodeValue." ".$x->item($i)->childNodes->item(2)->nodeValue."</td>
    <td class=\"cell c3\" style=\"\">".$x->item($i)->childNodes->item(3)->nodeValue."</td>
    <td class=\"cell c3\" style=\"\">".$x->item($i)->childNodes->item(13)->nodeValue."</td>
    <td class=\"cell c3\" style=\"\">".$x->item($i)->childNodes->item(12)->nodeValue."</td>
    <td class=\"cell c4\" style=\"width:15%\">".$x->item($i)->childNodes->item(4)->nodeValue.":".$x->item($i)->childNodes->item(5)->nodeValue."</td>
    <td class=\"cell c5\" style=\"width:15%\">".$x->item($i)->childNodes->item(6)->nodeValue.":".$x->item($i)->childNodes->item(7)->nodeValue."</td>
    <td class=\"cell c6\" style=\"\">".$x->item($i)->childNodes->item(8)->nodeValue.":".$x->item($i)->childNodes->item(9)->nodeValue."</td>
    <td class=\"cell c7\" style=\"\">".$x->item($i)->childNodes->item(10)->nodeValue.":".$x->item($i)->childNodes->item(11)->nodeValue."</td>
 
    <td class=\"cell c8 lastcol\" style=\"\"><a href=\"userDelete.php?delete=50&amp;sesskey=6FYiHTqhj0\"><i class=\"icon fa fa-trash fa-fw \" aria-hidden=\"true\"  ></i></a> <a href=\"/user/profile.php?id=".$x->item($i)->childNodes->item(14)->nodeValue."\"><i class=\"icon fa fa-cog fa-fw \" aria-hidden=\"true\"  ></i></a></td>
    </tr>";
   //$str=$str."<option value='".$x->item($i)->childNodes->item(0)->nodeValue."'>".$x->item($i)->childNodes->item(0)->nodeValue.":".$x->item($i)->childNodes->item(1)->nodeValue."</option>";
  }
  
}
$str=$str."</tbody></table>";
echo $str;




