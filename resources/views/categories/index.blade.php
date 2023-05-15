@extends('layouts.app')
@section('page-tilte', 'Danh sách danh mục')
@section('active-category', 'active')
@section('content')

    <div class="card">
        <div class="d-flex align-items-center  ">
            <h5 class="card-header">Danh sách danh mục</h5>
            <a href="{{ route('categories.create') }}" class="btn btn-primary d-flex align-items-center ">
                <i class='bx bx-plus'></i> &nbsp;
                Thêm
            </a>
            <a href="{{ route('categories.reorder') }}" class="btn btn-outline-secondary d-flex align-items-center ms-3 ">
                <i class='bx bx-move'></i> &nbsp;
                Sửa vị trí
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
                        <th>Danh mục cha</th>
                        <th>Bài đăng</th>
                        <th>Trạng thái</th>
                        <th>Thời gian</th>
                        <th>Thay đổi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0 text-dark" id="table-tbody">
                    @foreach ($data as $category)
                        <tr class="text-center">
                            <td>{{ $loop->index }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td class="  text-uppercase ">
                                {{ $parents->where('id', $category->parent_id)->first()->name ?? '-' }}
                            </td>
                            <td>
                                <a href="{{ route('posts.list-category', ['id' => $category->id]) }} ">

                                    @if ($category->parent_id)
                                        {{ $category->post->count() > 0 ? $category->post->count() : '0' }}
                                    @elseif ($category->posts)
                                        {{ $category->posts->count() > 0 ? $category->posts->count() : '0' }}
                                    @endif
                                    bài
                                </a>
                            </td>
                            <td>{{ $category->hide ? 'Đang ẩn' : 'Đang hiện' }} </td>
                            <td class="td-time">
                                <p class="m-0">Tạo: {{ $category->created_at }}</p>
                                <p class="m-0">Sửa: {{ $category->updated_at }}</p>
                            </td>
                            <td>
                                <div class="div-edit-delete">
                                    <p class=" btn-delete items-center m-0"
                                        route="{{ route('categories.delete', ['id' => $category->id]) }}">
                                        <i class="bx bx-trash" style="font-size: 16pt"></i> Xoá
                                    </p>

                                    <p class="items-center m-0 btn-preview">
                                        <a href="{{ route('categories.edit', ['id' => $category->id]) }}" class="    py-1"
                                            id-post="{{ $category->id }}">
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
