<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\ar\Contact;


$header = 'Избранное';

$this->title = 'Избранное';

?>

<h2><?= $header ?></h2>

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
            <?php $form = ActiveForm::begin(['action' => ['favorite/delete']]) ?>
                <input type="hidden" name="contact_id" value="<?= $contact->contact_id ?>" />
                <input type="hidden" name="source_page" value="favorite_list" />
                <input type="submit" value="Убрать из избранного" />
            <?php ActiveForm::end(); ?>
        </td>
    </tr>
    <?php } ?>
</table>


