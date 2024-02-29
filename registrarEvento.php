<?php 
include("App.php");

$app = new App;

$eventTitle = $_POST['eventTitle'];
$eventDescription = $_POST['eventDescription'];
$eventDateTime = $_POST['eventDateTime'];
$eventDuration = $_POST['eventDuration'];
$fileName = $_FILES['eventPhoto'];

if (isset($_POST['eventTitle'], $_POST['eventDescription'], $_POST['eventDateTime'], $_POST['eventDuration'])) {

    echo $app->uploadEventInfo( $eventTitle, $eventDescription, $eventDateTime, $eventDuration, $fileName);
}
