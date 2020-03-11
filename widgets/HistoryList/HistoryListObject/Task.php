<?php

namespace app\widgets\HistoryList\HistoryListObject;

use app\widgets\HistoryList\helpers\HistoryListHelper;
use app\widgets\HistoryList\HistoryListObject;
use yii\web\View;

/**
 * Class Task
 * @package app\widgets\HistoryList\HistoryListObject
 */
class Task extends HistoryListObject
{
    /**
     * @param View $view
     * @return string
     */
    public function render(View $view): string
    {
        $task = $this->model->task;

        return $view->render('_item_common', [
            'user' => $this->model->user,
            'body' => $this->getBody(),
            'iconClass' => 'fa-check-square bg-yellow',
            'footerDatetime' => $this->model->ins_ts,
            'footer' => isset($task->customerCreditor->name) ? "Creditor: " . $task->customerCreditor->name : ''
        ]);
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        $task = $this->getObjectModel();
        return $this->model->eventText . ': ' . ($task->title ?? '');
    }

    /**
     * @return \app\models\Task
     */
    protected function getObjectModel(): \app\models\Task
    {
        return $this->model->task;
    }

}