<?php 
include("App.php");

$app = new App;


if(isset($_POST['id'])){
$id = $_POST['id'];
$app->deleteEvent($id);
}
