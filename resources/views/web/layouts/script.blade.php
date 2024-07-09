<script>
    var APP_URL = {!! json_encode(url('/')) !!};
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"
        integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/plugins/blockUI/blockUI.js') }}"></script>
<script src="{{ asset('assets/plugins/axios/axios.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script src="{{asset('assets/web/custom/custom.js')}}?v={{time()}}"></script>
<script>

    $(document).ready(function () {
        $('.toggle-icon').click(function () {
            let tableDetails = $(this).closest('tr').next('.table-details');
            let icon = $(this).find('i');
            if (tableDetails.hasClass('table-details')) {
                if (tableDetails.css('display') === 'none') {
                    tableDetails.css('display', 'table-row');
                    icon.removeClass('fa-caret-down').addClass('fa-caret-up');
                } else {
                    tableDetails.css('display', 'none');
                    icon.removeClass('fa-caret-up').addClass('fa-caret-down');
                }
            }
        });
    });
    $('#add_task').on('click', function () {
        var myModal = new bootstrap.Modal(document.getElementById('add_task_model'), {
            keyboard: false
        });
        myModal.show();
    });
    $('#btn-close').on('click', function () {
        $('#add_task_model').modal('hide');
    });
</script>
<script>
    function activateCard(cardId) {
        // Remove the active class from all cards
        const cards = document.querySelectorAll('.card-hover');
        cards.forEach(card => {
            card.classList.remove('card-active');
        });

        // Add the active class to the clicked card
        const card = document.getElementById(cardId);
        card.classList.add('card-active');
    }
</script>
@yield('custom-script')
