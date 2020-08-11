<?php

function isLoggedIn() {
    if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        return true;
    }
    //header("location:".base_url()."login");
    redirect(base_url().'login', 'refresh');

    return false;
}