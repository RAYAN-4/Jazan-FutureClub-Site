<?php

function is_user_logged_in_web() {
    if (isset($_SESSION['id'])) {
        return true;
    }
    return false;
}



function getTitle() {
    global $pageTitle;
    if (isset($pageTitle)) {
        echo $pageTitle;
    } else {
        echo "Default";
    }
}