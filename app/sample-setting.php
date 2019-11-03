<?php
// this is sample.

namespace App\Setting;

class Settings
{
    protected $db;

    public function __construct()
    {
        $this->SetDatabase();
    }

    public function SetDataBase()
    {
        $this->db = [
            'db' => [
                'host' => 'localhost',
                'user' => 'root',
                'password' => 'root',
                'port' => 3306,
                'dbname' => 'mysite',
            ]
        ];

        return $this->db;
    }
}