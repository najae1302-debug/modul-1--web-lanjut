@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Selamat Datang, {{ Auth::user()->name }}!</h1>
                
                <!-- Statistik -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-blue-100 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-blue-800">Total Mahasiswa</h3>
                        <p class="text-3xl font-bold text-blue-600">{{ $totalMahasiswa }}</p>
                        <a href="{{ route('mahasiswa.index') }}" class="text-blue-700 hover:underline mt-2 inline-block">Lihat Semua →</a>
                    </div>
                    <div class="bg-green-100 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-green-800">Total Mata Kuliah</h3>
                        <p class="text-3xl font-bold text-green-600">{{ $totalMatakuliah }}</p>
                        <a href="{{ route('matakuliah.index') }}" class="text-green-700 hover:underline mt-2 inline-block">Lihat Semua →</a>
                    </div>
                </div>

                <!-- Mahasiswa Terbaru -->
                <h3 class="text-lg font-semibold mt-8 mb-4">Mahasiswa Terbaru</h3>
                
                @if($latestMahasiswa->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2 text-left">#</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">NIM</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Nama</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestMahasiswa as $index => $mhs)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $mhs->nim }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $mhs->nama }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $mhs->kelas }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">Belum ada data mahasiswa</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection