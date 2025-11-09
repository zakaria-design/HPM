<?php

namespace App\Livewire\Admin\Presensi;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = ''; // untuk live search
    protected $paginationTheme = 'bootstrap'; // pakai bootstrap pagination

    // reset halaman saat search berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $currentMonth = Carbon::now()->month;  // bulan saat ini
        $currentYear  = Carbon::now()->year;   // tahun saat ini

        $users = User::withCount([
            'hadir as hadir_count' => function ($query) use ($currentMonth, $currentYear) {
                    $query->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear);
                        },
            'izin as izin_count' => function ($query) use ($currentMonth, $currentYear) {
                    $query->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear);
                        },
            'sakit as sakit_count' => function ($query) use ($currentMonth, $currentYear) {
                    $query->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear);
                        }
                    ])
                ->whereIn('role', ['karyawan', 'manager'])
                ->where('name', 'like', '%'.$this->search.'%')
                ->orderBy('name', 'asc')
                ->paginate(5);

        return view('livewire.admin.presensi.index', [
            'users' => $users
        ]);
    }
}