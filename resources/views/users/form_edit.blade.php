@extends('layouts.app')
@section('page-tilte', 'Cập nhật người dùng')
@section('active-user', 'active')
@section('content')

    <div class="card">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-header">Cập nhật người dùng</h5>
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
                    <form action="{{ route('users.update', ['id' => $user->id]) }}" method="post">
                        @csrf
                        <div class="input-group mb-2">
                            <label class="form-label" for="basic-default-password12">Tên</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" autofocus
                                    name="name" value="{{ old('name') ? old('name') : $user->name }}"
                                    placeholder="Nhập Tên">

                            </div>
                        </div>
                        <div class="input-group mb-2">
                            <label class="form-label" for="basic-default-password12">Email</label>
                            <div class="input-group">
                                <input type="text" class="form-control  @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') ? old('email') : $user->email }}"
                                    placeholder="Nhập Email">

                            </div>
                        </div>

                        <div class="form-password-toggle mb-2">
                            <label class="form-label" for="basic-default-password12">Không cần thiết cập nhật</label>
                            <label class="form-label" for="password">Mật khẩu</label>
                            <div class="input-group">
                                <input type="text" class="form-control  @error('password') is-invalid @enderror"
                                    name="password" id="password" value="{{ old('password') }}"
                                    placeholder="Nhập mật khẩu">

                            </div>
                        </div>
                        <div class="form-password-toggle mb-2">
                            <label class="form-label" for="password_confirmation">Nhập lại mật khẩu</label>
                            <div class="input-group">
                                <input type="text"
                                    class="form-control  @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" id="password_confirmation"
                                    value="{{ old('password_confirmation') }}" placeholder="Nhập lại mật khẩu">

                            </div>
                        </div>
                        <label class="form-label" for="drole">Role </label>
                        <div class="row ps-3 mb-2">
                            @foreach ($roles as $role)
                                <div class="form-check col-3 ">
                                    <input name="role" class="form-check-input" type="radio"
                                        value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'checked' : '' }}
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
                                            value="{{ $permission->id }}"
                                            {{ in_array($permission->id,$user->permissions()->pluck('id')->toArray())? 'checked': '' }}
                                            id="permission{{ $permission->id }}">
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
                                        class='bx bx-save'></i>&nbsp; Lưu</button>
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
