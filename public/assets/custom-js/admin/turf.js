$(document).on('click', '.approve-btn', function () {
    var value_id = $(this).data('id')
    Swal.fire({
        title: 'Are you sure want to Approve ?',
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
            approveStatus(value_id)
        }
    }))
})
$(document).on('click', '.reject-btn', function () {
    var value_id = $(this).data('id')
    $("#reject_id").val(value_id)
    $("#rejectModal").modal('show')
})

function approveStatus(value_id) {
    loaderView()
    axios
        .post(APP_URL + '/approve-turf', {id: value_id})
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

let $form = $('#rejectForm')
$form.on('submit', function (e) {
    e.preventDefault()
    loaderView()
    let formData = new FormData($form[0])
    axios
        .post(APP_URL + '/reject-turf', formData)
        .then(function (response) {
            $("#rejectModal").modal('hide')
            $form[0].reset()
            table.draw();
            loaderHide()
            notificationToast(response.data.message, 'success')
        })
        .catch(function (error) {
            notificationToast(error.response.data.message, 'warning')
            loaderHide()
        })
})
