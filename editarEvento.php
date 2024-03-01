<?php 
include("App.php");

$app = new App;

$id = $_POST['id'];
$eventTitle = $_POST['eventTitle'];
$eventDescription = $_POST['eventDescription'];
$eventDateTime = $_POST['eventDateTime'];
$eventDuration = $_POST['eventDuration'];

if($_FILES['event-photo']['error'] > 0){
    $fileName = null;
}
else{   
    $fileName = $_FILES['eventPhoto'];
}

if (isset($_POST['id'],$_POST['eventTitle'], $_POST['eventDescription'], $_POST['eventDateTime'], $_POST['eventDuration'])) {
    echo $app->updateEventInfo($id, $eventTitle, $eventDescription, $eventDateTime, $eventDuration, $fileName);
}
