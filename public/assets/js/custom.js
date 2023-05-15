
const baseURL = 'http://127.0.0.1:8000/';

$(document).ready(function () {



    // delete user

    $("#table-tbody").on("click", ".btn-delete", function () {

        $(this).addClass('btn-delete-confirm');
        $(this).html('<i class="bx bx-check"  style="font-size: 18pt"></i> Xoá nha');
    })

    // confirm
    $("#table-tbody").on("click", ".btn-delete-confirm", function () {
        const divDelete = $(this).parent();

        const URL = $(this).attr('route');
        //delete width ajax

        $.ajax({
            url: URL,
            type: 'DELETE',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {
                if (result.error_code == 0) {
                    // remove current tr
                    $(divDelete).parent().parent().remove();
                    toastr["success"](result.message)
                } else {
                    toastr["warning"](result.message)
                }
            },
            error: function (xhr, status, error) {
                toastr["warning"](error.message)
            }
        });


        // $.ajax(baseURL + URL, function (data, status) {
        //     // alert("Data: " + data + "\nStatus: " + status);
        //     console.log(data, status);

        // });
    })

    // change status
    $("#table-tbody").on("change", ".select-status", function () {
        // get tr node
        const trNode = $(this).parent().parent();
        const btnUpdate = $(trNode).find(".btn-update-l");
        $(btnUpdate).attr('id-status', $(this).val())
        $(btnUpdate).show();
    })

    // update status
    $("#table-tbody").on("click", ".btn-update-l", function () {
        // get tr node
        const trNode = $(this).parent().parent();
        const btnUpdate = $(trNode).find(".btn-update-l");
        const idUser = $(this).attr('id-user');
        const idStatus = $(this).attr('id-status');
        const URL = baseURL + `users/update/${idUser}`;
        //update width ajax
        $.ajax({
            url: URL,
            method: 'POST',
            contentType: 'application/json',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: JSON.stringify({ status: idStatus }),
            success: function (response) {
                console.log(response);
                toastr["success"](response.message);
                $(btnUpdate).hide();
            },
            error: function (xhr, status, error) {
                console.log(error);
                toastr["warning"](data.error)
            }
        });


    })


    // onchange title value for all  
    $("#title_slug").keyup(function (e) {
        let titleValue = e.target.value;
        $("#slug").val(slugify(titleValue.toLowerCase()));

    });




});


jQuery(document).ready(function ($) {
    var isRtl = Boolean("");
    if (isRtl) {
        $(" <style> .ui-sortable ol {margin: 0;padding: 0;padding-right: 30px;}ol.sortable, ol.sortable ol {margin: 0 25px 0 0;padding: 0;list-style-type: none;}.ui-sortable dd {margin: 0;padding: 0 1.5em 0 0;}</style>").appendTo("head")
    }
    // initialize the nested sortable plugin
    $('.sortable').nestedSortable({
        forcePlaceholderSize: true,
        handle: 'div',
        helper: 'clone',
        items: 'li',
        opacity: .6,
        placeholder: 'placeholder',
        revert: 250,
        tabSize: 25,
        rtl: isRtl,
        tolerance: 'pointer',
        toleranceElement: '> div',
        maxLevels: 2,
        isTree: true,
        expandOnHover: 700,
        startCollapsed: false
    });

    $('.disclose').on('click', function () {
        $(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
    });

    $('#toArray').click(function (e) {
        // get the current tree order
        arraied = $('ol.sortable').nestedSortable('toArray', { startDepthCount: 0, expression: /(.+)_(.+)/ });

        // // send it with POST
        $.ajax({
            url: baseURL + "categories/update-reorder",
            type: 'POST',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: { data: JSON.stringify(arraied) },
        })
            .done(function () {

                toastr["success"]("<strong>Xong! </strong><br>Đã lưu danh mục.")
            })
            .fail(function () {

                toastr["warning"]("<strong>Lỗi</strong><br>Không thể lưu.")
            })
            .always(function () {
                console.log("complete");
            });

    });


    // Gọi Select2 cho dropdown list
    $(".js-example-basic-single").select2({

        allowClear: true,
        tokenSeparators: [',', ' '],
        multiple: true,
        language: {
            searching: function () {
                return 'Đang tìm kiếm';
            },
            noResults: function () {
                return 'Không tìm thấy ';
            },

        },
        ajax: {
            url: baseURL + "tags/search",
            dataType: "json",
            delay: 1000,
            data: function (params) {
                return {
                    q: params.term, // Tham số q chứa từ khóa tìm kiếm
                    page: params.page
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                var results = [];
                $.each(data.data, function (index, item) {
                    results.push({
                        id: item.id,
                        text: item.title
                    });
                });
                return {
                    results: results, // Dữ liệu kết quả tìm kiếm
                    pagination: {
                        more: (params.page * 30) < data.total // Tham số more để kiểm tra xem còn kết quả nào khác không
                    },

                };
            }
        }
    })


});



// onkey up slug tilte category
function slugify(text) {
    text = removeVietnameseAccent(text);

    return text
        .toString()                     // Chuyển đổi sang chuỗi nếu không phải chuỗi
        .toLowerCase()                 // Chuyển đổi tất cả sang chữ thường
        .replace(/\s+/g, '-')           // Thay thế các khoảng trắng bằng dấu gạch ngang (-)
        .replace(/[^\w\-]+/g, '')       // Loại bỏ các ký tự không phù hợp

        .replace(/\-\-+/g, '-')         // Loại bỏ các dấu gạch ngang liên tiếp
        .replace(/^-+/, '')             // Loại bỏ dấu gạch ngang ở đầu chuỗi
        .replace(/-+$/, '');            // Loại bỏ dấu gạch ngang ở cuối chuỗi
}
function removeVietnameseAccent(str) {
    if (!str) return str;

    const pattern = /[àáạảãăắằẳẵặâầấậẩẫđèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹ]/g;
    const map = {
        'à': 'a', 'á': 'a', 'ạ': 'a', 'ả': 'a', 'ã': 'a',
        'ă': 'a', 'ắ': 'a', 'ằ': 'a', 'ẳ': 'a', 'ẵ': 'a', 'ặ': 'a',
        'â': 'a', 'ầ': 'a', 'ấ': 'a', 'ậ': 'a', 'ẩ': 'a', 'ẫ': 'a',
        'đ': 'd',
        'è': 'e', 'é': 'e', 'ẹ': 'e', 'ẻ': 'e', 'ẽ': 'e',
        'ê': 'e', 'ề': 'e', 'ế': 'e', 'ệ': 'e', 'ể': 'e', 'ễ': 'e',
        'ì': 'i', 'í': 'i', 'ị': 'i', 'ỉ': 'i', 'ĩ': 'i',
        'ò': 'o', 'ó': 'o', 'ọ': 'o', 'ỏ': 'o', 'õ': 'o',
        'ô': 'o', 'ồ': 'o', 'ố': 'o', 'ộ': 'o', 'ổ': 'o', 'ỗ': 'o',
        'ơ': 'o', 'ờ': 'o', 'ớ': 'o', 'ợ': 'o', 'ở': 'o', 'ỡ': 'o',
        'ù': 'u', 'ú': 'u', 'ụ': 'u', 'ủ': 'u', 'ũ': 'u',
        'ư': 'u', 'ừ': 'u', 'ứ': 'u', 'ự': 'u', 'ử': 'u', 'ữ': 'u',
        'ỳ': 'y', 'ý': 'y', 'ỵ': 'y', 'ỷ': 'y', 'ỹ': 'y'
    };

    return str.replace(pattern, function (match) {
        return map[match];
    });
}