<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\User;
use yii\data\ActiveDataProvider;
use backend\models\{ AddForm , UpdateForm};
use frontend\models\post\Post;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class UsersController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['list', 'add', 'update', 'delete', 'view'],
                'rules' => [
                    [
                        'actions' => ['list', 'add', 'update', 'delete', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function () {
                            return User::isAdmin();
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    
    public function actionList()
    {
        $users = User::find();

        $dataProvider = new ActiveDataProvider([
           'query' => $users,
            'pagination' => [
                'pageSize' => 3,
            ]
        ]);

        return $this->render('list',[
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionAdd()
    {
        $model = new AddForm();
        
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->goBack('backend\web\users\list');
            }
        }

        return $this->render('add', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $user = User::findOne($id);
        $model = new UpdateForm($id);

        if (($model->load(Yii::$app->request->post())) && ($model->save($user))) {
            $this->goBack();
        }

        return $this->render('update', [
            'model' => $model,
            'user' => $user
        ]);
    }

    public function actionDelete($id)
    {
        Post::deleteAll(['user_id' => $id]);
        User::findOne($id)->delete();
        $this->goBack();
    }

    public function actionView($id)
    {
        $posts = Post::find()->where(['user_id' => $id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $posts,
            'pagination' => [
                'pageSize' => 3,
            ]
        ]);

        return $this->render('view',[
            'dataProvider' => $dataProvider
        ]);
    }
    
}
?>
