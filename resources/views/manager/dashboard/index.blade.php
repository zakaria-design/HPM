
@extends('manager.layouts.app')

@section('title','Dashboard')
{{-- menu yg active --}}
@section('menuManagerDashboard','active')
{{-- memanggil livewire --}}
@section('content')
    @livewire('manager.dashboard.index')
@endsection

