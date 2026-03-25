<?php
//if ($_SERVER['HTTP_HOST'] == "127.0.0.1" || $_SERVER['HTTP_HOST'] == "localhost") {
if (in_array($_SERVER['HTTP_HOST'], ["127.0.0.1", "localhost", "::1"])) {
        $host_server  = 'localhost';
        $db_username  = 'root';
        $db_password  = '';
        $db_name      = 'trainer_book';

        /* Site information */
    } else {
        $host_server1 = 'localhost';
        $db_username1 = 'trainlue_admin';
        $db_password1 = '?*3mdj+?&]aD';
        $db_name1     = 'trainlue_dbdata';
        $BASE_URL = 'https://trainerbook.in';
    }

