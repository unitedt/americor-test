<?php

namespace app\widgets\HistoryList\HistoryListObject;

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
        $call = $this->getObjectModel();
        $answered = $call && $call->status === \app\models\Call::STATUS_ANSWERED;

        return $view->render('_item_common', [
            'user' => $this->model->user,
            'content' => $call->comment ?? '',
            'body' => $this->getBody(),
            'footerDatetime' => $this->model->ins_ts,
            'footer' => isset($call->applicant) ? "Called <span>{$call->applicant->name}</span>" : null,
            'iconClass' => $answered ? 'md-phone bg-green' : 'md-phone-missed bg-red',
            'iconIncome' => $answered && $call->direction === \app\models\Call::DIRECTION_INCOMING
        ]);
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        $call = $this->getObjectModel();
        return ($call ? $call->totalStatusText . ($call->getTotalDisposition(false) ? " <span class='text-grey'>" . $call->getTotalDisposition(false) . "</span>" : "") : '<i>Deleted</i> ');
    }

    /**
     * @return \app\models\Call
     */
    protected function getObjectModel(): \app\models\Call
    {
        return $this->model->call;
    }
}