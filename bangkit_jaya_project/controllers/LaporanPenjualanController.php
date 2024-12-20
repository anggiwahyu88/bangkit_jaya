<?php

namespace app\controllers;

use app\models\Barang;
use app\models\DetailLaporanPenjualan;
use app\models\LaporanPenjualan;
use app\modelsLaporanPenjualanSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LaporanPenjualanController implements the CRUD actions for LaporanPenjualan model.
 */
class LaporanPenjualanController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all LaporanPenjualan models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["/"]);
        }
        $searchModel = new modelsLaporanPenjualanSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LaporanPenjualan model.
     * @param int $id_penjualan Id Penjualan
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_penjualan)
    {
        $model = LaporanPenjualan::find()
            ->where(['id_penjualan' => $id_penjualan])
            ->with(['pengguna', 'detailLaporanPenjualans.kodeBarang'])
            ->one();
        if ($model === null) {
            throw new NotFoundHttpException('Data tidak ditemukan.');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new LaporanPenjualan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        // $model = new LaporanPenjualan();

        // if ($this->request->isPost) {
        //     if ($model->load($this->request->post()) && $model->save()) {
        //         return $this->redirect(['view', 'id_penjualan' => $model->id_penjualan]);
        //     }
        // } else {
        //     $model->loadDefaultValues();
        // }

        $products = Barang::find()
            ->select(['kode'])
            ->asArray()
            ->all();

        return $this->render('create', [
            "products" => $products,
        ]);
    }

    /**
     * Updates an existing LaporanPenjualan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_penjualan Id Penjualan
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_penjualan)
    {
        $model = $this->findModel($id_penjualan);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_penjualan' => $model->id_penjualan]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LaporanPenjualan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_penjualan Id Penjualan
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_penjualan)
    {
        $items = DetailLaporanPenjualan::findAll(["id_penjualan" => $id_penjualan]);
        
        foreach ($items as $item) {
            $item->delete();
        }
        $this->findModel($id_penjualan)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the LaporanPenjualan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_penjualan Id Penjualan
     * @return LaporanPenjualan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_penjualan)
    {
        if (($model = LaporanPenjualan::findOne(['id_penjualan' => $id_penjualan])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
