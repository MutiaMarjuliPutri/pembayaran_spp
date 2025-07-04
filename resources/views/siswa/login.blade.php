@extends('template')

@section('content')
<div class="container mt-5">
    <h3>Login Siswa</h3>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('siswa.login') }}">
        @csrf
        <div class="mb-3">
            <label for="nisn">NISN</label>
            <input type="text" name="nisn" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
@endsection
