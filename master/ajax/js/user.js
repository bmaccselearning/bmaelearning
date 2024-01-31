function showUser(department_code,division_code,section_code,job_code) {
    //alert('include')
  
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("deptTable").innerHTML=this.responseText;
    }
  }
  var url='ajax/php/userTable.php?';
  var param='department_code='+department_code+"&division_code="+division_code+"&section_code="+section_code+"&job_code="+job_code;
  xmlhttp.open("GET",url+param,true);
  xmlhttp.send();
  }