<?php

namespace modules\user\controllers;

use common\actions\DeleteAction;
use common\helper\HttpHelper;
use common\models\User;
use common\models\UserSearchModel;
use kartik\grid\EditableColumnAction;
use modules\user\models\LoginForm;
use modules\user\models\SignupForm;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;

/**
 * Default controller for the `user` module
 */
class AuthController extends Controller
{

    public function actionActiveEmail()
    {
        $user_id = HttpHelper::getParams('userid');
        $token = HttpHelper::getParams('token');
        $redisToken = Yii::$app->redis->get('SignUpEmailToken:'.$user_id);
        if($redisToken != null && $redisToken == $token)
        {
            $user = User::findOne($user_id);
            $user->status = User::STATUS_ACTIVE;
            $user->save();
            Yii::$app->user->login($user);
        } 
        return $this->goHome();
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('login');
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignupEmail()
    {
        return $this->render('signupEmail',[]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                $token = md5(uniqid(rand()));
                $url = 'http://www.aio.com/user/auth/active-email?userid='.$user->id.'&token='.$token;
                $mail = '
                尊敬的用户，您好！
                恭喜您已经完成大部分注册流程，您可以点击下面的链接完成账户激活：
                <a href="'.$url.'">'.$url.'</a>
                ';

                Yii::$app->redis->setex('SignUpEmailToken:'.$user->id, 300,$token);
                $r = Yii::$app->mailer->compose()
                        ->setFrom('lhx880619@163.com')
                        ->setTo($model->email)
                        ->setSubject('注册激活邮件')
                        ->setHtmlBody($mail)
                        ->send();
                return $this->render('signupEmail', [
                    'model' => $model,
                ]);
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

}
