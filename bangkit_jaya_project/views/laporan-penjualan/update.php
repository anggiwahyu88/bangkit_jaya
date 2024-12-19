<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LaporanPenjualan $model */

$this->title = 'Update Laporan Penjualan: ' . $model->id_penjualan;
$this->params['breadcrumbs'][] = ['label' => 'Laporan Penjualans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_penjualan, 'url' => ['view', 'id_penjualan' => $model->id_penjualan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="laporan-penjualan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
