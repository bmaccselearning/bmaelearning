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
$contextPath='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/deptXml.php?";
$url=$contextPath.$param;
//$url="deptXml.php?".$param;

$str="";

$xmlDoc = new DOMDocument;
$xmlDoc->load($url);
$str=$str."<table class=\"admintable generaltable table-sm\" id=\"department_table\">";
$str=$str."<thead>
<tr>
<td class=\"header c0\" style=\"\"></td>
<th class=\"header c1\" style=\"\" scope=\"col\">รหัสหน่วยงาน</th>
<th class=\"header c2\" style=\"\" scope=\"col\">ชื่อหน่วยงาน</th>
<th class=\"header c3\" style=\"\" scope=\"col\">รหัสสำนักงานเขต/ส่วนราชการ</th>
<th class=\"header c4\" style=\"\" scope=\"col\">สำนักงานเขต/ส่วนราชการ</th>
<th class=\"header c5\" style=\"\" scope=\"col\">รหัสฝ่ายกลุ่ม</th>
<th class=\"header c6\" style=\"\" scope=\"col\">ฝ่ายกลุ่ม</th>
<th class=\"header c7\" style=\"\" scope=\"col\">รหัสงาน</th>
<th class=\"header c8\" style=\"\" scope=\"col\">งาน</th>
<th class=\"header c9\" style=\"width:10%\" scope=\"col\">action</th>
<td class=\"header c10 lastcol\" style=\"\"></td>
</tr>
</thead><tbody>";
$x=$xmlDoc->getElementsByTagName('DIVISION_ROW');

for ($i=0; $i<=$x->length-1; $i++) {
   
  //Process only element nodes
  if ($x->item($i)->nodeType==1) {
    $str=$str."<tr class=\"lastrow\">
    <td class=\"cell c0\" style=\"\"></td>
    <td class=\"cell c1\" style=\"\">".$x->item($i)->childNodes->item(0)->nodeValue."</td>
    <td class=\"cell c2\" style=\"\"><a href=\"../master/division.php?department_code=".$x->item($i)->childNodes->item(0)->nodeValue."\">".$x->item($i)->childNodes->item(1)->nodeValue."</a></td>
    <td class=\"cell c3\" style=\"\">".$x->item($i)->childNodes->item(2)->nodeValue."</td>
    <td class=\"cell c4\" style=\"\">".$x->item($i)->childNodes->item(3)->nodeValue."</td>
    <td class=\"cell c5\" style=\"\">".$x->item($i)->childNodes->item(4)->nodeValue."</td>
    <td class=\"cell c6\" style=\"\">".$x->item($i)->childNodes->item(5)->nodeValue."</td>
    <td class=\"cell c7\" style=\"\">".$x->item($i)->childNodes->item(6)->nodeValue."</td>
    <td class=\"cell c8\" style=\"\">".$x->item($i)->childNodes->item(7)->nodeValue."</td>
    <td class=\"cell c9 lastcol\" style=\"\"><a href=\"deptDelete.php?delete=50&amp;sesskey=6FYiHTqhj0\"><i class=\"icon fa fa-trash fa-fw \" aria-hidden=\"true\"  ></i></a> <a href=\"EditDept.php?department_code=50\"><i class=\"icon fa fa-cog fa-fw \" aria-hidden=\"true\"  ></i></a></td>
    </tr>";
   //$str=$str."<option value='".$x->item($i)->childNodes->item(0)->nodeValue."'>".$x->item($i)->childNodes->item(0)->nodeValue.":".$x->item($i)->childNodes->item(1)->nodeValue."</option>";
  }
  
}
$str=$str."</tbody></table>";
echo $str;




