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

        Highcharts.chart('daily-data-chart', {
            chart: {
                type: 'column',
            },
            title: false,
            xAxis: {
                type: 'category',
                labels: {
                    staggerLines: 2,
                    rotation: -45,
                    style: {
                        fontSize: '11px',
                        fontFamily: 'Poppins-Regular, sans-serif'
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
            credits: {
                enabled: false
            },
            series: [{
                name: 'Population',
                data: [
                    ['08 12 23', 1]
                ]
            }]
        });
    });
</script>
