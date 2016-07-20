<?php

namespace modules\member\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Default controller for the `member` module
 */
class MemberBaseController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                      // allow authenticated users
                      [
                          'allow' => true,
                          'roles' => ['@'],
                      ],
                      // everything else is denied
                ],
            ],
        ];
    }
}
