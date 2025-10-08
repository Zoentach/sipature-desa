document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('search-desa');
    const resultBox = document.getElementById('search-results');

    if (!input || !resultBox) return;

    input.addEventListener('input', function () {
        const query = this.value;

        if (query.length < 2) {
            resultBox.classList.add('hidden');
            resultBox.innerHTML = '';
            return;
        }

        fetch(`/search?query=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                if (data.length > 0) {
                    let html = data.map(item => {
                        const kepala = item.kepala_desa?.nama ?? '-';
                        return `
                            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer"
                                onclick="window.location.href='/detail-desa/${item.id}'">
                                <div class="font-medium">${item.nama}</div>
                                <div class="text-sm text-gray-500">
                                  <!--  Kecamatan: ${item.kode_kecamatan} <br> -->
                                    Kepala Desa: ${kepala}
                                </div>
                            </li>`;
                    }).join('');
                    resultBox.innerHTML = html;
                    resultBox.classList.remove('hidden');
                } else {
                    resultBox.innerHTML = '<li class="px-4 py-2 text-gray-500">Tidak ditemukan</li>';
                    resultBox.classList.remove('hidden');
                }
            });
    });

    document.addEventListener('click', function (e) {
        if (!input.contains(e.target) && !resultBox.contains(e.target)) {
            resultBox.classList.add('hidden');
        }
    });
});
