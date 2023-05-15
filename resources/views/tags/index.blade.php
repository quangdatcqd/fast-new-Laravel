@extends('layouts.app')
@section('page-tilte', 'Danh sách các thẻ')
@section('active-tag', 'active')
@section('content')

    <div class="card">
        <div class="d-flex align-items-center  ">
            <h5 class="card-header">Danh sách các thẻ</h5>
            <a href="{{ route('tags.create') }}" class="btn btn-primary d-flex align-items-center ">
                <i class='bx bx-plus'></i> &nbsp;
                Thêm
            </a>

            <div class="pe-4 d-flex align-items-center "> {{ $data->links('vendor.pagination.bootstrap-4') }}</div>
        </div>

        <div class="table-responsive text-nowrap  table-custom-scroll-bar">
            <table class="table ">
                <thead>
                    <tr class="text-center bg-table-header">
                        <th width="35px">#</th>
                        <th>Tên</th>
                        <th>Slug</th>
                        <th>Thay đổi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0 text-dark" id="table-tbody">
                    @foreach ($data as $tag)
                        <tr class="text-center">
                            <td>{{ $loop->index }}</td>
                            <td>{{ $tag->title }}</td>
                            <td>{{ $tag->slug }}</td>

                            <td>
                                <div class="div-edit-delete">
                                    <p class=" btn-delete items-center m-0"
                                        route="{{ route('tags.delete', ['id' => $tag->id]) }}">
                                        <i class="bx bx-trash" style="font-size: 16pt"></i> Xoá
                                    </p>

                                    <p class="items-center m-0 btn-preview">
                                        <a href="{{ route('tags.edit', ['id' => $tag->id]) }}" class="    py-1"
                                            id-post="{{ $tag->id }}">
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
        <div class="ps-4 mt-2"> {{ $data->links('vendor.pagination.bootstrap-4') }}</div>
    </div>

@endsection
