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
        
    }
}