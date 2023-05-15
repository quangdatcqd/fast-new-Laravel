@extends('layouts.app')
@section('page-tilte', 'Danh sách người dùng')
@section('active-user', 'active')
@section('content')

    <div class="card">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-header">Danh sách người dùng</h5>
            {{-- <a href="{{ route('users.create') }}" class="btn btn-success d-flex align-items-center ">
                <i class='bx bx-plus-circle'></i>
                Thêm
            </a> --}}
            <div class="pe-4 d-flex align-items-center "> {{ $data->links('vendor.pagination.bootstrap-4') }}</div>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-center bg-table-header">
                        <th width="35px">ID</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Trạng thái</th>
                        <th>Thời gian</th>
                        <th>Sửa</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0 " id="table-tbody">
                    @foreach ($data as $user)
                        <tr class="text-center">
                            <td class="text-center">{{ $loop->index }}</td>
                            <td>{{ $user->name }}</td>
                            <td> {{ $user->email }} </td>
                            <td>
                                <select id="defaultSelect" id-user={{ $user->id_user }}
                                    class="form-select text-center cursor-pointer select-status">
                                    @foreach ($data_status as $status_item)
                                        <option @if ($status_item->id == $user->id_tatus) selected @endif
                                            value="{{ $status_item->id }}">
                                            {{ $status_item->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="td-time">
                                <p class="m-0">Tạo: {{ $user->created_at }}</p>
                                <p class="m-0">Sửa: {{ $user->updated_at }}</p>
                            </td>

                            <td>
                                <div class="div-edit-delete">
                                    {{-- <button type="button" class="btn btn-update-l ">
                                        <i class='bx bx-edit-alt' style="font-size: 16pt"></i>
                                    </button> --}}
                                    <button type="button" class="btn btn-primary    py-1   btn-update-l"
                                        id-user="{{ $user->id_user }}"> <i class='bx bx-save'></i>Lưu</button>
                                    <p class=" btn-delete items-center m-0"
                                        route="{{ route('users.delete', ['id' => $user->id_user]) }}">
                                        <i class="bx bx-trash" style="font-size: 16pt"></i> Xoá
                                    </p>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="ps-4 mt-2"> {{ $data->links('vendor.pagination.bootstrap-4') }}</div>
    </div>

@endsection
