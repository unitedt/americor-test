<?php

namespace app\widgets\HistoryList\HistoryListObject;

use app\models\History;
use app\widgets\HistoryList\HistoryListObject;
use yii\web\View;

/**
 * Class Customer
 * @package app\widgets\HistoryList\HistoryListObject
 */
class Customer extends HistoryListObject
{
    /**
     * @param View $view
     * @return string
     */
    public function render(View $view): string
    {
        if ($this->model->event === History::EVENT_CUSTOMER_CHANGE_TYPE) {
            return $view->render('_item_statuses_change', [
                'model' => $this->model,
                'oldValue' => \app\models\Customer::getTypeTextByType($this->model->getDetailOldValue('type')),
                'newValue' => \app\models\Customer::getTypeTextByType($this->model->getDetailNewValue('type'))
            ]);
        }

        if ($this->model->event === History::EVENT_CUSTOMER_CHANGE_QUALITY) {
            return $view->render('_item_statuses_change', [
                'model' => $this->model,
                'oldValue' => \app\models\Customer::getQualityTextByQuality($this->model->getDetailOldValue('quality')),
                'newValue' => \app\models\Customer::getQualityTextByQuality($this->model->getDetailNewValue('quality')),
            ]);
        }
    }
}
