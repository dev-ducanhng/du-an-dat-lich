@extends('layouts.dashboard')
@section('content')
    <main>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4">Thêm chức vụ</h5>

                <form id="exampleFormTopLabels" class="tooltip-right-bottom" method="POST">
                    @csrf
                    <div class="form-group has-float-label">
                        <span>Chức vụ</span>
                        <input class="form-control @error('name') is-invalid @enderror" name="name"/>
                        @error('name')
                        <p class="text-danger mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">Thêm chức vụ</button>
                </form>
            </div>
        </div>
    </main>
@endsection
