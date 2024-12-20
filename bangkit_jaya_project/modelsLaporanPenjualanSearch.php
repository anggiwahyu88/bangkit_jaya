<?php

namespace app;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LaporanPenjualan;

/**
 * modelsLaporanPenjualanSearch represents the model behind the search form of `app\models\LaporanPenjualan`.
 */
class modelsLaporanPenjualanSearch extends LaporanPenjualan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_penjualan', 'total_harga', 'id_pengguna'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = LaporanPenjualan::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_penjualan' => $this->id_penjualan,
            'total_harga' => $this->total_harga,
            'id_pengguna' => $this->id_pengguna,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ]);

        return $dataProvider;
    }
}
