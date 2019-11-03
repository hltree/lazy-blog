<?php
// this is sample.

namespace App\Setting;

class Settings
{
    public $db;

    public function __construct()
    {
        $this->SetDatabase();
    }

    public function SetDataBase()
    {
        $this->db = [
            'db' => [
                'host' => '127.0.0.1',
                'user' => 'root',
                'password' => 'root',
                'port' => '3306',
                'dbname' => 'mysite',
            ]
        ];

        return $this->db;
    }
}