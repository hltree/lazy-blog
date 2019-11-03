<?php
// this is sample.

namespace App\Setting;

class Settings
{
    private $settings;

    public function __construct()
    {
        $this->returnSettings();
    }

    public function returnSettings()
    {
        $settings = $this->settings = [
            'db' => [
                'host' => 'localhost',
                'user' => 'root',
                'password' => 'root',
                'port' => 3306,
                'dbname' => 'mysite',
            ]
        ];

        return $settings;
    }
}