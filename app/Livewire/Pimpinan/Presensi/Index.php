<?php

namespace App\Livewire\Pimpinan\Presensi;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Hadir;
use Livewire\Component;

class Index extends Component
{
    public $belumAbsen;
    public $hadir;
    public $izin;
    public $sakit;

    public $selectedUser = null; // Untuk modal
    public $hadirDetail = [];
    public $presensiDetail = [];    // Data presensi sesuai tipe
    public $presensiType = '';       // Detail hadir

    public function mount()
    {
        $today = Carbon::today();

        // Belum presensi
        $this->belumAbsen = User::where('role', 'karyawan')
            ->whereDoesntHave('hadir', fn($q) => $q->whereDate('created_at', $today))
            ->whereDoesntHave('izin', fn($q) => $q->whereDate('created_at', $today))
            ->whereDoesntHave('sakit', fn($q) => $q->whereDate('created_at', $today))
            ->get();

        // Sudah hadir
                $this->hadir = User::where('role', 'karyawan')
            ->whereHas('hadir', fn($q) => $q->whereDate('created_at', Carbon::today()))
            ->with(['hadir' => fn($q) => $q->whereDate('created_at', Carbon::today())])
            ->get();


        // Sudah izin
        $this->izin = User::where('role', 'karyawan')
            ->whereHas('izin', fn($q) => $q->whereDate('created_at', Carbon::today()))
            ->with('izin', fn($q) => $q->whereDate('created_at', Carbon::today()))
            ->get();

        // Sudah sakit
        $this->sakit = User::where('role', 'karyawan')
            ->whereHas('sakit', fn($q) => $q->whereDate('created_at', $today))
            ->get();
    }

    public function showPresensiDetail($userId, $type)
{
    $this->selectedUser = User::find($userId);
    $this->presensiType = $type;

    if ($this->selectedUser) {
        $today = \Carbon\Carbon::today();

        switch ($type) {
            case 'hadir':
                $this->presensiDetail = $this->selectedUser->hadir()->whereDate('created_at', $today)->get();
                break;

            case 'izin':
                $this->presensiDetail = $this->selectedUser->izin()->whereDate('created_at', $today)->get();
                break;

            case 'sakit':
                $this->presensiDetail = $this->selectedUser->sakit()->whereDate('created_at', $today)->get();
                break;
        }
    }
}


    public function closeModal()
    {
        $this->selectedUser = null;
        $this->hadirDetail = [];
    }

    public function render()
    {
        return view('livewire.pimpinan.presensi.index', [
            'users' => $this->belumAbsen,
            'hadir' => $this->hadir,
            'izin' => $this->izin,
            'sakit' => $this->sakit,
        ]);
    }
}