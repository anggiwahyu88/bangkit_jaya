<?php

use app\models\LaporanPenjualan;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modelsLaporanPenjualanSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Laporan Penjualans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laporan-penjualan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Laporan Penjualan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id_penjualan',
            [
                'attribute' => 'id_pengguna',
                'label' => 'Kasir',
                'value' => function ($model) {
                    return $model->pengguna->nama;
                },
            ],
            'total_harga',
            [
                'attribute' => 'createdAt',
                'label'=>'Di buat',
                'format' => ['date', 'php:d-m-Y H:i:s'], // Customize format as needed
                'value' => function ($model) {
                    return $model->createdAt;
                },
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view}', 
                'urlCreator' => function ($action, LaporanPenjualan $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_penjualan' => $model->id_penjualan]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
