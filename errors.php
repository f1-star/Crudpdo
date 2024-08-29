<?php
function error_session($type) {
    if (isset($_SESSION['errors']) && sizeof($_SESSION['errors']) > 0) {
        if(key_exists($type, $_SESSION['errors'])) {
            return $_SESSION['errors'][$type];
        }
    } 
}
