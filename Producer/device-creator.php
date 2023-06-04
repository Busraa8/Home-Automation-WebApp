<?php
            // Veritabanı bağlantısı ve sorgu işlemleri burada gerçekleştirilir
            include 'connection.php';
            $id = $_SESSION['userid'];
            $sql = "SELECT r.name, d.device_name, d.id
            FROM user_table u
            JOIN room r ON u.id = r.user_id
            JOIN devices d ON r.id = d.room_id
            WHERE u.id = '$id' ";
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
            echo '<div class="cards-container">';
            foreach ($data as $item) {
                $id = $item['id'];
                $deviceName = $item['name'];
                echo "<div class='device-card' onclick='toDevice($id)'>";
                echo '<img src="' . getRoomImage($deviceName) . '" alt="Room Image">';
                echo '<h2>'. "Device id: " . $id . '</h2>';
                echo '<p>' . $deviceName . '</p>';
                echo '</div>';
            }
            echo '</div>';
?>

