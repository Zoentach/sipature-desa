@extends('admin.dashboard')

@section('content')

<h2 class="text-2xl md:text-4xl font-extrabold dark:text-white mb-4">Absensi</h2>

<livewire:absensi-filter/>

<!-- Script untuk uptanggal desa berdasarkan kecamatan -->
<!--<script>
    document.getElementById('kecamatan').addEventListener('change', function () {
        const kodeKec = this.value;
        const desaSelect = document.getElementById('desa');

        desaSelect.innerHTML = '<option value="">Memuat...</option>';

        // 👇 Tambahkan block fetch() di sini
        fetch(`/api/desas?kode_kecamatan=${kodeKec}`)
            .then(response => response.json())
            .then(data => {
                desaSelect.innerHTML = '<option value="">-- Pilih Desa --</option>';
                data.forEach(desa => {
                    desaSelect.innerHTML += `<option value="${desa.id}">${desa.nama}</option>`;
                });
            })
            .catch(() => {
                desaSelect.innerHTML = '<option value="">Gagal memuat desa</option>';
            });
    });
</script> -->

@endsection
