<?php
session_start();
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 

header('Location: /DST_Admin_Dashboard');
?>