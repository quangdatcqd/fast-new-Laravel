@extends('layouts.app')
@section('page-tilte', 'Sửa danh mục')
@section('active-category', 'active')
@section('content')

    <div class="card">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-header">Sửa danh mục</h5>
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
                    <form action="{{ route('categories.update', ['id' => $category->id]) }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <label class="form-label" for="name">Tên danh mục</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" autofocus
                                    name="name" value="{{ $category->name }}" id="title_slug" placeholder="Nhập Tên">

                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="form-label" for="slug">Slug (URL)</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                    name="slug" id="slug" value="{{ $category->slug }}" placeholder="Nhập slug url">

                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="parent_id" class="form-label">Danh mục cha</label>
                            <select id="parent_id" name="parent_id" class="form-select">
                                <option value=""> Không chọn </option>

                                @foreach ($data as $item)
                                    <option {{ $item->id == $category->parent_id ? 'selected' : '' }}
                                        value="{{ $item->id }}">
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row justify-content-start">
                            <div class="col-md-6 d-flex">
                                <button type="submit" class="btn btn-primary d-flex align-items-center px-5"> <i
                                        class='bx bx-save'></i>&nbsp; Cập nhật</button>

                                <a href="{{ route('categories.list') }}"3
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
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
@endsection
