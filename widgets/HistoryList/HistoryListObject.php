<?php

namespace app\widgets\HistoryList;

use app\models\History;
use yii\web\View;

/**
 * Class HistoryListObject
 * @package app\widgets\HistoryList
 */
class HistoryListObject
{
    protected static $classMap = [
        \app\models\Sms::class => \app\widgets\HistoryList\HistoryListObject\Sms::class,
        \app\models\Task::class => \app\widgets\HistoryList\HistoryListObject\Task::class,
        \app\models\Call::class => \app\widgets\HistoryList\HistoryListObject\Call::class,
        \app\models\Fax::class => \app\widgets\HistoryList\HistoryListObject\Fax::class,
        \app\models\Customer::class => \app\widgets\HistoryList\HistoryListObject\Customer::class,
    ];

    /**
     * @var History
     */
    protected $model;

    /**
     * @param History $model
     * @return HistoryListObject
     */
    final public static function init(History $model): self
    {
        $modelClassName = History::getClassNameByRelation($model->object);
        return null !== $modelClassName ? new self::$classMap[$modelClassName]($model) : new self($model);
    }

    /**
     * HistoryListObject constructor.
     * @param History $model
     */
    protected function __construct(History $model)
    {
        $this->model = $model;
    }

    /**
     * @param View $view
     * @return string
     */
    public function render(View $view): string
    {
        return $view->render('_item_common', [
            'user' => $this->model->user,
            'body' => $this->getBody(),
            'bodyDatetime' => $this->model->ins_ts,
            'iconClass' => 'fa-gear bg-purple-light'
        ]);
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->model->eventText;
    }
}