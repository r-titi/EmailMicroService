<?php

namespace app\controllers;

use app\jobs\EmailJob;
use app\models\Status;
use Yii;
use yii\rest\Controller;

class SiteController extends Controller
{    
    protected function verbs()
    {
    }

    public function actionSendEmail()
    {
        $request = Yii::$app->request;
        $key = $request->get('key');
        $value = $request->get('value');
        $to = $request->post('to');
        $from = $request->post('from');
        $subject = $request->post('subject');
        $body = $request->post('body');
        
        Yii::$app->queue->push(new EmailJob([
            'to' => $to,
            'from' => $from,
            'subject' => $subject,
            'body' => $body
        ]));

        return [
            'status' => Status::STATUS_OK,
            'message' => 'send email',
        ];
    }
}