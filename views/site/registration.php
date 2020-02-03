<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';

$form = ActiveForm::begin([]);

?>

<h2><?= $this->title ?></h2>

<?= $form->field($model, 'login')->textInput()->label('Логин'); ?>
<?= $form->field($model, 'password')->passwordInput()->label('Пароль'); ?>

<?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>

