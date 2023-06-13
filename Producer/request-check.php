<?php
include "all-requests.php";

echo "<script>
            const requestButton = document.getElementById('request-button');

            setInterval(checkDeviceStatus, 1000);

            function checkDeviceStatus() {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'all-requests.php', true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        var response = xhr.responseText;
                        if (response === '1') {
                            
                            requestButton.classList.add('request-active');
                        } 
                        else {
                        requestButton.classList.remove('request-active');
                        }
                    }
            };
            xhr.send();
            }   
            
            </script>";
?>