<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "barang".
 *
 * @property string $kode
 * @property int $id_pengguna
 * @property string $name
 * @property int $harga
 * @property string $kategori
 * @property string $ukuran
 * @property string $model
 * @property string $warna
 * @property int $jumlah
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property DetailLaporanPenjualan[] $detailLaporanPenjualans
 * @property User $pengguna
 */
class Barang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_barang', 'harga', 'kategori', 'ukuran', 'warna', 'jumlah'], 'required'],
            [['id_pengguna', 'harga', 'jumlah'], 'integer'],
            [['kode', 'nama_barang', 'kategori', 'ukuran', 'model', 'warna'], 'string', 'max' => 191],
            [['kode'], 'unique'],
            [['id_pengguna'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_pengguna' => 'id']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'id_pengguna' => 'Id Pengguna',
            'nama_barang' => 'Nama Barang',
            'harga' => 'Harga',
            'kategori' => 'Kategori',
            'ukuran' => 'Ukuran',
            'model' => 'Model',
            'warna' => 'Warna',
            'jumlah' => 'Jumlah',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[DetailLaporanPenjualans]].
     *
     * @return \yii\db\ActiveQuery|DetailLaporanPenjualanQuery
     */
    public function getDetailLaporanPenjualans()
    {
        return $this->hasMany(DetailLaporanPenjualan::class, ['kode_barang' => 'kode']);
    }

    /**
     * Gets query for [[Pengguna]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getPengguna()
    {
        return $this->hasOne(User::class, ['id' => 'id_pengguna']);
    }

    /**
     * {@inheritdoc}
     * @return BarangQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BarangQuery(get_called_class());
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->id_pengguna = Yii::$app->user->identity->id;
            if ($this->isNewRecord) {
                $this->kode = $this->kode ?: strtoupper(uniqid());
            }

            return true;
        }
        return false;
    }
}
