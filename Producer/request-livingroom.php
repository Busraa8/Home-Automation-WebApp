<?php

        $sql = "SHOW COLUMNS FROM checkbox_livingroom";
        $result = $conn->query($sql);

        $columns = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $columns[] = $row['Field'];
            }
        }
        
        foreach ($columns as $column) {
            echo '<th>' . $column . '</th>';
        }
        ?>