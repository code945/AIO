<?php
namespace backend\controllers;

use backend\models\Admin;
use common\helper\HttpHelper;
use HttpException;
use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginForm;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'captcha','test-websocket','wechat-auth-handler','check-wechat-login'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'maxLength'=>4,
                'minLength'=>4,
            ],
        ];
    }

    public function actionError()
    {
        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            // action has been invoked not from error handler, but by direct route, so we display '404 Not Found'
            $exception = new HttpException(404, Yii::t('yii', 'Page not found.'));
        }

        if ($exception instanceof HttpException) {
            $code = $exception->statusCode;
        } else {
            $code = $exception->getCode();
        }
        if ($exception instanceof Exception) {
            $name = $exception->getName();
        } else {
            $name = Yii::t('yii', 'Error');
        }
        if ($code) {
            $name .= " (#$code)";
        }

        if ($exception instanceof UserException) {
            $message = $exception->getMessage();
        } else {
            $message = Yii::t('yii', 'An internal server error occurred.');
        }

        Yii::error("\n====================================\n"
                    .$exception
                    ."\n=================================\n");

        if (Yii::$app->getRequest()->getIsAjax()) {
            return "$name: $message";
        } else {
            return $this->render('error', [
                'name' => $name,
                'message' => $message,
                'exception' => $exception,
            ]);
        }
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionCheckWechatLogin()
    {
        $code = 0 ;
        $msg = "";
        $login_code = HttpHelper::getParams('code');
        $openid =  Yii::$app->redis->get('wechatLogin:admin:'.$login_code.':'.'openid');
        if( $openid!= null)
        {
            $user = Admin::findOne(['wechat_id'=>$openid]);
            if($user != null && Yii::$app->user->login($user , 3600))
            {
                $code= 1;
                $msg= "success";
                Yii::$app->redis->del('wechatLogin:admin:'.$login_code.':'.'openid');
            } else {
                $code = 0 ;
                $msg = "登陆失败，微信未绑定或找不到微信对应用户，请刷新登陆页面后重新扫码登陆";
            }
        }
        else
        {
            $code = 0 ;
            $msg = "openid不存在";
        }
        Yii::$app->response->format=Response::FORMAT_JSON;
        return ['error_code'=>$code,'msg'=>$msg];
    }


    public function actionTestWebsocket()
    {
        $task_id = HttpHelper::getParams('task_id');
        return $this->pushMsg($task_id);
    }

    function pushMsg($task_id)
    {
        // 建立连接，@see http://php.net/manual/zh/function.stream-socket-client.php
        $client = stream_socket_client('tcp://127.0.0.1:8806');
        if(!$client) return "can not connect";
        // 模拟超级用户，以文本协议发送数据，注意Text文本协议末尾有换行符（发送的数据中最好有能识别超级用户的字段），这样在Event.php中的onMessage方法中便能收到这个数据，然后做相应的处理即可
        return fwrite($client, '{"type":"send","task_id":"'.$task_id.'","status":"1"}'."\n");

    }


    public function actionWechatAuthHandler()
    {
       
        $openid= HttpHelper::getParams('openid');
        if( $openid!= null)
        {
            $user = Admin::findOne(['wechat_id'=>$openid]);
            if($user != null && Yii::$app->user->login($user , 0))
            {
                return $this->goHome();
            } else {
                return $this->render('error', [
                    'message' => '登陆失败，微信未绑定或找不到微信对应用户，请刷新登陆页面后重新扫码登陆. <a href="/site/login">点击重新登陆</a>',
                    'name' => '登陆失败',
                ]);
            }
        }
        else
        {
            return $this->render('error', [
                'message' => 'openid不存在，请刷新登陆页面后重新扫码登陆. <a href="/site/login">点击重新登陆</a>',
                'name' => 'openid不存在',
            ]);
        }
    }



}
