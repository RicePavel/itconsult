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
    <tr <?= (in_array($contact->contact_id, $favoriteContactsIds)) ? 'class="bg-success"' : '' ?> >
        <td><?= Html::encode($contact->fio) ?></td>
        <td><?= Html::encode($contact->phone) ?></td>
        <td><?= Html::encode($contact->email) ?></td>
        <td>
            <?php $form = ActiveForm::begin(['action' => ['contact/change'], 'method' => 'get']) ?>
                <input type="hidden" name="contact_id" value="<?= $contact->contact_id ?>" />
                <!-- <input type="submit" value="Изменить" /> -->
                <button type="submit" class="btn btn-default" title="Изменить" >
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </button>
            <?php ActiveForm::end(); ?>
        </td>
        <td>
            <?php $deleteForm = ActiveForm::begin(['action' => ['contact/delete']]) ?>
                <input type="hidden" name="contact_id" value="<?= $contact->contact_id ?>" />
                <!-- <input type="submit" value="Удалить" onclick="return confirm('Подтвердите удаление')" /> -->
                <button type="submit" class="btn btn-default" title="Удалить" onclick="return confirm('Подтвердите удаление')" >
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            <?php ActiveForm::end(); ?>
        </td>
        <td>
            <?php if (in_array($contact->contact_id, $favoriteContactsIds)) { ?>
                <?php $form = ActiveForm::begin(['action' => ['favorite/delete']]) ?>
                    <input type="hidden" name="contact_id" value="<?= $contact->contact_id ?>" />
                    <input type="hidden" name="source_page" value="contact_list" />                   
                    <button type="submit" class="btn btn-default" title="Убрать из избранного" >
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    </button>
                <?php ActiveForm::end(); ?>
            <?php } else { ?>
                <?php $form = ActiveForm::begin(['action' => ['favorite/add']]) ?>
                    <input type="hidden" name="contact_id" value="<?= $contact->contact_id ?>" />
                    <input type="hidden" name="source_page" value="contact_list" />                    
                    <button type="submit" class="btn btn-default" title="Добавить в избранное" >
                        <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
                    </button>
                <?php ActiveForm::end(); ?>
            <?php } ?>
        </td>
    </tr>
    <?php } ?>
</table>

