@extends('layouts.app')
@section('page-tilte', 'Danh sách người dùng')
@section('active-user', 'active')
@section('content')

    <div class="card">
        <div class="d-flex align-items-center  ">
            <h5 class="card-header">Danh sách người dùng</h5>
            <a href="{{ route('users.create') }}" class="btn btn-primary d-flex align-items-center ">
                <i class='bx bx-plus'></i> &nbsp;
                Thêm
            </a>
            <div class="pe-4 d-flex align-items-center "> {{ $users->links('vendor.pagination.bootstrap-4') }}</div>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-center bg-table-header">
                        <th width="35px">ID</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Các quyền</th>
                        <th>Thời gian</th>
                        <th>Sửa</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0 " id="table-tbody">

                    @foreach ($users as $user)
                        <tr class="text-center">
                            <td class="text-center">{{ $loop->index }}</td>
                            <td>{{ $user->name }}</td>
                            <td> {{ $user->email }} </td>
                            <td> {{ $user->role->name }} </td>
                            <td class="text-wrap">{{ implode(', ', $user->permissions->pluck('name')->toArray()) }} </td>

                            <td class="td-time">
                                <p class="m-0">Tạo: {{ $user->created_at }}</p>
                                <p class="m-0">Sửa: {{ $user->updated_at }}</p>
                            </td>

                            <td>
                                <div class="div-edit-delete">
                                    {{-- <button type="button" class="btn btn-update-l ">
                                        <i class='bx bx-edit-alt' style="font-size: 16pt"></i>
                                    </button> --}}

                                    <p class=" btn-delete items-center m-0"
                                        route="{{ route('users.delete', ['id' => $user->id]) }}">
                                        <i class="bx bx-trash" style="font-size: 16pt"></i> Xoá
                                    </p>
                                    <p class="items-center m-0 btn-preview">
                                        <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="py-1">
                                            <i class='bx bx-edit'></i>
                                            Sửa
                                        </a>
                                    </p>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="ps-4 mt-2"> {{ $users->links('vendor.pagination.bootstrap-4') }}</div>
    </div>

@endsection
