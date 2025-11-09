<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Izin Karyawan</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Remix Icon CDN -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <form action="{{ route('manager.absen.izin') }}" method="POST" enctype="multipart/form-data"
        class="max-w-lg w-full mt-10 mx-auto bg-white rounded-2xl shadow-lg p-6 space-y-5 border border-gray-200">
        @csrf

        <!-- Judul Form -->
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6 flex items-center justify-center gap-2">
            <i class="ri-clipboard-line text-blue-600 text-3xl"></i>
            <span>Form Izin</span>
        </h2>

        {{-- Alasan Izin --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                <i class="ri-edit-2-line mr-1 text-blue-500"></i> Alasan Izin
            </label>
            <textarea name="alasan_izin"
                class="w-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-lg p-3 text-gray-700 resize-none placeholder-gray-400"
                rows="4" placeholder="Tuliskan alasan izin Anda..." required></textarea>
        </div>

        {{-- Upload Bukti --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                <i class="ri-image-add-line mr-1 text-blue-500"></i> Upload Foto Bukti (Opsional)
            </label>

            <div id="upload-wrapper-izin"
                class="relative flex items-center justify-center w-full bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:bg-gray-100 transition overflow-hidden">

                <!-- Preview Gambar -->
                <img id="preview-image-izin"
                    class="hidden w-full h-56 object-cover rounded-lg absolute top-0 left-0 z-10 transition-all duration-300" />

                <!-- Label Upload -->
                <label for="foto_bukti_izin"
                    class="w-full h-full flex flex-col items-center justify-center py-6 cursor-pointer text-center px-3 z-0">
                    <i class="ri-upload-cloud-2-line text-gray-400 text-4xl mb-2"></i>
                    <p class="text-gray-500 text-sm">Klik atau seret foto ke sini</p>
                    <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, maksimal 2MB</p>
                </label>

                <input id="foto_bukti_izin" type="file" name="foto_bukti" class="hidden" accept="image/*">
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex flex-col sm:flex-row gap-3 pt-4">
            <button type="button" onclick="window.history.back()"
                class="w-full sm:w-1/2 flex justify-center items-center gap-2 bg-gray-500 text-white font-semibold py-2.5 rounded-lg shadow hover:bg-gray-600 active:scale-[0.98] transition-all">
                <i class="ri-arrow-left-line text-lg"></i>
                <span>Kembali</span>
            </button>

            <button type="submit"
                class="w-full sm:w-1/2 flex justify-center items-center gap-2 bg-blue-600 text-white font-semibold py-2.5 rounded-lg shadow hover:bg-blue-700 active:scale-[0.98] transition-all">
                <i class="ri-send-plane-fill text-lg"></i>
                <span>Kirim Izin</span>
            </button>
        </div>
    </form>

    <!-- Script Preview Gambar -->
    <script>
        document.getElementById('foto_bukti_izin').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview-image-izin');
            const wrapper = document.getElementById('upload-wrapper-izin');

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
