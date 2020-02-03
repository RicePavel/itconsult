<?php

namespace app\controllers;

use Yii;
use app\models\ar\User;
use app\models\ar\Contact;
use yii\web\Controller;
use yii\filters\AccessControl;

class ContactController extends Controller {
    
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['list', 'change', 'add', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['list', 'change', 'add', 'delete'],
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }
    
    public function actionList() {
        $contacts = Contact::find()->all();
        $user = Yii::$app->user->identity;
        $favoriteContacts = $user->favoriteContacts;
        $favoriteContactsIds = [];
        foreach ($favoriteContacts as $contact) {
            $favoriteContactsIds[] = $contact->contact_id;
        }
        return $this->render('list', ['contacts' => $contacts, 'favoriteContactsIds' => $favoriteContactsIds]);
    }
    
    public function actionChange($contact_id) {
        $model = Contact::findOne($contact_id);
        if ($model != null && $model->load(Yii::$app->request->post())) {
            $ok = $model->save();
            if ($ok) {
                return $this->redirect(['contact/list']);
            }
        }
        return $this->render('change', ['model' => $model]); 
    }
    
    public function actionAdd() {
        $model = new Contact();
        if ($model->load(Yii::$app->request->post())) {
            $ok = $model->save();
            if ($ok) {
                return $this->redirect(['contact/list']);
            }
        }
        return $this->render('add', ['model' => $model]);
    }
    
    public function actionDelete() {
        $contact_id = Yii::$app->request->post('contact_id');
        $model = Contact::findOne($contact_id);
        if ($model != null) {
            $model->delete();
        }
        return $this->redirect(['contact/list']);
    }
    
}