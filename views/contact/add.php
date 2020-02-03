<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Добавить контакт';

$form = ActiveForm::begin();

?>

<h2><?= $this->title ?></h2>

<?= $form->field($model, 'fio')->textInput()->label("Фамилия, имя, отчество") ?>
<?= $form->field($model, 'email')->textInput()->label("Email") ?>
<?= $form->field($model, 'phone')->textInput()->label("Телефон") ?>

<?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>



