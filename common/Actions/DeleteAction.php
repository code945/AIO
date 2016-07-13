<?php
/**
 * Created by PhpStorm.
 * User: hongxu.lin
 * Date: 7/13/2016
 * Time: 12:01 PM
 */
namespace common\actions;

use common\helper\HttpHelper;
use ReflectionClass;
use Yii;
use yii\base\Action;
use yii\web\Response;

class DeleteAction extends Action
{


    public $modelClass;

    public function run()
    {

        $request = Yii::$app->request;
        $post = $request->post();
        $post_id = HttpHelper::getParams('ids');
        $ids = explode(',',$post_id);
        $class = new ReflectionClass($this->modelClass);
        $method = $class->getmethod('deleteAll');
        $r = $method->invokeArgs(null,['condition'=>['id'=>$ids]]);
        return Yii::createObject(
            ['class' => Response::className(),
                'format' => Response::FORMAT_JSON,
                'data' =>['error_code'=>1,'msg'=>'success',]
            ]);
    }
}