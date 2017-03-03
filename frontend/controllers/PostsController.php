<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\User;
use yii\data\ActiveDataProvider;
use frontend\models\post\{ AddForm, Post, UpdateForm};

class PostsController extends Controller
{
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $posts = Post::find()->where(['user_id' => Yii::$app->user->getId()]);

        $dataProvider = new ActiveDataProvider([
            'query' => $posts,
            'pagination' => [
                'pageSize' => 3,
            ]
        ]);

        return $this->render('index',[
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionAdd()
    {
        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $model = new AddForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save(Yii::$app->user->getId())) {
                return $this->goHome();
            }
        }

        return $this->render('add', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $post = Post::findOne($id);
        $model = new UpdateForm();

        if (($model->load(Yii::$app->request->post())) && ($model->save($post))) {
            $this->goBack();
        }

        return $this->render('update', [
            'model' => $model,
            'post' => $post
        ]);
    }

    public function actionDelete($id)
    {
        Post::findOne($id)->delete();
        $this->goBack();
    }
}
?>
