<?php

namespace backend\controllers;

use Yii;
use common\models\Categoria;
use backend\models\CategoriaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoriaController implements the CRUD actions for Categoria model.
 */
class CategoriaController extends Controller
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
     * Lists all Categoria models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategoriaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Categoria model.
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
     * Creates a new Categoria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categoria();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Categoria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
         $model = $this->findModel($id);
        $categoria=  Categoria::findOne(['id'=>$id]);
        $creado_por=\yii\helpers\ArrayHelper::getValue($categoria, 'created_by');   
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
            $this->redirect(['categoria/index']);
            
        }
    }

    /**
     * Deletes an existing Categoria model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
          $categoria=  Categoria::findOne(['id'=>$id]);
        $creado_por=\yii\helpers\ArrayHelper::getValue($categoria, 'created_by');
        
       if ($creado_por == Yii::$app->user->getId()){
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
       }else{
           \Yii::$app->getSession()->setFlash('info', 'No tiene permisos para borrar noticias que no ha publicado');
            $this->redirect(['categoria/index']); 
           
       }
    }

    /**
     * Finds the Categoria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categoria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categoria::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
