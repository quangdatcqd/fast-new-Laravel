@extends('layouts.app')
@section('page-tilte', 'Tạo mới người dùng')
@section('active-user', 'active')
@section('content')

    <div class="card">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-header">Tạo mới người dùng</h5>
        </div>

        <div class="col-md-12 mx-auto">
            <div class="card mb-4">

                <div class="card-body demo-vertical-spacing demo-only-element">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
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
                                <input type="text" class="form-control  @error('email') is-invalid @enderror"
                                    name="email" placeholder="Nhập Email">

                            </div>
                        </div>

                        <div class="form-password-toggle">
                            <label class="form-label" for="basic-default-password12">Mật khẩu</label>
                            <div class="input-group">
                                <input type="text" class="form-control  @error('password') is-invalid @enderror"
                                    name="password" id="basic-default-password12" placeholder="Nhập mật khẩu">

                            </div>
                        </div>
                        <div class="form-password-toggle">
                            <label class="form-label" for="basic-default-password12">Nhập lại mật khẩu</label>
                            <div class="input-group">
                                <input type="text"
                                    class="form-control  @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" id="basic-default-password12"
                                    placeholder="Nhập lại mật khẩu">

                            </div>
                        </div>
                        <label class="form-label" for="drole">Role </label>
                        <div class="row ps-3">
                            @foreach ($roles as $role)
                                <div class="form-check col-3 ">
                                    <input name="role" class="form-check-input" type="radio"
                                        value="{{ $role->id }}" {{ $loop->index == 0 ? 'checked' : '' }}
                                        id="role{{ $role->id }}">
                                    <label class="form-check-label" for="role{{ $role->id }}">{{ $role->name }}
                                    </label>
                                </div>
                            @endforeach

                        </div>
                        <label class="form-label" for="drole">Permissions </label>
                        <div class="row  ">
                            @foreach ($permissions as $permission)
                                <div class="form-check col-3 ">
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" name="permission[]" multiple type="checkbox"
                                            value="{{ $permission->id }}" id="permission{{ $permission->id }}">
                                        <label class="form-check-label" for="permission{{ $permission->id }}">
                                            {{ $permission->name }} </label>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <br>
                        <div class="row justify-content-start">
                            <div class="col-md-6 d-flex">
                                <button type="submit" class="btn btn-primary d-flex align-items-center px-5"> <i
                                        class='bx bx-plus'></i>&nbsp; Thêm</button>
                                <a href="{{ route('users.list') }}"3
                                    class="btn btn-outline-secondary d-flex align-items-center  ms-3  ">
                                    <i class='bx bx-x'></i> &nbsp;
                                    Huỷ bỏ
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection
