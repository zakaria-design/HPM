@extends('manager.layouts.app')

@section('title','Update Surat')
{{-- menu yg active --}}
@section('menuManagerUpdateSurat','active')
{{-- memanggil livewire --}}
@section('content')
    @livewire('manager.updatesurat.index')
@endsection
