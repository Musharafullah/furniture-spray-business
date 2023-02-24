<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<!----------------- High Charts ------------------>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/10.3.3/highcharts.js"
    integrity="sha512-8cJ3Lf1cN3ld0jUEZy26UOg+A5YGLguP6Xi6bKLyYurrxht+xkLJ9oH9rc7pvNiYsmYuTvpe3wwS6LriK/oWDg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!----------------- Data Tables ------------------>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/colreorder/1.6.1/js/dataTables.colReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>



<!---------------------------- DROPIFY -------------------------------->
<script src="{{ asset('assets/dist/js/dropify.min.js') }}"></script>

<script>
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
            
            //----------------------------------------------------------------------------------------------------------

            Highcharts.chart('daily-data-chart', {
                chart: {
                    type: 'column'

                },
                title: false,
                xAxis: {
                    type: 'category',
                    labels: {
                        step: 2,
                        rotation: -45,
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: false
                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: 'Quote in day: <b>{point.y:.1f}</b>'
                },
                series: [{
                    name: 'Population',
                    data: [
                        @if(!empty($from))
                            @php
                              //  $from = Carbon\Carbon::now();
                                //dd($from);
                             //   $to = Carbon\Carbon::now()->addDays(-10);
                                if(!empty($from))
                                $grouped = \App\Models\Quote::whereBetween('created_at', [$from,$to])->get()->groupby(function ($q){
                                    return $q->created_at->format('d m Y');
                                });

                            //dd($grouped);
                            @endphp
                            @foreach($grouped as $key => $group)
                            @if($loop->last)
                        ['{{ $key }}', {{ $group->count() }}]
                                @else
                            ['{{ $key }}', {{ $group->count() }}],
                        @endif
                        @endforeach
                        @endif
                    ]
                }]
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
