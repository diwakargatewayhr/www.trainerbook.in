<?php
session_start();

if (isset($_POST['cityId'])) {
   
    $_SESSION['city_id'] = $_POST['cityId'];
    
    echo "City ID saved in session";
} else {
    echo "City ID not received";
}
