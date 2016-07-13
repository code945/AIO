<?php

namespace backend\controllers;

use common\actions\DeleteAction;
use kartik\grid\EditableColumnAction;
use Yii;
use common\models\Category;
use common\models\CategorySearchModel;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
                    'delete' => ['POST'],
                    'downlevel' => ['POST','GET'],
                    'uplevel' => ['POST','GET'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'editCategoty' => [                                       // identifier for your editable column action
                'class' => EditableColumnAction::className(),     // action class name
                'modelClass' => Category::className(),                // the model for the record being edited
                'outputValue' => function ($model, $attribute, $key, $index) {
                    return  $model->$attribute;      // return any custom output value if desired
                },
                'outputMessage' => function($model, $attribute, $key, $index) {
                    return '';                                  // any custom error to return after model save
                },
                'showModelErrors' => true,                        // show model validation errors after save
                'errorOptions' => ['header' => '']                // error summary HTML options
                // 'postOnly' => true,
                // 'ajaxOnly' => true,
                // 'findModel' => function($id, $action) {},
                // 'checkAccess' => function($action, $model) {}
            ],
            'batchDelete'=>[
                'class' => DeleteAction::className(),     // action class name
                'modelClass' => Category::className(),
            ],
        
        ]);
    }

    public function beforeAction($action)
    {
        $noCSRF = ['uplevel','downlevel','batchDelete',];
        if(array_key_exists($action->id, $noCSRF))
             $this->enableCsrfValidation = false;
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    { 
        $searchModel = new CategorySearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();


        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);


    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            return null;
        }
    }


    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUplevel()
    {
        if(Yii::$app->request->isPost)
            $id = Yii::$app->request->post('id');
        else
            $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        $p =   $this->findModel($model->pid);
        $code = 0 ;
        $msg = "";
        $data = null;
        if($model!= null)
        {
            $data = Category::findAll(['pid' =>  $p->pid]);
            $code= 1;
            $msg= "success";
        }
        else
        {
            $data = Category::findAll(['pid' => null]);
            $code= 1;
            $msg= "success";
        }
        Yii::$app->response->format=Response::FORMAT_JSON;
        return ['error_code'=>$code,'msg'=>$msg,'data'=>$data];
    }



    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDownlevel()
    {
        if(Yii::$app->request->isPost)
            $id = Yii::$app->request->post('id');
        else
            $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        $code = 0 ;
        $msg = "";
        $data = null;
        if($model!= null)
        {
            $data = Category::findAll(['pid' => $id]);
            $code= 1;
            $msg= "success";
        }
        else
        {
            $data = Category::findAll(['pid' => null]);
            $code= 1;
            $msg= "success";
        }
        Yii::$app->response->format=Response::FORMAT_JSON;
        return ['error_code'=>$code,'msg'=>$msg,'data'=>$data];
    }


}
