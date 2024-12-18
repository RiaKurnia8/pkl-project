@extends('userlay.user')

@section('title','pengembalian')

@section('content')

<!-- Tampilkan Notifikasi Jika Data Berhasil Disimpan -->
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="mb-3 mt-2">
    <a href="{{ url()->previous() }}" class="text-danger">
        <i class="fa-solid fa-arrow-left-long"></i></a>
        <h2 style="text-align: center;">Pengembalian Barang</h2>

{{-- <div class="container">
    <h1 class="text-danger">Pengembalian Barang</h1> --}}

    <!-- Form pengembalian -->
    <form action="upengembalian" method="POST">
        @csrf
        <input type="hidden" name="redirect_url" value="{{ url()->previous() }}">

        {{-- <div class="form-group">
            <label for="id">ID Barang :</label>
            <input type="text" class="form-control" id="id" name="id" value="{{ Auth::user()->id }}" readonly>
        </div> --}}
        <div class="form-group">
            <label for="id">ID :</label>
            <input type="text" class="form-control" id="id" name="id" value="{{ $idBarang }}" readonly>
        </div>
        <!-- NIK Input -->
        <div class="form-group">
            <label for="nik">NIK :</label>
            <input type="text" class="form-control" id="nik" name="nik" value="{{ Auth::user()->nik }}" readonly>
        </div>


        <!-- Name Input -->
        <div class="form-group">
            <label for="name">Nama :</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" readonly>
        </div>

        <!-- Plant Input -->
        <div class="form-group">
            <label for="plant">Plant :</label>
            <input type="text" class="form-control" id="plant" name="plant" value="{{ Auth::user()->plant->plant ??  'Plant tidak ditemukan'}}" readonly>
        </div>


        <div class="form-group">
            <label for="barang">Barang pengembalian :</label>
            <input type="text" class="form-control" id="barang" name="barang" value="{{ $barang }}" readonly>
        </div>

        <div class="form-group">
            <label for="tanggal_pengembalian">Tanggal Pengembalian :</label>
            <input 
                type="date" 
                class="form-control" 
                id="tanggal_pengembalian" 
                name="tanggal_pengembalian" 
                value="{{ date('Y-m-d') }}" 
                readonly 
                required
            >
        </div>
        <script>
            // Ambil elemen input
            const tanggalInput = document.getElementById('tanggal_pengembalian');
            
            // Dapatkan tanggal hari ini
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0'); // Bulan mulai dari 0
            const dd = String(today.getDate()).padStart(2, '0');
        
            // Formatkan tanggal dan set nilai
            tanggalInput.value = `${yyyy}-${mm}-${dd}`;
        </script>

         <div class="form-group">
            <label for="keperluan">Catatan :</label>
            <textarea class="form-control" id="keperluan" name="keperluan" rows="5" required></textarea>
        </div>

        <!-- Tombol Back dan Save -->
        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-success">SAVE</button>
        </div>
    </form>
</div>

@endsection
