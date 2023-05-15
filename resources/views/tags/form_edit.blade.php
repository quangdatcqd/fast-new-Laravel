@extends('layouts.app')
@section('page-tilte', 'Sửa thẻ "' . $data->title . '"')
@section('active-tag', 'active')
@section('content')

    <div class="card">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-header">Sửa thẻ "{{ $data->title }}"</h5>
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
                    <form action="{{ route('tags.update', ['id' => $data->id]) }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <label class="form-label" for="name">Tên thẻ</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" autofocus
                                    name="name" value="{{ $data->title }}" id="title_slug" placeholder="Nhập Tên Thẻ">

                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="form-label" for="slug">Slug (URL)</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                    name="slug" value="{{ $data->slug }}" id="slug" placeholder="Nhập slug url">

                            </div>
                        </div>

                        <div class="row justify-content-start">
                            <div class="col-md-6 d-flex">
                                <button type="submit" class="btn btn-primary d-flex align-items-center px-5"> <i
                                        class='bx bx-save'></i>&nbsp; Lưu</button>
                                <a href="{{ route('tags.list') }}"3
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
