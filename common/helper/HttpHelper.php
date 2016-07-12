<?php
/**
 * Created by PhpStorm.
 * User: hongxu.lin
 * Date: 6/2/2016
 * Time: 2:09 PM
 */

namespace common\helper;


use Yii;

class HttpHelper
{
    public static function getParams($key,$defaultValue=null)
    {
        $request = Yii::$app->request;
        $get = $request->get($key);
        $post = $request->getBodyParam($key);
        if($get!=null)
            return $get;
        else if($post!=null)
            return $post;
        else
            return $defaultValue;
    }
}