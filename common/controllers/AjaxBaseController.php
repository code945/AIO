<?php
/**
 * User: hongxu.lin
 * Date: 7/19/2016
 * Time: 5:18 PM
 */

namespace common\controllers;


use Yii;
use yii\web\Controller;
use yii\web\Response;

class AjaxBaseController extends Controller
{

    /**
     * @param $data array
     * @return mixed
     */
    public function json($data)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }
}