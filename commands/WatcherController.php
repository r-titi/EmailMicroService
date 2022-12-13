<?php
namespace app\commands;

use app\jobs\EmailJob;
use app\models\Constants;
use Yii;
use yii\console\Controller;
use yii\mongodb\Query;

class WatcherController extends Controller
{
    public function actionChangePostStatus()
    {
        $eventCollection = Yii::$app->mongodb->getCollection('change_post_status_send_email');
        $query = new Query();
        $query->select(['_id', 'micro', 'event', 'key', 'value'])
            ->from('change_post_status_send_email')
            ->where(['status' => Constants::STATUS_PENDING]);
            
        $rows = $query->all();
        foreach($rows as $row) {
            Yii::$app->queue->push(new EmailJob([
                'to' => Yii::$app->params['to_email'],
                'from' => Yii::$app->params['from_email'],
                'subject' => "change post status",
                'body' => "change post status" .$row['key'] . $row['value']
            ]));
            
            $eventCollection->update(['_id' => $row['_id']],['status' => Constants::STATUS_COMPLETED]);
        }
    }
}