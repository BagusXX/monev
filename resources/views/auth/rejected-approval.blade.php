@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <div class="text-6xl mb-4">❌</div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Akun Ditolak
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Hubungi Admin untuk Kontak
            </p>
        </div>

        <div class="rounded-md bg-red-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">
                        Akun Anda telah ditolak. Silakan hubungi administrator untuk informasi lebih lanjut.
                    </h3>
                </div>
            </div>
        </div>

        <div class="bg-white px-4 py-5 border border-gray-200 rounded-lg sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
                Email Admin Utama
            </dt>
            <dd class="mt-1 text-sm text-gray-900">
                admin@gmail.com
            </dd>
        </div>

        <div class="flex gap-3">
            <form action="{{ route('logout') }}" method="POST" class="flex-1">
                @csrf
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Keluar
                </button>
            </form>
            <a href="javascript:history.back()" class="flex-1 flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
