@extends('layouts.admin')

@section('title', 'Tambah Plant')

@section('content')
<div class="mb-3 mt-2">
    <a href="{{ url()->previous() }}" class="text-danger">
        <i class="fa-solid fa-arrow-left-long"></i></a>
</div>

    <div class="container">
        <h2 style="text-align: center;">Tambah Plant</h2>
        <form action="{{ route('admin.plant.store') }}" method="POST">
            @csrf

            
                <div class="mb-3">
                    <label for="plant" class="form-label">Plant</label>
                    <input type="text" class="form-control @error('plant') is-invalid @enderror" name="plant"
                        id="plant" placeholder="Masukkan nama plant">
                    @error('plant')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kolom Status -->
                <div class="form-group mb-4">
                    <label>Status</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="status_on" value="on" checked>
                        <label class="form-check-label" for="status_on">On</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="status_off" value="off">
                        <label class="form-check-label" for="status_off">Off</label>
                    </div>
                </div>

                <div class="mb-3">
                    {{-- <a href="{{ url()->previous() }}" class="btn btn-danger">Kembali</a> --}}
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
        </form>
    </div>

@endsection
