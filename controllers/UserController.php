<?php

namespace app\controllers;

use yii\rest\ActiveController;

class UserController extends ActiveController
{

    public $modelClass = 'app\models\Users';

    public function actions()
    {
        $actions = parent::actions();
        $actions['create']['class'] = 'app\actions\userController\CreateAction';
        $actions['index']['class'] = 'app\actions\userController\IndexAction';
        return $actions;
    }


}