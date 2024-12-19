<?php

use app\models\Barang;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\BarangSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Barang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barang-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Barang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'kode',
            // 'id_pengguna',
            'nama_barang',
            'harga',
            // 'kategori',
            //'ukuran',
            //'model',
            //'warna',
            'jumlah',
            [
                'attribute' => 'createdAt',
                'label'=>'Di buat',
                'format' => ['date', 'php:d-m-Y H:i:s'], // Customize format as needed
                'value' => function ($model) {
                    return $model->createdAt;
                },
            ],
            // 'createdAt',
            //'updatedAt',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update}', 
                'urlCreator' => function ($action, Barang $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'kode' => $model->kode]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>