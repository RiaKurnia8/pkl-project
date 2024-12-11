@extends('layouts.admin')

@section('title', 'Edit Plant')

@section('content')

<div class="mb-3 mt-2">
    <a href="{{ url()->previous() }}" class="text-danger">
        <i class="fa-solid fa-arrow-left-long"></i></a>
</div>

    <div class="container">
        <h2 style="text-align: center;">Edit Plant</h2>

@if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.plant.update', $plant->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="plant">Plant</label>
            <input type="text" name="plant" id="plant" class="form-control @error('plant') is-invalid @enderror" value="{{ old('plant', $plant->plant) }}">
            @error('plant')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Kolom Status -->
        <div class="form-group mb-4">
            <label>Status</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="status_on" value="on" {{ $plant->status == 'on' ? 'checked' : '' }}>
                <label class="form-check-label" for="status_on">On</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="status_off" value="off" {{ $plant->status == 'off' ? 'checked' : '' }}>
                <label class="form-check-label" for="status_off">Off</label>
            </div>
        </div>
           
        <button type="submit" class="btn btn-danger">Update</button>
         <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
    </form>

@endsection