<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\User;

$this->title = 'Обновить пользователя';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-update']); ?>
            
            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'value' => $user->username]) ?>

            <?= $form->field($model, 'email')->textInput(['value' => $user->email]) ?>

            <?= $form->field($model, 'password')->passwordInput(['value' => '']) ?>

            <?= $form->field($model, 'role')->dropDownList(User::ROLE_NAME, [
                'options' =>[ $user->role => ['Selected' => true]]])?>

            <div class="form-group">
                <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'add-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
