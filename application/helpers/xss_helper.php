<?php
function xssclean($str) {
    return htmlentities($str, ENT_QUOTES, 'UTF-8');
}
?>