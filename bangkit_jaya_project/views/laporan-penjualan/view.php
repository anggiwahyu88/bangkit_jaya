<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\LaporanPenjualan $model */

$this->title = $model->id_penjualan;
$this->params['breadcrumbs'][] = ['label' => 'Laporan Penjualans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="laporan-penjualan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Delete', ['delete', 'id_penjualan' => $model->id_penjualan], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_penjualan',
            'total_harga',
            [
                'attribute' => 'id_pengguna',
                'label' => 'Kasir',
                'value' => function ($model) {
                    return $model->pengguna->nama;
                },
            ],
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
    <h2>Daftar Barang</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Barang</th>
                <th>Kode Barang</th>
                <th>Harga Penjualan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($model->detailLaporanPenjualans as $index => $detail): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $detail->kode_barang ?></td>
                    <td><?= $detail->kodeBarang->nama_barang?></td>
                    <td><?= $detail->kodeBarang->harga ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
