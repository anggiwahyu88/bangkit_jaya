<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LaporanPenjualan $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="laporan-penjualan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'total_harga')->textInput() ?>

    <?= $form->field($model, 'id_pengguna')->textInput() ?>

    <?= $form->field($model, 'createdAt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updatedAt')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
