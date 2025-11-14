<!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>


{{-- sweet alert 2 --}}
<script src="{{ asset('sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

<!-- Bootstrap JS -->
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}


{{-- sweet alert 2 --}}
<script src="{{ asset('sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

<!-- Bootstrap JS -->



{{-- dark mode --}}
<script>
        function applyDarkMode() {
            const body = document.body;
            const isDark = localStorage.getItem('dark-mode') === 'true';
            body.classList.toggle('dark-mode', isDark);

            const toggle = document.getElementById('toggle-dark');
            if (toggle) {
                const icon = toggle.querySelector('i');
                if (icon) {
                    icon.classList.toggle('fa-moon', !isDark);
                    icon.classList.toggle('fa-sun', isDark);
                }
            }
        }

        // Gunakan event delegation untuk tombol global
        document.addEventListener('click', function(e) {
            const toggle = e.target.closest('#toggle-dark');
            if (!toggle) return;

            e.preventDefault();
            const body = document.body;
            const currentlyDark = body.classList.contains('dark-mode');
            body.classList.toggle('dark-mode', !currentlyDark);
            localStorage.setItem('dark-mode', !currentlyDark);

            const icon = toggle.querySelector('i');
            if (icon) {
                icon.classList.toggle('fa-moon', currentlyDark);
                icon.classList.toggle('fa-sun', !currentlyDark);
            }
        });

        // Inisialisasi saat halaman pertama dimuat
        document.addEventListener('DOMContentLoaded', applyDarkMode);

        // Inisialisasi ulang setelah Livewire navigasi (setiap halaman baru)
        document.addEventListener('livewire:navigated', applyDarkMode);
</script>





