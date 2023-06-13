<?php
                $sql = "SELECT name, id FROM room";
                $result = $conn->query($sql);
                $roomNames = array();
                $roomids = array();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $roomNames[] = $row["name"];
                        $roomids[] = $row["id"];
                    }
                }

                $sql = "SELECT room_id, device_name, properties_consumer, id FROM devices";
                $result = $conn->query($sql);

                // Verileri diziye atama
                $propertiesArray = array();
                $namesArray = array();
                $idArray = array();
                $idDeviceArray = array();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $properties = json_decode($row['properties_consumer'], true);
                        $propertiesArray[] = $properties;
                        $namesArray[] = $row["device_name"];
                        $idArray[] = $row["room_id"];
                        $idDeviceArray[] = $row["id"];
                    }
                }
                $roomNumber = count($roomids);
                for ($i = 0; $i < $roomNumber; $i++) {
                    echo "<div class='room-block'>
                    <h2>" . $roomNames[$i] . "</h2>"
                    ;
                    for ($j = 0; $j < count($idArray); $j++) {
                        if ($roomids[$i] == $idArray[$j]) {
                            $properties = $propertiesArray[$j];
                            $name = $namesArray[$j];
                            $idofdevice = $idDeviceArray[$j];
                            echo "
                            <div class='block-info' onclick='toDevice($idofdevice)'>
                            <h4>" . $name . "</h4>
                            <ul>
                            ";
                            foreach ($properties as $key => $value) {
                                echo "<li>" . $key . ": " . $value . "</li>";
                            }
                            echo "</ul>
                            </div>
                            <hr class='line1'>
                            ";
                        }
                    }
                    echo "</div>";
                }
                ?>