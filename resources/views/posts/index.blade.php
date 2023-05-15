@extends('layouts.app')
@section('page-tilte', 'Danh sách bài đăng')
@section('active-post', 'active')
@section('content')

    <div class="card">
        <div class="d-flex align-items-center  ">
            <h5 class="card-header">Danh sách bài đăng</h5>
            <a href="{{ route('posts.create') }}" class="btn btn-primary d-flex align-items-center ">
                <i class='bx bx-plus'></i> &nbsp;
                Thêm
            </a>
            <div class="pe-4 d-flex align-items-center "> {{ $data->links('vendor.pagination.bootstrap-4') }}</div>
        </div>
        @if (isset($category))
            <div class="d-flex align-items-center ms-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);"> {{ $category->parentCategory->name }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);"> {{ $category->name }}</a>
                        </li>
                    </ol>
                </nav>

            </div>
        @endif
        <div class="table-responsive text-nowrap  table-custom-scroll-bar">
            <table class="table " style="width: 130%">
                <thead>
                    <tr class="text-center bg-table-header">
                        <th width="35px">#</th>
                        <th>Tác giả</th>
                        <th>Danh mục</th>
                        <th>Tiêu đề</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th>Thời gian</th>
                        <th>Thay đổi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0 " id="table-tbody">
                    @foreach ($data as $post)
                        <tr class="text-center">
                            <td class="text-center">{{ $loop->index }}</td>
                            <td style=" width:165px;">{{ $post->user_name }}</td>
                            <td>{{ $post->category_name }}</td>
                            <td class="text-wrap text-start " style="  width:250px;   ">
                                {{ $post->title }} </td>
                            <td class="text-wrap text-start">
                                {{ $post->description }}
                            </td>
                            <td style=" width:125px;">{{ $post->hide ? 'Đang ẩn' : 'Đang hiện' }} </td>
                            <td class="td-time" style=" width:165px;">
                                <p class="m-0">Tạo: {{ $post->post_created_at }}</p>
                                <p class="m-0">Sửa: {{ $post->post_updated_at }}</p>
                            </td>
                            <td style=" width:160px; ">
                                <div class="div-edit-delete" style="min-height:10px">


                                    <p class=" btn-delete items-center m-0"
                                        route="{{ route('posts.delete', ['id' => $post->post_id]) }}">
                                        <i class="bx bx-trash" style="font-size: 16pt"></i> Xoá
                                    </p>

                                    <p class="items-center m-0 btn-preview">
                                        <a href="{{ route('posts.edit', ['id' => $post->post_id]) }} " class="    py-1"
                                            id-post="{{ $post->post_id }}">
                                            <i class='bx bx-show'></i>
                                            Chi tiết
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
