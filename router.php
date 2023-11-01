<?php
session_start();
$url=$_SERVER['REQUEST_URI'];
$url=explode('/',$url);
require_once("php/classes/User.php");
require_once("php/db.php");

if($url[2]=="contact"){
    $content=file_get_contents("pages/contact.php");
  } else if ($url[2]=="blog"){
    $content=file_get_contents("pages/blog.html");
  } else if ($url[2]=="register"){
    $content=file_get_contents("pages/register.html");
  } else if ($url[2]=="auth") {
    $content=file_get_contents("pages/login.html");
  } else if ($url[2]=="users") {
    require_once("pages/users/index.html");
  } else if ($url[2]=="addUser") {
    //Вызов статического метода из класса User. Принимаем атрибуты из register.html
    //form по атрибуту name
    echo User::addUser($_POST["name"],$_POST["lastname"],$_POST["email"],$_POST["pass"],);
    // var_dump($mysqli);
  } else if ($url[2]=="authUser") {
    echo User::authUser($_POST["email"],$_POST["pass"],);
  }
  
  
  else {
    $content = file_get_contents("pages/index.php");
  }

  if (!empty($content)) {
    require_once("template.php");
  }
    

?>