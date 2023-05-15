@extends('layouts.app')
@section('page-tilte', 'Danh sách danh mục')
@section('active-category', 'active')
@section('content')

    <div class="card">
        <div class="d-flex align-items-center ">
            <h5 class="card-header">Danh sách danh mục</h5>
            <a href="{{ route('categories.create') }}" class="btn btn-primary d-flex align-items-center ">
                <i class='bx bx-plus'></i> &nbsp;
                Thêm
            </a>

        </div>

        <div class="col-md-6 mx-auto div-sortable  mb-5">
            <ol class="sortable mt-0 ui-sortable">
                @foreach ($data as $category)
                    @if ($category->children->count())
                        <li id="list_{{ $category->id }}" class="mjs-nestedSortable-branch mjs-nestedSortable-expanded">
                            <div class="ui-sortable-handle bg-level1"><span
                                    class="disclose"><span></span></span>{{ $category->name }}
                            </div>
                            <ol>
                                @foreach ($category->children->sortBy('sort') as $child)
                                    <li id="list_{{ $child->id }}" class="mjs-nestedSortable-leaf" style="">
                                        <div class="ui-sortable-handle bg-level2">
                                            <span class="disclose"><span></span></span>{{ $child->name }}
                                        </div>
                                    </li>
                                @endforeach
                            </ol>

                        </li>
                        @continue
                    @elseif (!$category->parent_id)
                        <li id="list_{{ $category->id }}" class="mjs-nestedSortable-leaf">
                            <div class="ui-sortable-handle bg-level1"><span
                                    class="disclose"><span></span></span>{{ $category->name }}
                            </div>
                        </li>
                    @endif
                @endforeach
            </ol>
            <div class="d-flex">
                <button class="btn btn-primary d-flex align-items-center " id="toArray">
                    Lưu thay đổi
                </button>
                <a href="{{ route('categories.list') }}"
                    class="btn btn-outline-secondary d-flex align-items-center  ms-3  ">
                    Huỷ bỏ
                </a>
            </div>
        </div>
    </div>

@endsection
