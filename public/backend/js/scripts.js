/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
// 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }


    const TableList = document.querySelector('#datatables.table');
    if (TableList) {
        const deleteForm = document.querySelector('.delete_form');
        TableList.addEventListener('click', function (e) {
            if (e.target.classList.contains('delete_action')) {
                e.preventDefault();
                Swal.fire({
                    title: "Bạn chắc chắn muốn xóa không?",
                    // text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "OK",
                    cancelButtonText: "Hủy",
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteForm.action = e.target.href;
                        deleteForm.submit();
                    }
                });

            }
        })
    }


    function getSlug(title) {
        //Đổi chữ hoa thành chữ thường
        let slug = title.toLowerCase();

        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, "a");
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, "e");
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, "i");
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, "o");
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, "u");
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, "y");
        slug = slug.replace(/đ/gi, "d");
        //Xóa các ký tự đặt biệt
        slug = slug.replace(
            /\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi,
            ""
        );
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, "-");
        slug = slug.replace(/\-\-\-\-/gi, "-");
        slug = slug.replace(/\-\-\-/gi, "-");
        slug = slug.replace(/\-\-/gi, "-");
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = "@" + slug + "@";
        slug = slug.replace(/\@\-|\-\@|\@/gi, "");
        return slug;
    }

    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');
    let isChangeSlug = false;
    if (slug && slug.value == '' && title) {
        title.addEventListener('keyup', function (e) {
            if (!isChangeSlug) {
                let titleContent = e.target.value;
                slug.value = getSlug(titleContent);
            }
        })
    }

    if (slug) {
        slug.addEventListener('change', function () {
            if (slug.value == '') {
                let titleContent = title.value;
                slug.value = getSlug(titleContent);
            }
            isChangeSlug = true;
        })
    }

    const logout_action = document.querySelector('.logout_action');
    const logout_form = document.querySelector('.logout_form');
    if (logout_action) {
        logout_action.addEventListener('click', function (e) {
            e.preventDefault();
            logout_form.action = e.target.href;
            logout_form.submit();
        })
    }

    const arr_module = [
        'users', 'groups', 'teachers', 'categories', 'courses', 'lessons', 'students', 'orders'
    ]

    const arr_role = [
        'add', 'edit', 'delete', 'pemission'
    ]

    $.each(arr_module, function (index, value) {
        $.each(arr_role, function (i, item) {
            if (document.querySelector('#role_' + value + '_view')) {
                document.querySelector('#role_' + value + '_view').addEventListener('click', function (e) {
                    if (document.querySelector('#role_' + value + '_view').checked == false) {
                        if (document.querySelector('#role_' + value + '_' + item)) {
                            document.querySelector('#role_' + value + '_' + item).checked = false;
                        }
                    }
                });
            }
            if (document.querySelector('#role_' + value + '_' + item)) {
                document.querySelector('#role_' + value + '_' + item).addEventListener('click', function (e) {
                    if (document.querySelector('#role_' + value + '_' + item).checked) {
                        document.querySelector('#role_' + value + '_view').checked = true;
                    }
                });
            }
        });
    });

});
