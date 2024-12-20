<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
$no = 1; 
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Id Penjualan</th>
            <th scope="col">Total Harga</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Kasir</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $item): ?>
            <tr>
                <th scope="row"><?= $no++ ?></th>
                <td><?= $item->id_penjualan ?></td>
                <td><?= $item->total_harga ?></td>
                <td><?= Yii::$app->formatter->asDatetime($item->createdAt, 'php:d-m-Y H:i:s')?></td>
                <td><?= $item->pengguna->nama ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>