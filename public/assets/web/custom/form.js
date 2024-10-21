$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    let $form = $('#addEditForm')
    $form.on('submit', function (e) {
        e.preventDefault()
        loaderView()
        let formData = new FormData($form[ 0 ])
        axios
            .post(APP_URL + form_url, formData)
            .then(function (response) {
                if ($('#form-method').val() === 'add') {
                    $form[ 0 ].reset()
                }
                setTimeout(function () {
                    window.location.href = APP_URL + redirect_url
                    loaderHide()
                }, 1000)
                loaderHide()
                notificationToast(response.data.message, 'success')
            })
            .catch(function (error) {
                notificationToast(error.response.data.message, 'warning')
                loaderHide()
            })
        // }
    })

    let $taskModalForm = $('#taskModalForm')
    $taskModalForm.on('submit', function (e) {
        e.preventDefault()
        loaderView()
        let formData = new FormData($taskModalForm[ 0 ])
        axios
            .post(APP_URL + modal_form_url, formData)
            .then(function (response) {
                if (response.data.success === true){
                    $taskModalForm[ 0 ].reset()
                    $('#add_task_model').modal('hide');
                    loaderHide()
                    window.location.reload()
                    notificationToast(response.data.message, 'success')
                }else{
                    loaderHide()
                    notificationToast(response.data.message, 'warning')
                }

            })
            .catch(function (error) {
                notificationToast(error.response.data.message, 'warning')
                loaderHide()
            })
    })

    let $markAbsentModalForm = $('#markAbsentModalForm')
    $markAbsentModalForm.on('submit', function (e) {
        e.preventDefault()
        loaderView()
        let formData = new FormData($markAbsentModalForm[ 0 ])
        axios
            .post(APP_URL + '/mark-absent', formData)
            .then(function (response) {
                if (response.data.success === true){
                    $markAbsentModalForm[ 0 ].reset()
                    $('#mark_absent_model').modal('hide');
                    loaderHide()
                    window.location.reload()
                    notificationToast(response.data.message, 'success')
                }else{
                    loaderHide()
                    notificationToast(response.data.message, 'warning')
                }

            })
            .catch(function (error) {
                notificationToast(error.response.data.message, 'warning')
                loaderHide()
            })
    })
})

