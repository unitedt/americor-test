<?php

namespace app\widgets\HistoryList\HistoryListObject;

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
        $sms = $this->getObjectModel();

        return $view->render('_item_common', [
            'user' => $this->model->user,
            'body' => $this->getBody(),
            'footer' => $sms->direction === \app\models\Sms::DIRECTION_INCOMING ?
                Yii::t('app', 'Incoming message from {number}', [
                    'number' => $sms->phone_from ?? ''
                ]) : Yii::t('app', 'Sent message to {number}', [
                    'number' => $sms->phone_to ?? ''
                ]),
            'iconIncome' => $sms->direction === \app\models\Sms::DIRECTION_INCOMING,
            'footerDatetime' => $this->model->ins_ts,
            'iconClass' => 'icon-sms bg-dark-blue'
        ]);
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        $sms = $this->getObjectModel();
        return $sms->message ?: '';
    }

    /**
     * @return \app\models\Sms
     */
    protected function getObjectModel(): \app\models\Sms
    {
        return $this->model->sms;
    }

}