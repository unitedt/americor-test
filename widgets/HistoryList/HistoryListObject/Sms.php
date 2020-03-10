<?php

namespace app\widgets\HistoryList\HistoryListObject;

use app\widgets\HistoryList\helpers\HistoryListHelper;
use app\widgets\HistoryList\HistoryListObject;
use yii\web\View;
use Yii;

/**
 * Class Sms
 * @package app\widgets\HistoryList\HistoryListObject
 */
class Sms extends HistoryListObject
{
    /**
     * @param View $view
     * @return string
     */
    public function render(View $view): string
    {
        return $view->render('_item_common', [
            'user' => $this->model->user,
            'body' => HistoryListHelper::getBodyByModel($this->model),
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