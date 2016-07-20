<?php

namespace modules\member\controllers;

use yii\web\Controller;

/**
 * Default controller for the `member` module
 */
class DefaultController extends MemberBaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
