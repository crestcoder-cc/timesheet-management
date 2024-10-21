var pageInfo = 0;
var pageIndex = 0;
const table = $('#basic-1').DataTable({
    processing: true,
    serverSide: true,
    autoWidth: false,
    responsive: true,
    searching:false,
    "info": false,
    "lengthChange": false,

    ajax: {
        url: APP_URL + datatable_url,
        type: 'GET',
        data: function (d) {
            d.status = $('#status').val();
            var dateRangePicker = $('input[name="date_range"]').data('daterangepicker');

            if (dateRangePicker) {
                d.from_date = dateRangePicker.startDate.format('YYYY-MM-DD');
                d.to_date = dateRangePicker.endDate.format('YYYY-MM-DD');
            } else {
                d.from_date = null; // or set to some default value
                d.to_date = null;   // or set to some default value
            }
        }
    },
    drawCallback: function () {
        pageCount()
    },
    language: {
        // processing: '<div class="spinner-border text-primary m-1" role="status"><span class="sr-only"></span></div>'
        "paginate": {
            "previous": "<i class='fas fa-chevron-left'></i>",
            "next": "<i class='fas fa-chevron-right'></i>"
        }
    },
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']]
})

function pageCount() {
    pageInfo = table.page.info();
    pageIndex = pageInfo.page + 1;
}

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })


    $(document).on('keyup', '.col-search-input', function () {
        const value = $(this).val()
        $('#search_value').val(value)
        table.draw()
    })
    $(".applyBtn").click(function(){
        table.draw();
    });
    $('#data-table-search').keyup(function () {
        console.log($(this).val())
        table.search($(this).val()).draw()
    })

    $(document).on('click', '.filter_apply', function () {
        table.draw()
    })

    $(document).on('change', '.status-filter', function () {
        table.draw()
    })
    $(document).on('click', '.delete-single', function () {
        const value_id = $(this).data('id')

        Swal.fire({
            title: sweetalert_delete_title,
            text: sweetalert_delete_text,
            icon: 'warning',
            showCancelButton: !0,
            buttonsStyling: !1,
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
            customClass: {
                confirmButton: 'btn fw-bold btn-danger mx-2',
                cancelButton: 'btn fw-bold btn-info'
            }
        }).then((function (t) {
            if (t.isConfirmed) {
                deleteRecord(value_id)
            }
        }))
    })

    function deleteRecord(value_id) {
        loaderView()
        axios
            .delete(APP_URL + form_url + '/' + value_id)
            .then(function (response) {
                notificationToast(response.data.message, 'success')
                table.draw()
                loaderHide()
            })
            .catch(function (error) {
                notificationToast(error.response.data.message, 'warning')
                loaderHide()
            })

    }

    $(document).on('click', '.status-change', function () {
        const value_id = $(this).data('id')
        const status = $(this).data('status')
        Swal.fire({
            title: 'Change Status ?',
            // text: sweetalert_change_status_text,
            icon: 'warning',
            showCancelButton: !0,
            buttonsStyling: !1,
            confirmButtonText: 'Yes Change It',
            cancelButtonText: 'Cancel',
            customClass: {
                confirmButton: 'btn fw-bold btn-danger',
                cancelButton: 'btn fw-bold btn-active-light-primary'
            },
        }).then((function (t) {
            if (t.isConfirmed) {
                changeStatus(value_id, status)
            }
        }))
    })

    function changeStatus(value_id, status) {
        loaderView()
        axios
            .get(APP_URL + form_url + '/status' + '/' + value_id + '/' + status)
            .then(function (response) {
                table.draw()
                notificationToast(response.data.message, 'success')
                loaderHide()
            })
            .catch(function (error) {
                notificationToast(error.response.data.message, 'warning')
                loaderHide()
            })
    }
})

