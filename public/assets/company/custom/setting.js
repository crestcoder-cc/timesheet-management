$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
let $holiday_form = $('#holiday_form')
$holiday_form.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    let formData = new FormData($holiday_form[0])
    axios
        .post(APP_URL + holiday_form_url, formData)
        .then(function (response) {
            loaderHide();
            if (typeof redirect_url !== 'undefined') {
                setTimeout(function () {
                    window.location.href = APP_URL + redirect_url
                }, 1000)
            }
            notificationToast(response.data.message, 'success');
        })
        .catch(function (error) {
            console.log(error)
            notificationToast(error.response.data.message, 'warning')
            loaderHide();
        });
})

