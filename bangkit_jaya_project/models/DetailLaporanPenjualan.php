<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_laporan_penjualan".
 *
 * @property int $id
 * @property int $id_penjualan
 * @property string $kode_barang
 * @property int $harga_penjualan
 * @property int|null $usersId_pengguna
 *
 * @property Barang $kodeBarang
 * @property LaporanPenjualan $penjualan
 * @property User $usersIdPengguna
 */
class DetailLaporanPenjualan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_laporan_penjualan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_penjualan', 'kode_barang', 'harga_penjualan'], 'required'],
            [['id_penjualan', 'harga_penjualan'], 'integer'],
            [['kode_barang'], 'string', 'max' => 191],
            [['id_penjualan'], 'exist', 'skipOnError' => true, 'targetClass' => LaporanPenjualan::class, 'targetAttribute' => ['id_penjualan' => 'id_penjualan']],
            [['kode_barang'], 'exist', 'skipOnError' => true, 'targetClass' => Barang::class, 'targetAttribute' => ['kode_barang' => 'kode']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_penjualan' => 'Id Penjualan',
            'kode_barang' => 'Kode Barang',
            'harga_penjualan' => 'Harga Penjualan',
        ];
    }

    /**
     * Gets query for [[KodeBarang]].
     *
     * @return \yii\db\ActiveQuery|BarangQuery
     */
    public function getKodeBarang()
    {
        return $this->hasOne(Barang::class, ['kode' => 'kode_barang']);
    }

    /**
     * Gets query for [[Penjualan]].
     *
     * @return \yii\db\ActiveQuery|LaporanPenjualanQuery
     */
    public function getPenjualan()
    {
        return $this->hasOne(LaporanPenjualan::class, ['id_penjualan' => 'id_penjualan']);
    }

    /**
     * {@inheritdoc}
     * @return DetailLaporanPenjualanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DetailLaporanPenjualanQuery(get_called_class());
    }
}
