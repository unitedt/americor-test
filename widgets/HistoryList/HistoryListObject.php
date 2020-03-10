<?php

namespace app\widgets\HistoryList;

use app\models\History;
use yii\web\View;
use app\models\search\HistorySearch;

class HistoryListObject
{
    protected static $classMap = [
        \app\models\Sms::class => \app\widgets\HistoryList\HistoryListObject\Sms::class,
        \app\models\Task::class => \app\widgets\HistoryList\HistoryListObject::class,
        \app\models\Call::class => \app\widgets\HistoryList\HistoryListObject::class,
        \app\models\Fax::class => \app\widgets\HistoryList\HistoryListObject::class,
    ];

    /**
     * @var HistorySearch
     */
    protected $model;

    final public static function init(History $model): self
    {
        $modelClassName = History::getClassNameByRelation($model->object);
        return null !== $modelClassName ? new self::$classMap[$modelClassName]($model) : new self($model);
    }

    protected function __construct(History $model)
    {
        $this->model = $model;
    }

    public function render(View $view)
    {
        return $view->render('_item_common', [
            'user' => $this->model->user,
            'body' => $this->model->eventText,
            'bodyDatetime' => $this->model->ins_ts,
            'iconClass' => 'fa-gear bg-purple-light'
        ]);
    }
}