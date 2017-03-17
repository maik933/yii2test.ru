<?php
namespace console\controllers;

use yii\console\Controller;
use console\models\Load;

class UsersController extends Controller
{
    public function actionLoad()
    {
        $load = new Load('console/config/users.txt');
        $load->loadUsers();
    }
}