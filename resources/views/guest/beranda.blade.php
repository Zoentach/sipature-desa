@extends('guest.app')

@section('title', 'Beranda')

@section('content')

<div class="max-w-md w-full mx-auto">
    <img class="w-60 h-60 mx-auto my-4" src="{{ asset('images/app_logo.png') }}" alt="Logo"/>

    <form class="mx-auto my-4">
        <div class="relative">
            <input type="search"
                   class="block w-full p-4 ps-10 text-sm border rounded-lg"
                   placeholder="Ketik nama Desa"/>
        </div>
    </form>

    <div class="flex justify-center">
        <a href="{{ route('desa.daftar') }}">
            <button class="bg-blue-700 text-white px-5 py-2.5 rounded-lg">
                Lihat Daftar
            </button>
        </a>
    </div>
</div>

@endsection
