@extends('layouts.app')
@section('page-tilte', 'Thêm bài đăng')
@section('active-post', 'active')
@section('content')

    <div class="card">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-header">Thêm bài đăng</h5>
        </div>

        <div class="col-12 mx-auto">
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
                    <form action="{{ route('posts.store') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <label class="form-label" for="title">Tiêu đề bài đăng</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" autofocus
                                    name="title" id="title_slug" placeholder="Nhập tiêu đề">

                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="form-label" for="slug">Slug (URL)</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                    name="slug" id="slug" placeholder="Nhập slug url">

                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="form-label" for="description">Giới thiệu ngắn</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="description" id="description"
                                    placeholder="Nhập phần giới thiệu">

                            </div>
                        </div>
                        <div class="form-password-toggle mb-3">
                            <label class="form-label" for="content">Nội dung</label>

                            <textarea name="content" id="content">  </textarea>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-6">


                                <label class="form-label" for="hide">Hiển thị bài viết</label>
                                <div class="form-check mt-3">
                                    <input name="hide" checked="" class="form-check-input" type="radio"
                                        value="0" id="hide">
                                    <label class="form-check-label" for="hide"> Cho hiển thị </label>
                                </div>
                                <div class="form-check">
                                    <input name="hide" class="form-check-input" type="radio" value="1"
                                        id="hide1">
                                    <label class="form-check-label" for="hide1"> Cho ẩn </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <label class="form-label" for="sort">Thứ tự hiển thị</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="sort" id="sort" value="1" placeholder="Thứ tự">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label class="form-label  " for="sort">Chọn thẻ </label>
                                <label class="form-label cursor-pointer text-primary " data-bs-toggle="modal"
                                    data-bs-target="#smallModal"><i class='bx bx-plus'></i> Tạo
                                    mới </label>
                            </div>
                            <select class="js-example-basic-single form-select select-search" multiple="multiple"
                                name="tags[]"> </select>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Danh mục</label>
                            <select id="category" name="category" class="form-select">
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row  ">
                            <div class="col-md-6 d-flex">
                                <button type="submit" class="btn btn-primary d-flex align-items-center px-5"> <i
                                        class='bx bx-plus'></i> &nbsp; Thêm</button>
                                <a href="{{ route('posts.list') }}"3
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
        @include('tags.create_modal')
    </div>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
@endsection
