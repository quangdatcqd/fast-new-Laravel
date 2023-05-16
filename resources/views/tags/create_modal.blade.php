<div class="modal fade " id="smallModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Thêm thẻ mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('tags.store') }}" id="quick-add-tag" method="post">
                <div class="modal-body">

                    @csrf
                    <div class="input-group mb-3">
                        <label class="form-label" for="name">Tên thẻ</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" autofocus
                                name="name" id="title_slug_tag" placeholder="Nhập Tên Thẻ">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label class="form-label" for="slug">Slug (URL)</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                name="slug" id="slug_tag" placeholder="Nhập slug url">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class='bx bx-x'></i> &nbsp;
                        Huỷ bỏ
                    </button>
                    <button type="submit" class="btn btn-primary"> <i class='bx bx-plus'></i>&nbsp; Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade " id="smallModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameSmall" class="form-label">Name</label>
                        <input type="text" id="nameSmall" class="form-control" placeholder="Enter Name">
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-0">
                        <label class="form-label" for="emailSmall">Email</label>
                        <input type="text" class="form-control" id="emailSmall" placeholder="xxxx@xxx.xx">
                    </div>
                    <div class="col mb-0">
                        <label for="dobSmall" class="form-label">DOB</label>
                        <input id="dobSmall" type="text" class="form-control" placeholder="DD / MM / YY">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
