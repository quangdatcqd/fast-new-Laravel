@extends('layouts.app')
@section('page-tilte', $title)
@section('active-user', 'active')
@section('content')

    <div class="card">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-header">{{ $title }}</h5>
        </div>

        <div class="col-md-6 mx-auto">
            <div class="card mb-4">

                <div class="card-body demo-vertical-spacing demo-only-element">
                    <div class="input-group">
                        <label class="form-label" for="basic-default-password12">Tên</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" autofocus
                                name="name" placeholder="Nhập Tên">

                        </div>
                    </div>
                    <div class="input-group">
                        <label class="form-label" for="basic-default-password12">Email</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="email" placeholder="Nhập Email">

                        </div>
                    </div>
                    <div class="form-password-toggle">
                        <label class="form-label" for="basic-default-password12">Mật khẩu</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="password" id="basic-default-password12"
                                placeholder="Nhập mật khẩu">

                        </div>
                    </div>
                    <div class="form-password-toggle">
                        <label class="form-label" for="basic-default-password12">Nhập lại mật khẩu</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="password_confirmation"
                                id="basic-default-password12" placeholder="Nhập lại mật khẩu">

                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="defaultSelect" class="form-label">Trạng thái</label>
                        <select id="defaultSelect" class="form-select">
                            @foreach ($data as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row justify-content-start">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary d-flex align-items-center"> <i
                                    class='bx bx-plus-circle'></i> Thêm</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
