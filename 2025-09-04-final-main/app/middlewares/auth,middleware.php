<?php

function authMiddleware($req) {
    session_start();
    if (isset($_SESSION['IS_LOGGED'])) {
        $req->user = new stdClass();
        $req->user->id = $_SESSION['USER_ID'];
        $req->user->email = $_SESSION['USER_EMAIL'];       
        $req->user->role = $_SESSION['USER_ROLE'];
    }
}
