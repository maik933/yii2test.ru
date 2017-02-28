<?php
use yii\helpers\Html;
use yii\grid\GridView;
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?= Html::a('Добавить пользователя','add',['class' => 'btn btn-primary']) ?>
</div>

