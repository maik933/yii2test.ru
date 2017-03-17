<?php

namespace console\models;

use common\models\User;

class Load
{
    public $url;
    public $file;
    
    public function __construct($url)
    {
        $this->url  = $url;
        $this->file = fopen($this->url, "r");
    }

    public function __destruct()
    {
        fclose($this->file);
    }

    public function loadUsers()
    {
        while (!feof( $this->file)) {
            $buffer = fgets( $this->file);
            $data = explode('/', $buffer);

            $user = new User();
            $user->setArgs(self::getArgsUsers($data));
            $user->setPassword($data[3]);
            $user->generateAuthKey();
            $user->save();
        }
    }

    public static function getArgsUsers(array $data) : array
    {
        return [
            'username' => $data[0],
            'email' => $data[1],
            'role' => $data[2],
        ];
    }
}
