function showdivision(select) {
   
    var str=select.value;
  if (str=="") {
    document.getElementById("division_id").innerHTML="";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("division_id").innerHTML=this.responseText;
      document.getElementById("section_id").innerHTML="<select name='section_code' class='custom-select'><option value=''></option></select> ";
      document.getElementById("job_id").innerHTML="<select name='job_code' class='custom-select'><option value=''></option></select>";
    }
  }
  var url='ajax/php/divisionSelect.php?';
  var param='department_code='+str;
  xmlhttp.open("GET",url+param,true);
  xmlhttp.send();
}

function showSection(department_code,division_code) {
    //alert('include')
 
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("section_id").innerHTML=this.responseText;
      document.getElementById("job_id").innerHTML="<select name='job_code' class='custom-select'><option value=''></option></select>";
    }
  }
  var url='ajax/php/sectionSelect.php?';
  var param='department_code='+department_code+"&division_code="+division_code;
  xmlhttp.open("GET",url+param,true);
  xmlhttp.send();
}

function showJob(department_code,division_code,section_code) {
    //alert('include')
 
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("job_id").innerHTML=this.responseText;
    }
  }
  var url='ajax/php/jobSelect.php?';
  var param='department_code='+department_code+"&division_code="+division_code+"&section_code="+section_code;
  xmlhttp.open("GET",url+param,true);
  xmlhttp.send();
}


function showDept(department_code,division_code,section_code,job_code) {
 // alert('include'+department_code+">"+division_code+">"+section_code+">"+job_code);

var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function() {
  if (this.readyState==4 && this.status==200) {
    document.getElementById("deptTable").innerHTML=this.responseText;
  }
}
var url='ajax/php/deptTable.php?';
var param='department_code='+department_code+"&division_code="+division_code+"&section_code="+section_code+"&job_code="+job_code;
xmlhttp.open("GET",url+param,true);
xmlhttp.send();
}

function showWorkLine() {
  //alert('include')
 
var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function() {
  if (this.readyState==4 && this.status==200) {
    document.getElementById("mainTable").innerHTML=this.responseText;
   }
}
var url='ajax/php/workLineTable.php?';
var param='';
xmlhttp.open("GET",url+param,true);
xmlhttp.send();
}
function showMpCee() {
  //alert('include')
 
var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function() {
  if (this.readyState==4 && this.status==200) {
    document.getElementById("mainTable").innerHTML=this.responseText;
   }
}
var url='ajax/php/MpCeeTable.php?';
var param='';
xmlhttp.open("GET",url+param,true);
xmlhttp.send();
}
function showAdminCode() {
 //alert('include')
 
var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function() {
  if (this.readyState==4 && this.status==200) {
    document.getElementById("mainTable").innerHTML=this.responseText;
   }
}
var url='ajax/php/adminTable.php?';
var param='';
xmlhttp.open("GET",url+param,true);
xmlhttp.send();
}



function addNewRow2(department_code,department_name,division_code,division_name,section_code,section_name,job_code,job_name) {
  alert('aaa:'+counter)
  table.row
      .add([
        department_code,
        department_name,
        division_code,
        division_name,
        section_code,
        section_name,
        job_code,
        job_name
      ])
      .draw();

  counter++;
}
function addNewRow() {
  alert('counter:'+counter)
  table.row
  .add([
          counter + '.1',
          counter + '.2',
          counter + '.3',
          counter + '.4',
          counter + '.5'
      ])
      .draw(false);

  counter++;
  alert('counter:'+counter)
}

const table = new DataTable('#example');
let counter = 1;
 