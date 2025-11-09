<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Presensi Hadir</title>

  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-50 to-gray-100 flex flex-col items-center justify-center min-h-screen">

 <!-- Card Awal -->
<div id="cardAwal" 
  class="relative text-center bg-gradient-to-br from-blue-50 to-white shadow-2xl rounded-3xl 
         p-8 w-full max-w-md border border-blue-100 flex flex-col justify-center items-center
         transition-all duration-300 h-[480px] mx-auto">

  <!-- Tombol Kembali -->
  <a href="{{ route('manager.presensi.index') }}" 
     class="absolute top-4 left-4 inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600 transition-all">
    <i class="ri-arrow-left-line mr-1"></i> Kembali
  </a>

  <!-- Icon Kamera -->
  <div class="flex justify-center items-center mb-4">
    <div class="w-24 h-24 rounded-full bg-blue-100 flex items-center justify-center shadow-inner">
      <i class="ri-camera-line text-6xl text-blue-600 animate-pulse"></i>
    </div>
  </div>

  <!-- Judul -->
  <h2 class="text-2xl font-bold text-gray-800 mb-2 tracking-wide">Presensi Hadir</h2>
  <p class="text-gray-500 mb-8 text-sm">Tekan tombol di bawah untuk mengaktifkan kamera depan</p>

  <!-- Tombol Aktifkan Kamera -->
  <button onclick="mulaiKamera()" 
    class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 
           text-white font-semibold px-8 py-3 rounded-xl shadow-lg transition-all active:scale-[0.97]">
    <i class="ri-play-circle-line mr-1"></i> Aktifkan Kamera
  </button>
</div>


<!-- Frame Kamera -->
<div id="cardKamera"
  class="hidden text-center bg-white shadow-xl rounded-2xl p-8 max-w-sm w-full transition-all h-[480px] flex flex-col justify-center items-center border border-blue-100">
  
  <h2 class="text-lg font-semibold mb-2">Kamera Aktif</h2>
  <p class="text-gray-500 mb-4">Pastikan wajah terlihat jelas sebelum mengambil gambar</p>

  <!-- Video Preview -->
  <div class="relative w-full aspect-[4/3] mb-6 rounded-xl overflow-hidden border border-gray-200 shadow-inner">
    <video id="video" class="absolute inset-0 w-full h-full object-cover" autoplay playsinline></video>
  </div>

  <!-- Tombol -->
  <div class="flex flex-col sm:flex-row justify-center gap-3 w-full">
    <button onclick="ambilFoto()" 
      class="flex justify-center items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold 
      px-5 py-2 rounded-xl active:scale-[0.97] transition-all w-full sm:w-auto text-sm sm:text-base">
      <i class="ri-camera-fill text-lg sm:text-base"></i> Ambil Gambar
    </button>
    <button onclick="batalKamera()" 
      class="flex justify-center items-center gap-2 bg-gray-400 hover:bg-gray-500 text-white font-semibold 
      px-5 py-2 rounded-xl active:scale-[0.97] transition-all w-full sm:w-auto text-sm sm:text-base">
      <i class="ri-arrow-go-back-line text-lg sm:text-base"></i> Kembali
    </button>
  </div>
</div>



  <!-- Frame Preview -->
  <div id="cardPreview" class="hidden text-center bg-white shadow-xl rounded-2xl p-5 max-w-md w-full">
    <img id="fotoPreview" src="" alt="Preview" class="rounded-xl mb-3 shadow-md w-full">
    <div class="text-left bg-gray-50 p-3 rounded-lg mb-3 shadow">
      <p><strong>Alamat:</strong> <span id="alamatText">Menunggu lokasi...</span></p>
      <p><strong>Koordinat:</strong> <span id="koordinatText">--, --</span></p>
      <p><strong>Waktu:</strong> <span id="jamText">--:--:--</span></p>
    </div>
    <div class="flex justify-center gap-3">
      <button onclick="ulangAmbil()" 
        class="flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold px-5 py-2 rounded-xl active:scale-[0.97]">
        <i class="ri-refresh-line"></i> Ulangi
      </button>
      <button onclick="kirimAbsen()" 
        class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded-xl active:scale-[0.97]">
        <i class="ri-send-plane-2-line"></i> Kirim
      </button>
    </div>
  </div>

  <!-- Form kirim -->
  <form id="formAbsen" action="{{ route('manager.absen.store') }}" method="POST" enctype="multipart/form-data" class="hidden">
    @csrf
    <input type="hidden" name="foto" id="fotoInput">
    <input type="hidden" name="latitude" id="latInput">
    <input type="hidden" name="longitude" id="longInput">
    <input type="hidden" name="alamat" id="alamatInput">
  </form>

  <script>
    const video = document.getElementById('video');
    const fotoPreview = document.getElementById('fotoPreview');
    const cardAwal = document.getElementById('cardAwal');
    const cardKamera = document.getElementById('cardKamera');
    const cardPreview = document.getElementById('cardPreview');
    const canvas = document.createElement('canvas');

    const alamatText = document.getElementById('alamatText');
    const koordinatText = document.getElementById('koordinatText');
    const jamText = document.getElementById('jamText');

    let stream = null;

    async function mulaiKamera() {
      try {
        stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: "user" } });
        video.srcObject = stream;
        cardAwal.classList.add('hidden');
        cardKamera.classList.remove('hidden');
      } catch (err) {
        alert("Gagal mengakses kamera: " + err);
      }
    }

    function ambilFoto() {
      // Ambil gambar
      canvas.width = video.videoWidth;
      canvas.height = video.videoHeight;
      canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
      const dataURL = canvas.toDataURL('image/png');
      fotoPreview.src = dataURL;
      document.getElementById('fotoInput').value = dataURL;

      // Ambil jam (format 24 jam zona Asia/Jakarta)
      const options = { timeZone: 'Asia/Jakarta', hour12: false, hour: '2-digit', minute: '2-digit', second: '2-digit' };
      jamText.textContent = new Date().toLocaleTimeString('id-ID', options);

      // Ambil lokasi GPS
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(async pos => {
          const lat = pos.coords.latitude;
          const lon = pos.coords.longitude;
          koordinatText.textContent = `${lat.toFixed(5)}, ${lon.toFixed(5)}`;
          document.getElementById('latInput').value = lat;
          document.getElementById('longInput').value = lon;

          // Ambil alamat via OpenStreetMap API
          try {
            const res = await fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`, {
                          headers: { 'User-Agent': 'MyAppPresensi/1.0 (contact@example.com)' }
                        });
            const alamat = data.display_name || 'Alamat tidak ditemukan';
            alamatText.textContent = alamat;
            document.getElementById('alamatInput').value = alamat;
          } catch {
            alamatText.textContent = 'Gagal mengambil alamat.';
          }
        }, () => {
          alamatText.textContent = 'Tidak dapat mengambil lokasi GPS.';
        });
      } else {
        alamatText.textContent = 'GPS tidak didukung di perangkat ini.';
      }

      // Tampilkan preview
      cardKamera.classList.add('hidden');
      cardPreview.classList.remove('hidden');
    }

    function ulangAmbil() {
      cardPreview.classList.add('hidden');
      cardKamera.classList.remove('hidden');
    }

    function batalKamera() {
      if (stream) {
        stream.getTracks().forEach(t => t.stop());
      }
      cardKamera.classList.add('hidden');
      cardAwal.classList.remove('hidden');
    }

    function kirimAbsen() {
      document.getElementById('formAbsen').submit();
    }
  </script>
</body>
</html>
