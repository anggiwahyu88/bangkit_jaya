<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LaporanPenjualan $model */

$this->title = 'Create Laporan Penjualan';
$this->params['breadcrumbs'][] = ['label' => 'Laporan Penjualans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container mt-5">
    <form id="dynamicForm">
        <!-- Container untuk baris input -->
        <div id="inputContainer">
            <div class="row mb-3 align-items-center">
                <div class="col-6">
                    <!-- Dropdown -->
                    <select class="form-select product-select" name="product[]" aria-label="Select Product">
                        <option value="" selected disabled>Select Product</option>
                        <?php
                        // Data produk dari PHP
                        foreach ($products as $product) {
                            echo "<option value='{$product['kode']}'>{$product['kode']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-2">
                    <input type="number" class="form-control custom-input quantity-input" name="quantity[]" placeholder="Qty" min="1" value="1">
                </div>
                <div class="col-2">
                    <button type="button" class="btn text-danger remove-btn">-</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <span class="add-row">+ Tambah</span>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script>
    const inputContainer = document.getElementById('inputContainer');
    const addRow = document.querySelector('.add-row');
    const dynamicForm = document.getElementById('dynamicForm');

    // Fungsi untuk tombol hapus
    function attachRemoveEvent(row) {
        const removeBtn = row.querySelector('.remove-btn');
        removeBtn.addEventListener('click', function() {
            row.remove();
        });
    }

    // Fungsi untuk menambahkan semua event ke elemen baru
    function attachEvents(row) {
        const productSelect = row.querySelector('.product-select');
        const quantityInput = row.querySelector('.quantity-input');

        // Menambahkan event untuk perubahan kuantitas (onchange)
        quantityInput.addEventListener('change', function() {
            // Tidak ada perhitungan harga yang diperlukan di sini
        });

        // Menambahkan event untuk tombol hapus
        attachRemoveEvent(row);
    }

    // Tambahkan baris baru
    addRow.addEventListener('click', function() {
        const newRow = document.createElement('div');
        newRow.classList.add('row', 'mb-3', 'align-items-center');

        newRow.innerHTML = `
            <div class="col-6">
                <select class="form-select product-select" name="product[]" aria-label="Select Product">
                    <option value="" selected disabled>Select Product</option>
                    <?php
                    foreach ($products as $product) {
                        echo "<option value='{$product['kode']}'>{$product['kode']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-2">
                <input type="number" class="form-control custom-input quantity-input" name="quantity[]" placeholder="Qty" min="1" value="1">
            </div>
            <div class="col-2">
                <button type="button" class="btn text-danger remove-btn">-</button>
            </div>
        `;

        inputContainer.appendChild(newRow);

        // Tambahkan event listener untuk dropdown dan tombol hapus
        attachEvents(newRow);
    });

    // Fungsi untuk mengumpulkan data dari form dan mengirim ke API
    dynamicForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah pengiriman form secara default

        const products = [];
        const productSelects = document.querySelectorAll('.product-select');
        const quantityInputs = document.querySelectorAll('.quantity-input');

        // Mengumpulkan data produk dan jumlah
        productSelects.forEach((select, index) => {
            const product = select.value;
            const quantity = quantityInputs[index].value;

            if (product && quantity) {
                products.push({
                    kode: product, // Kode produk
                    jumlah: quantity // Jumlah produk
                });
            }
        });
        
        // Mengirim data ke API
        fetch('/basic2/web/api', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(products),
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === "succes") {
                    window.location.replace(data.redirectUrl); 
                }
            })
            .catch(error => {
                // Menangani error jika ada
                console.error('Error:', error);
            });
    });
</script>