<?php
/**
 * Created by PhpStorm.
 * User: vasia
 * Date: 29.07.2020
 * Time: 20:54
 */

namespace app\actions\userController;

use Yii;
use yii\helpers\Url;
use yii\web\ServerErrorHttpException;

class CreateAction extends \yii\rest\CreateAction
{
    public function run()
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        $cash = Yii::$app->cache;
        $array_users = $cash->get('createUsers');
        $array_users[] = Yii::$app->getRequest()->getBodyParams();
        $cash->set('createUsers', $array_users);

        if (count($array_users) > 0) {
            foreach ($array_users as $userData) {
                $model = new $this->modelClass([
                    'scenario' => $this->scenario,
                ]);
                $model->load($userData, '');

                if ($model->save()) {
                    $response = Yii::$app->getResponse();
                    $response->setStatusCode(201);
                    $id = implode(',', array_values($model->getPrimaryKey(true)));
                    if(isset($userData['phone'])){
                        $model->addPhone($userData['phone']);
                    }
                    $response->getHeaders()->set('Location', Url::toRoute([$this->viewAction, 'id' => $id], true));
                } elseif (!$model->hasErrors()) {
                    throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
                }
            }
            $cash->delete('createUsers');


        }


    }
}