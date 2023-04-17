<?php
// Check if the cookie contains valid user information
if (isset($_COOKIE['user'])) {
    $role = $_COOKIE['user'];
    switch ($role) {
        case 'admin':
            echo "admin";
            break;
        case 'normal':
            echo "normal";
            break;
        default:
            echo "login";
            break;
    }
}
