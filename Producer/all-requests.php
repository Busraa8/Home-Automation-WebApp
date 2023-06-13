<?php
include 'connection.php';

$response = false;

$sql = "SELECT properties, properties_consumer, id FROM devices";
$result = $conn->query($sql);
$realProps = array();
$consumerProps = array();
$deviceIds = array();
$differents = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $properties = json_decode($row['properties'], true);
        $propertiesConsumer = json_decode($row['properties_consumer'], true);
        $ids = $row["id"];

        // properties dizisine ekleme
        if ($properties) {
            $realProps[] = $properties;
        }

        // properties_customer dizisine ekleme
        if ($propertiesConsumer) {
            $consumerProps[] = $propertiesConsumer;
        }

        if ($ids) {
            $deviceIds[] = $ids;
        }
    }
}

if ($realProps == $consumerProps)
    $response = true;

if (!$response) {
    for ($i = 0; $i < count($realProps); $i++) {
        if ($realProps[$i] != $consumerProps[$i])
            $differents[] = $deviceIds[$i];
    }
}

for ($i = 0; $i < count($differents); $i++) {
    $script = "
    <script>
        var element = document.getElementById('$differents[$i]-device');
        element.style.backgroundColor = 'rgb(163, 57, 57)';
        element.style.color = '#eaf2fe';
        element.addEventListener('mouseover', function() {
            
            element.style.backgroundColor = 'black';
        });
        
        element.addEventListener('mouseout', function() {
         
            element.style.backgroundColor = 'rgb(163, 57, 57)';
        });
    </script>";
    echo $script;
}
echo $response;

?>