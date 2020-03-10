<?php

namespace app\widgets\HistoryList\HistoryListObject;

use app\widgets\HistoryList\helpers\HistoryListHelper;
use app\widgets\HistoryList\HistoryListObject;
use yii\web\View;

/**
 * Class Call
 * @package app\widgets\HistoryList\HistoryListObject
 */
class Call extends HistoryListObject
{
    /**
     * @param View $view
     * @return string
     */
    public function render(View $view): string
    {
        $call = $this->model->call;
        $answered = $call && $call->status === \app\models\Call::STATUS_ANSWERED;

        return $view->render('_item_common', [
            'user' => $this->model->user,
            'content' => $call->comment ?? '',
            'body' => HistoryListHelper::getBodyByModel($this->model),
            'footerDatetime' => $this->model->ins_ts,
            'footer' => isset($call->applicant) ? "Called <span>{$call->applicant->name}</span>" : null,
            'iconClass' => $answered ? 'md-phone bg-green' : 'md-phone-missed bg-red',
            'iconIncome' => $answered && $call->direction === \app\models\Call::DIRECTION_INCOMING
        ]);
    }
}