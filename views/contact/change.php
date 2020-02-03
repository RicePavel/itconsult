<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Изменить контакт';

$form = ActiveForm::begin();

?>

<h2><?= $this->title ?></h2>

<?php if ($model != null) { ?>

    <?= $form->field($model, 'fio')->textInput()->label("Фамилия, имя, отчество") ?>
    <?= $form->field($model, 'email')->textInput()->label("Email") ?>
    <?= $form->field($model, 'phone')->textInput()->label("Телефон") ?>
    <?= Html::submitButton('Изменить', ['class' => 'btn btn-primary']) ?>

<?php } else { ?>
    <h3>Контакт с таким id не найден</h3>
<?php } ?>

<?php ActiveForm::end(); ?>

