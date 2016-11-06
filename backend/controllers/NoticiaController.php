<?php

namespace backend\controllers;

use Yii;
use common\models\Noticia;
use backend\models\NoticiaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NoticiaController implements the CRUD actions for Noticia model.
 */
class NoticiaController extends Controller
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
                ],
            ],
            
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'Noticia', 'Categoria', 'Comentarios', 'create', 'update', 'view', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    
                    [
                        'actions' => ['logout', 'Noticia', 'Categoria', 'Comentarios', 'create', 'update', 'view', 'delete'],
                        'allow' => true,
                        'roles' => ['Marc'],
                    ],
                    
                    [
                        'actions' => ['logout', 'Noticia'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],


        ];
    }

    /**
     * Lists all Noticia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NoticiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Noticia model.
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
     * Creates a new Noticia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Noticia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Noticia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        
        $model = $this->findModel($id);
        $noticia=Noticia::findOne(['id'=>$id]);
        $creado_por=\yii\helpers\ArrayHelper::getValue($noticia, 'created_by');   
        //print_r(\yii\helpers\ArrayHelper::getValue($noticia, 'created_by'));die;
        //Yii::$app->user->identity
        
        if ($creado_por == Yii::$app->user->getId()){
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }            
        }else {
            \Yii::$app->getSession()->setFlash('info', 'No tiene permisos para editar noticias que no ha publicado');
            $this->redirect(['noticia/index']);
            
        }


    }

    /**
     * Deletes an existing Noticia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        
         $noticia=Noticia::findOne(['id'=>$id]);
        $creado_por=\yii\helpers\ArrayHelper::getValue($noticia, 'created_by');
        
       if ($creado_por == Yii::$app->user->getId()){
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
       }else{
           \Yii::$app->getSession()->setFlash('info', 'No tiene permisos para borrar noticias que no ha publicado');
            $this->redirect(['noticia/index']); 
           
       }
    }

    /**
     * Finds the Noticia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Noticia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Noticia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
