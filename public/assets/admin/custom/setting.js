$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
let $generalSettingForm = $('#general_setting_form')
$generalSettingForm.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    let formData = new FormData($generalSettingForm[0])
    axios
        .post(APP_URL + general_form_url, formData)
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

let $emailSettingForm = $('#email_setting_form')
$emailSettingForm.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    let formData = new FormData($emailSettingForm[0])
    axios
        .post(APP_URL + email_setting_form_url, formData)
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

let $contactInfoForm = $('#contact_info_form')
$contactInfoForm.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    let formData = new FormData($contactInfoForm[0])
    axios
        .post(APP_URL + contact_info_form_url, formData)
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

let $socialMediaForm = $('#social_media_form')
$socialMediaForm.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    let formData = new FormData($socialMediaForm[0])
    axios
        .post(APP_URL + social_media_form_url, formData)
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

