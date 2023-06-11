<?php

        $sql = "SELECT * FROM checkbox_livingroom";
        $result = $conn->query($sql);

        $columns = array();

        if ($result->num_rows > 0) {
            $row = $result->fetch_array() ;
        }
        for ($i=0; $i < sizeof($row)/2; $i++) { 
            $columns[] = $row[$i];
        }
        foreach ($columns as $column) {
            echo '<th>' . $column . '</th>';
        }
        ?>