<?php

namespace app\jobs;

use Yii;
use yii\base\BaseObject;

class EmailJob extends BaseObject implements \yii\queue\JobInterface
{
    public $to;
    public $from;
    public $subject;
    public $body;
    
    public function execute($queue)
    {
        Yii::$app->mailer->compose()
            ->setTo($this->to)
            ->setFrom($this->from)
            ->setSubject($this->subject)
            ->setHtmlBody($this->body)
            ->send();
    }
}