<?php
// this is sample.

namespace App\Setting;

class Settings
{
    public $db;
    public $user;

    public function __construct()
    {
        $this->SetDatabase();
        $this->SetUser();
    }

    public function SetDataBase()
    {
        $this->db = [
            'host' => '127.0.0.1',
            'user' => 'root',
            'password' => 'root',
            'port' => '3306',
            'dbname' => 'mysite'
        ];

        return $this->db;
    }

    public function SetUser()
    {
        $this->user = [
            'username' => 'username',
            'password' => 'password'
        ];

        return $this->user;
    }
}