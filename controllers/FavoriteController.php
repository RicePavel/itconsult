<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\ar\Contact;

class FavoriteController extends Controller {
    
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['list', 'add', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['list', 'add', 'delete'],
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }
    
    public function actionList() {
        $user = Yii::$app->user->identity;
        $contacts = $user->favoriteContacts;
        return $this->render('list', ['contacts' => $contacts]);
    }
    
    public function actionDelete() {
        $contact_id = Yii::$app->request->post('contact_id');
        $user = Yii::$app->user->identity;
        $contacts = $user->favoriteContacts;
        foreach ($contacts as $key => $contact) {
            if ($contact_id == $contact->contact_id) {
                $user->unlink('favoriteContacts', $contact, true);
            }
        }
        $user->save();
        return $this->redirect(['favorite/list']);
    }
    
    public function actionAdd() {
        $contact_id = Yii::$app->request->post('contact_id');
        $user = Yii::$app->user->identity;
        $contacts = $user->favoriteContacts;
        $contact = Contact::findOne($contact_id);
        if ($contact != null) {
            $user->link('favoriteContacts', $contact);
        }
        $user->save();
        return $this->redirect(['favorite/list']);
    }
    
}

