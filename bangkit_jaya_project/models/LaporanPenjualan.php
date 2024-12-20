<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "laporan_penjualan".
 *
 * @property int $id_penjualan
 * @property int $total_harga
 * @property int $id_pengguna
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property DetailLaporanPenjualan[] $detailLaporanPenjualans
 * @property User $pengguna
 */
class LaporanPenjualan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'laporan_penjualan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['total_harga', 'id_pengguna'], 'required'],
            [['total_harga', 'id_pengguna','id_penjualan'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['id_pengguna'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_pengguna' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_penjualan' => 'Id Penjualan',
            'total_harga' => 'Total Harga',
            'id_pengguna' => 'Id Pengguna',
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
        return $this->hasMany(DetailLaporanPenjualan::class, ['id_penjualan' => 'id_penjualan']);
    }

    /**
     * Gets query for [[Pengguna]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getPengguna()
    {
        return $this->hasOne(User::class, ['id' => 'id_pengguna']);
    }

    /**
     * {@inheritdoc}
     * @return DetailLaporanPenjualanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DetailLaporanPenjualanQuery(get_called_class());
    }
    // public function beforeSave($insert)
    // {
    //     if (parent::beforeSave($insert)) {
    //         $currentTimestamp = date('Y-m-d H:i:s');

    //         if ($this->isNewRecord) {
    //             $this->createdAt = $currentTimestamp;
    //             $this->updatedAt = $currentTimestamp;
    //         }
    //         $this->updatedAt = $currentTimestamp;

    //         return true;
    //     }
    //     return false;
    // }
}
