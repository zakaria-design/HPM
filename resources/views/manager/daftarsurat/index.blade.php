
@extends('manager.layouts.app')

@section('title','Daftar Surat')
{{-- menu yg active --}}
@section('menuManagerDaftarSurat','active')
{{-- memanggil livewire --}}
@section('content')
    @livewire('manager.daftarsurat.index')
@endsection

