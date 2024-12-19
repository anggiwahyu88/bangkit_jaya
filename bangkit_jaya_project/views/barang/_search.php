<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\BarangSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="barang-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'kode') ?>

    <?= $form->field($model, 'id_pengguna') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'harga') ?>

    <?= $form->field($model, 'kategori') ?>

    <?php // echo $form->field($model, 'ukuran') ?>

    <?php // echo $form->field($model, 'model') ?>

    <?php // echo $form->field($model, 'warna') ?>

    <?php // echo $form->field($model, 'jumlah') ?>

    <?php // echo $form->field($model, 'createdAt') ?>

    <?php // echo $form->field($model, 'updatedAt') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
