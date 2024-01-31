<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/xml; charset=UTF-8");
 
 
if(file_exists('courses.xml')) {
    $courses = file_get_contents('courses.xml');
    echo $courses;
} else {
    echo "&lt;?xml version=\"1.0\"?>&lt;Error>404 - File not found!&lt;/Error>";
}
?>