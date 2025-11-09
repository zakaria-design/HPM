@extends('manager.layouts.app')

@section('title','Pengajuan Surat')
{{-- menu yg active --}}
@section('menuManagerPengajuan','active')
{{-- memanggil livewire --}}
@section('content')
    @livewire('manager.pengajuan.index')
@endsection
