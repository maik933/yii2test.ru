<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
//use frontend\models\users\Users;

class UsersController extends Controller
{
    public function actionList()
    {
        return $this->render('list');
    }
}
?>
