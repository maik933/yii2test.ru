<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>

<h2>Список постов</h2>
<div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'tableOptions' => [
            'class' => 'table table-striped table-bordered table-css'
        ],

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'title',
                'contentOptions' =>['class' => 'td-text', 'style' => 'width: 40%;'],
                'format' => 'html',
                'value' => function($data) {
                    return '<span>' . $data->title . '</span>';
                },
            ],
            [
                'attribute'=>'body',
                'contentOptions' =>['class' => 'td-text', 'style' => 'width: 40%;'],
                'format' => 'html',
                'value' => function($data) {
                    return '<span>' . $data->body . '</span>';
                },
            ]
        ],
    ]); ?>
</div>

