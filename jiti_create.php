<?php
// var_dump($_POST);
// exit();

$name = $_POST["name"];
$han = $_POST["han"];
$kessan = $_POST["kessan"];
$keikaku = $_POST["keikaku"];
$yosan = $_POST["yosan"];
$kaichou = $_POST["kaichou"];
$komarigoto1 = $_POST["komarigoto1"];
$komarigoto2 = $_POST["komarigoto2"];
$komarigoto3 = $_POST["komarigoto3"];
$komarigoto4 = $_POST["komarigoto4"];
$komarigoto5 = $_POST["komarigoto5"];

$write_data = "{$name},{$han},{$kessan},{$keikaku},{$yosan},{$kaichou},{$komarigoto1},{$komarigoto2},{$komarigoto3},{$komarigoto4},{$komarigoto5}\n";
$file = fopen("data/sokai.csv", "a");
flock($file, LOCK_EX);
fwrite($file, $write_data);
flock($file, LOCK_UN);
fclose($file);

header("Location:jiti_input.php");
