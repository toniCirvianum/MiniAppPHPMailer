<?php

namespace App\Models;

class User
{
    public function getByUsername($username)
    {
        foreach ($_SESSION['users'] as $user) {
            if ($user['username'] === $username) {
                return $user;
            }
        }
        return null;
    }

    public function validateCredentials($username, $password)
    {
        $user = $this->getByUsername($username);
        if ($user !== null && password_verify($password, $user['password'])) {
            return $user;
        }
        return null;
    }

    public function validateCredentialsOld($username, $password)
    {
        foreach ($_SESSION['users'] as $user) {
            if (
                $user['username'] == $username &&
                password_verify($password, $user['password'])
            ) {
                return $user;
            }
        }
        return null;
    }

    public function getNewIdUser()
    {
        $maxId = 0;

        foreach ($_SESSION['users'] as $product) {
            if ($product['id'] > $maxId) {
                $maxId = $product['id'];
            }
        }

        return $maxId + 1;
    }

    private function getUserId($username) {
        foreach ($_SESSION['users'] as $user) {
            if($user['username']=='username')
                return $user['id'];
        }   
        return false;
    }

    public function getRole(){
        return $_SESSION['user_logged']['role'];
    }

    public function setUSerSession($username) {
        $user = $this->getByUsername($username);
        unset($user['password']);
        $_SESSION['user_logged']=$user;        
    }

    public function getUSerSession() {
        if (isset($_SESSION['user_logged'])) {
            return $_SESSION['user_logged'];
        }
        return null;
    }

    public function destroyUserSession() {
        unset($_SESSION['user_logged']);
    }
}
