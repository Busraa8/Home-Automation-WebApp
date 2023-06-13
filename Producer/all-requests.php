<?php
include 'connection.php';

$response = 0;

$sql = "SELECT * FROM checkbox_bedroom";
$result = $conn->query($sql);

$bedroomColumns = array();

if ($result->num_rows > 0) {
    $row = $result->fetch_array();
}
for ($i = 1; $i < sizeof($row) / 2; $i++) {
    $bedroomColumns[] = $row[$i];
}

$sql = "SELECT * FROM checkbox_entryway";
$result = $conn->query($sql);

$entrywayColumns = array();

if ($result->num_rows > 0) {
    $row = $result->fetch_array();
}
for ($i = 1; $i < sizeof($row) / 2; $i++) {
    $entrywayColumns[] = $row[$i];
}

$sql = "SELECT * FROM checkbox_kitchen";
$result = $conn->query($sql);

$kitchenColumns = array();

if ($result->num_rows > 0) {
    $row = $result->fetch_array();
}
for ($i = 1; $i < sizeof($row) / 2; $i++) {
    $kitchenColumns[] = $row[$i];
}

$sql = "SELECT * FROM checkbox_livingroom";
$result = $conn->query($sql);

$livingroomColumns = array();

if ($result->num_rows > 0) {
    $row = $result->fetch_array();
}
for ($i = 1; $i < sizeof($row) / 2; $i++) {
    $livingroomColumns[] = $row[$i];
}

for ($i = 0; $i < sizeof($livingroomColumns); $i++) {
    if ($livingroomColumns[$i] == 1) {
        $response = 1;
    }
}

for ($i = 0; $i < sizeof($entrywayColumns); $i++) {
    if ($entrywayColumns[$i] == 1) {
        $response = 1;
    }
}
for ($i = 0; $i < sizeof($kitchenColumns); $i++) {
    if ($kitchenColumns[$i] == 1) {
        $response = 1;
    }
}
for ($i = 0; $i < sizeof($bedroomColumns); $i++) {
    if ($bedroomColumns[$i] == 1) {
        $response = 1;
    }
}

echo $response;
?>