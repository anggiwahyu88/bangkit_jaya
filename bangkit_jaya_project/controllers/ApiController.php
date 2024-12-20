<?php

namespace app\controllers;

use app\models\Barang;
use app\models\DetailLaporanPenjualan;
use app\models\LaporanPenjualan;
use yii\rest\Controller;
use Yii;
use yii\helpers\ArrayHelper;

class ApiController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // Untuk mengaktifkan CORS jika diperlukan
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
        ];

        return $behaviors;
    }

    // GET /api
    public function actionIndex()
    {
        $rawJson = Yii::$app->request->getRawBody();
        $data = json_decode($rawJson, true);
        $kodeList = array_column($data, 'kode');
        $uniqueKode = array_unique($kodeList);
        
        // Ambil semua barang berdasarkan kode yang unik
        $recordsBarang = Barang::find()
        ->select(['kode', 'harga'])
        ->where(['kode' => $uniqueKode])
        ->all();
        
        // // Konversi $recordsBarang menjadi array dengan kode sebagai key untuk pencarian lebih cepat
        $recordsBarangByKode = ArrayHelper::map($recordsBarang, 'kode', 'harga');

        $totalHarga = 0;

        foreach ($data as $value) {
            $kode = $value['kode'];
            $jumlah = $value['jumlah'];
            
            // Pastikan kode ditemukan di recordsBarang
            if (isset($recordsBarangByKode[$kode])) {
                $price = $recordsBarangByKode[$kode];
                $totalHarga += $price * $jumlah;
            }
        }

        $laporan_penjualan = new LaporanPenjualan;
        $laporan_penjualan->total_harga = $totalHarga;
        $laporan_penjualan->id_pengguna = Yii::$app->user->identity->id;
        
        
        $result = $laporan_penjualan->save();
        $newId = $laporan_penjualan->getPrimaryKey();  // Ambil ID laporan yang baru disimpan        
        if ($result) {
            
            foreach ($data as $value) {
                $kode = $value['kode'];
                $jumlah = $value['jumlah'];

                // Pastikan harga penjualan ada di recordsBarangByKode
                if (isset($recordsBarangByKode[$kode])) {
                    $hargaPenjualan = $recordsBarangByKode[$kode]; // Ambil harga berdasarkan kode

                    // Loop untuk menyimpan detail sesuai jumlah
                    for ($i = 0; $i < $jumlah; $i++) {
                        $detailLaporan = new DetailLaporanPenjualan();
                        $detailLaporan->id_penjualan = $newId;
                        $detailLaporan->kode_barang = $kode;
                        $detailLaporan->harga_penjualan = $hargaPenjualan; // Set harga penjualan

                        // Simpan detail laporan
                        $detailLaporan->save();
                    }
                }
            }
        }
        return ["message" => "succes", "redirectUrl" => Yii::$app->urlManager->createUrl(['laporan-penjualan/view', 'id_penjualan' => $newId]),
    ];
    }

    // // GET /api/view?id=1
    // public function actionView($id)
    // {
    //     return YourModel::findOne($id);
    // }

    // POST /api
    public function actionReceiveJson()
    {
        // Mendapatkan semua parameter dari JSON body sebagai array
        $data = Yii::$app->request->bodyParams;

        // Jika ingin membaca raw JSON body
        $rawJson = Yii::$app->request->getRawBody();

        return [
            'parsed' => $data,
            'raw' => $rawJson,
        ];
    }

    // // PUT /api/update?id=1
    // public function actionUpdate($id)
    // {
    //     $model = YourModel::findOne($id);
    //     if (!$model) {
    //         return ['error' => 'Data not found'];
    //     }

    //     $model->load(\Yii::$app->request->post(), '');
    //     if ($model->save()) {
    //         return $model;
    //     }

    //     return ['errors' => $model->errors];
    // }

    // // DELETE /api/delete?id=1
    // public function actionDelete($id)
    // {
    //     $model = YourModel::findOne($id);
    //     if ($model && $model->delete()) {
    //         return ['success' => true];
    //     }

    //     return ['error' => 'Failed to delete'];
    // }
}
