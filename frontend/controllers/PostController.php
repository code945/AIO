<?php
namespace frontend\controllers;

use common\models\Post;
use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;

/**
 * Site controller
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'query' => ['POST','GET'],
                ],
            ],
        ];
    }


    public function beforeAction($action)
    {
        if($action->id == 'query')
            $this->enableCsrfValidation = false;
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }


    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionQuery()
    {
        $code = 0 ;
        $msg = "";
        $data = null;
        $page = null;
        try
        {
            $dataProvider = new ActiveDataProvider([
                'query' => Post::find(),
            ]);

            $data = $dataProvider->models;
            $page = $dataProvider->pagination;
            $code= 1;
            $msg= "success";
        }
        catch (Exception $e)
        {
            
        } 
        Yii::$app->response->format=Response::FORMAT_JSON;
        return ['error_code'=>$code,'msg'=>$msg,'data'=>$data,'page' => $page];
    }


    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $tags = (new \yii\db\Query())
            ->select(['post_id','tag_id','tag.name'])
            ->from('post_tag')
            ->leftJoin('tag',"post_tag.tag_id= tag.id")
            ->where(['post_id'=>$id])
            ->all();

        $model = Post::findOne($id);
        $model->view_count = $model->view_count+1;
        $model->save();
        return $this->render('view', [
            'model' =>$model ,
            'tags'=>$tags,
        ]);
    }

}
