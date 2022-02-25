<?php
    session_start();
    session_destroy();
    echo "<script>setTimeout(()=>{location = 'http://localhost/xml/'}, 10)</script>";
?>