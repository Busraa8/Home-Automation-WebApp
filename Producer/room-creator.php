<?php
            include 'connection.php';
            $id = $_SESSION['userid'];
            $sql = "SELECT id, name FROM room WHERE user_id ='$id' ;";
            $result = mysqli_query($conn, $sql);
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = array('id' => $row['id'], 'name' => $row['name']); // Her name değerini diziye ekle
            }

            // Fonksiyon: Room resim yolunu oluştur
            function getRoomImage($roomname)
            {
                return 'images/' . strtolower($roomname) . '.png';
            }

            // Verileri kullanarak divleri oluşturma
            echo '<div class="cards-container" id="room-cards">';
            foreach ($data as $item) {
                $id = $item['id'];
                $roomname = $item['name'];
                echo "<div class='card' onclick='toRoom($id)'>";
                echo '<img src="' . getRoomImage($roomname) . '" alt="Room Image">';
                echo '<h2>'. "Room id: " . $id . '</h2>';
                echo '<p>' . $roomname . '</p>';
                echo '</div>';
            }
            echo '</div>';
?>