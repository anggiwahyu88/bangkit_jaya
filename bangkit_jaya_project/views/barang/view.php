<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Barang $model */

$this->title = $model->kode;
$this->params['breadcrumbs'][] = ['label' => 'Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="barang-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'kode' => $model->kode], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kode',
            [
                'attribute' => 'id_pengguna',
                'label' => 'Pembuat',
                'value' => function ($model) {
                    return $model->pengguna->nama;
                },
            ],
            'nama_barang',
            'harga',
            'kategori',
            'ukuran',
            'model',
            'warna',
            'jumlah',
            [
                'attribute' => 'createdAt',
                'label' => 'Di buat',
                'format' => ['date', 'php:d-m-Y H:i:s'],
                'value' => function ($model) {
                    return $model->createdAt;
                },
            ],
            [
                'attribute' => 'updatedAt',
                'label' => 'Terakhir di ubah',
                'format' => ['date', 'php:d-m-Y H:i:s'],
                'value' => function ($model) {
                    return $model->updatedAt;
                },
            ],
        ],
    ]) ?>

</div>