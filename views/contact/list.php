<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\ar\Contact;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$header = 'Контакты';

$this->title = 'Контакты';

?>

<h2><?= $header ?></h2>

<?= Html::a('Добавить контакт', ['contact/add'], ['class' => 'btn btn-primary']) ?>

<br/>
<div></div>
<br/>

<table class="table">
    <?php foreach ($contacts as $contact) { ?>
    <tr>
        <td><?= Html::encode($contact->fio) ?></td>
        <td><?= Html::encode($contact->phone) ?></td>
        <td><?= Html::encode($contact->email) ?></td>
        <td>
            <?php $form = ActiveForm::begin(['action' => ['contact/change'], 'method' => 'get']) ?>
                <input type="hidden" name="contact_id" value="<?= $contact->contact_id ?>" />
                <input type="submit" value="Изменить" />
            <?php ActiveForm::end(); ?>
        </td>
        <td>
            <?php $deleteForm = ActiveForm::begin(['action' => ['contact/delete']]) ?>
                <input type="hidden" name="contact_id" value="<?= $contact->contact_id ?>" />
                <input type="submit" value="Удалить" onclick="return confirm('Подтвердите удаление')" />
            <?php ActiveForm::end(); ?>
        </td>
        <td>
            <?php if (in_array($contact->contact_id, $favoriteContactsIds)) { ?>
                <?php $form = ActiveForm::begin(['action' => ['favorite/delete']]) ?>
                    <input type="hidden" name="contact_id" value="<?= $contact->contact_id ?>" />
                    <input type="hidden" name="source_page" value="contact_list" />
                    <input type="submit" value="Убрать из избранного" />
                <?php ActiveForm::end(); ?>
            <?php } else { ?>
                <?php $form = ActiveForm::begin(['action' => ['favorite/add']]) ?>
                    <input type="hidden" name="contact_id" value="<?= $contact->contact_id ?>" />
                    <input type="hidden" name="source_page" value="contact_list" />
                    <input type="submit" value="Добавить в избранное" />
                <?php ActiveForm::end(); ?>
            <?php } ?>
        </td>
    </tr>
    <?php } ?>
</table>

