import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// ==================================================
//         TAMBAHKAN KODE BARU DI BAWAH INI
// ==================================================

import Cleave from 'cleave.js';

// Pastikan DOM sudah siap sebelum menjalankan script
document.addEventListener('DOMContentLoaded', function() {

    // Cari input HANYA jika elemennya ada di halaman ini
    const cleaveInput = document.getElementById('jumlah_diajukan_formatted');
    const hiddenInput = document.getElementById('jumlah_diajukan');

    if (cleaveInput && hiddenInput) {
        new Cleave(cleaveInput, {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            delimiter: '.',
            numeralDecimalMark: ',',
            onValueChanged: function (e) {
                // Update nilai input tersembunyi dengan angka bersih
                hiddenInput.value = e.target.rawValue;
            }
        });
    }
});
