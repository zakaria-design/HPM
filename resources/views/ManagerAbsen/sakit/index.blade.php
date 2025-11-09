<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sakit</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Remix Icon CDN -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <!-- Font Awesome CDN (untuk icon jam/map) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex items-start justify-center py-10 px-2">

    <form action="{{ route('manager.absen.sakit') }}" method="POST" enctype="multipart/form-data"
        class="max-w-lg w-full bg-white rounded-2xl shadow-lg p-6 space-y-5 border border-gray-200">
        @csrf

        <!-- Judul Form -->
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-4 flex items-center justify-center gap-2">
            🤒 <span>Form Sakit</span>
        </h2>

        <!-- Alasan Sakit -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Alasan Sakit</label>
            <textarea name="alasan_sakit"
                class="w-full border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500 rounded-lg p-3 text-gray-700 resize-none"
                rows="4" placeholder="Tuliskan alasan sakit Anda..." required></textarea>
        </div>

        <!-- Upload Bukti -->
        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Upload Foto Bukti (Opsional)</label>

            <div id="upload-wrapper"
                class="relative flex items-center justify-center w-full bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:bg-gray-100 transition overflow-hidden">

                <!-- Preview Gambar -->
                <img id="preview-image" class="hidden w-full h-56 object-cover rounded-lg absolute top-0 left-0 z-10" />

                <!-- Label Upload -->
                <label for="foto_bukti"
                    class="w-full h-full flex flex-col items-center justify-center py-6 cursor-pointer z-0">
                    <svg class="w-10 h-10 text-gray-400 mb-2" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 15a4 4 0 014-4h1m4-4h2m0 0l2 2m-2-2v4m0 0l-2-2m2 2h2m-8 0a4 4 0 018 0m-8 0v4m0 0l-2-2m2 2h4" />
                    </svg>
                    <p class="text-gray-500 text-sm">Klik atau seret foto ke sini</p>
                    <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, maksimal 2MB</p>
                </label>

                <!-- Input File -->
                <input id="foto_bukti" type="file" name="foto_bukti" class="hidden" accept="image/*">
            </div>
        </div>

        <!-- Tombol Kirim & Kembali -->
        <div class="flex flex-col sm:flex-row justify-center gap-3 pt-4">
            <button type="button" onclick="window.history.back()"
                class="w-full sm:w-1/2 flex justify-center items-center gap-2 bg-gray-500 text-white font-semibold py-2.5 rounded-lg shadow hover:bg-gray-600 active:scale-[0.98] transition-all">
                <i class="ri-arrow-left-line text-lg"></i>
                <span>Kembali</span>
            </button>

            <button type="submit"
                class="w-full sm:w-1/2 flex justify-center items-center gap-2 bg-red-600 text-white font-semibold py-2.5 rounded-lg shadow hover:bg-red-700 active:scale-[0.98] transition-all">
                <i class="ri-send-plane-fill text-lg"></i>
                <span>Kirim Sakit</span>
            </button>
        </div>
    </form>

    <!-- Script Preview Gambar -->
    <script>
        document.getElementById('foto_bukti').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview-image');
            const wrapper = document.getElementById('upload-wrapper');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    wrapper.classList.remove('border-dashed', 'border-gray-300');
                };
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
                wrapper.classList.add('border-dashed', 'border-gray-300');
            }
        });
    </script>

</body>
</html>
