<?php

namespace app\widgets\HistoryList\HistoryListObject;

use app\widgets\HistoryList\HistoryListObject;
use yii\web\View;
use Yii;

class Sms extends HistoryListObject
{
    public function render(View $view)
    {
        return $view->render('_item_common', [
            'user' => $this->model->user,
            'body' => $this->model->sms->message ?? '',
            'footer' => $this->model->sms->direction === \app\models\Sms::DIRECTION_INCOMING ?
                Yii::t('app', 'Incoming message from {number}', [
                    'number' => $this->model->sms->phone_from ?? ''
                ]) : Yii::t('app', 'Sent message to {number}', [
                    'number' => $this->model->sms->phone_to ?? ''
                ]),
            'iconIncome' => $this->model->sms->direction === \app\models\Sms::DIRECTION_INCOMING,
            'footerDatetime' => $this->model->ins_ts,
            'iconClass' => 'icon-sms bg-dark-blue'
        ]);
    }
}