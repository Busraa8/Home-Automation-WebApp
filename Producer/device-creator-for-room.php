<?php
            // Veritabanı bağlantısı ve sorgu işlemleri burada gerçekleştirilir
            include 'connection.php';
            $id = $_SESSION['roomid'];
            $sql = "SELECT device_name, id
            FROM devices
            WHERE room_id = '$id' ";
            $result = mysqli_query($conn, $sql);
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = array('id' => $row['id'], 'name' => $row['device_name']); // Her name değerini diziye ekle
            }

            // Fonksiyon: Room resim yolunu oluştur
            function getRoomImage($deviceName)
            {
                return 'images/' . strtolower($deviceName) . '.png';
            }


            // Verileri kullanarak divleri oluşturma
            echo '<div class="user-cards-container">';
            foreach ($data as $item) {
                $id = $item['id'];
                $deviceName = $item['name'];
                echo "<div class='user-device-card' onclick='toDevice($id)'>";
                echo '<img src="' . getRoomImage($deviceName) . '" alt="Room Image">';
                echo '<h2>'. $deviceName . '</h2>';
                echo '<hr>';
                echo '<p>Status: On</p>';
                echo 'Device id: '. $id;
                echo '</div>';
            }
            echo '</div>';
?>