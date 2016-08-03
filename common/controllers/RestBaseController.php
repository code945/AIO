<?php
/**
 * User: hongxu.lin
 * Date: 8/3/2016
 * Time: 6:14 PM
 */

namespace common\controllers;


use yii\rest\ActiveController;

class RestBaseController extends ActiveController
{
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
        'linksEnvelope' => 'links',
        'metaEnvelope' => 'meta',
    ];
}