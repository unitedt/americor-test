<?php

namespace app\widgets\HistoryList\HistoryListObject;

use app\widgets\HistoryList\HistoryListObject;
use yii\web\View;
use Yii;

/**
 * Class Fax
 * @package app\widgets\HistoryList\HistoryListObject
 */
class Fax extends HistoryListObject
{
    /**
     * @param View $view
     * @return string
     */
    public function render(View $view): string
    {
        $fax = $this->getObjectModel();

        return $view->render('_item_common', [
            'user' => $this->model->user,
            'body' => $this->getBody() .
                ' - ' .
                (isset($fax->document) ? \yii\helpers\Html::a(
                    Yii::t('app', 'view document'),
                    $fax->document->getViewUrl(),
                    [
                        'target' => '_blank',
                        'data-pjax' => 0
                    ]
                ) : ''),
            'footer' => Yii::t('app', '{type} was sent to {group}', [
                'type' => $fax ? $fax->getTypeText() : 'Fax',
                'group' => isset($fax->creditorGroup) ? \yii\helpers\Html::a($fax->creditorGroup->name, ['creditors/groups'], ['data-pjax' => 0]) : ''
            ]),
            'footerDatetime' => $this->model->ins_ts,
            'iconClass' => 'fa-fax bg-green'
        ]);
    }

    /**
     * @return \app\models\Fax
     */
    protected function getObjectModel(): \app\models\Fax
    {
        return $this->model->fax;
    }
}