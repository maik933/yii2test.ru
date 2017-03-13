<?php
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
?>

<h2>Список пользователей</h2>
<div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email',
            [
                'attribute'=>'role',
                'value' => function($data) {
                    return User::ROLE_NAME[$data->role];
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?= Html::a('Добавить пользователя','add',['class' => 'btn btn-primary']) ?>
</div>

