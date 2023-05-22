<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous" type="text/javascript">
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<!----------------- Data Tables ------------------>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/colreorder/1.6.1/js/dataTables.colReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!---------------------------- DROPIFY -------------------------------->
<script src="{{ asset('assets/dist/js/dropify.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        var table = $('#example').dataTable({
            colReorder: true,
            responsive: true,
            ordering: false,
            bLengthChange: false,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search Keyword"
            }
        });

    });
    //
    function showAlertMessage(data, message = null) {
        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-bottom-right",
            "progressBar": true,
            "debug": false,
            "newestOnTop": false,
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        if (data == 'state') {
            toastr.success("Status Update Successfully...")
        }
        if (data == 'success') {
            var msg = "{{ Session::get('success') }}"

            toastr.success(msg)
        }
        if (data == 'error') {
            var msg = "{{ Session::get('error') }}"

            toastr.error(msg)
        }
        if (data == 'js') {
            toastr.error(message)
        }

        //alert("Status Update Successfully...");
        $("#send").prop("disabled", true)

    }
    @if (Session::has('success'))
        showAlertMessage('success')
    @endif

    @if (Session::has('error'))
        showAlertMessage('error')
    @endif
</script>
