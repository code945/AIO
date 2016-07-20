<?php

namespace modules\member\controllers;

use modules\member\models\ChpwdForm;
use Yii;
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


    public function actionChpwd()
    {
        $model = new ChpwdForm();
        if ($model->load(Yii::$app->request->post()) && $model->ChangePassword() ) {
            Yii::$app->getSession()->setFlash('success', '保存成功');
            $this->refresh();
        } else {
            return $this->render('chpwd', [
                'model' => $model,
            ]);
        }
    }
    
}
