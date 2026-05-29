<?php
session_start();

$_SESSION = array();

session_destroy();

echo "<h2> logout successful</h2>";
echo '<a href="login.php"  style=" background: green;
    color: white;
    padding: 10px 15px;
    text-decoration: none;
    cursor: pointer;"> Login again</a>';
?>