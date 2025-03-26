<?php

class AccountDeletedController {
    public function index() {
        // Destruir cualquier sesión residual
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        require 'app/views/account_deleted.php';
    }
}