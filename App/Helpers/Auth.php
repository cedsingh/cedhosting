<?php
class Auth
{
    static function isAdmin()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['is_admin'] == 1) {
            return true;
        }
        return false;
    }

    static function isCustomer()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['is_admin'] == 0) {
            return true;
        }
        return false;
    }

    static function getUserId()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user']['id'];
        }
        return 0;
    }
}
