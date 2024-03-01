<!-- base:js -->
<script src="{{asset('theme/vendors/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="{{asset('theme/vendors/chart.js/Chart.min.js')}}"></script>
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{asset('theme/js/off-canvas.js')}}"></script>
<script src="{{asset('theme/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('theme/js/template.js')}}"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<!-- End plugin js for this page -->
<!-- Custom js for this page-->
{{--<script src="{{asset('theme/js/dashboard.js')}}"></script>--}}

<script type="application/javascript" src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script type="application/javascript"
        src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="application/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script type="application/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script src="{{asset('theme/js/file-upload.js')}}"></script>


@include('pages.common.scripts.dashboard-js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- End custom js for this page-->
<script type="text/javascript">
    var timestamp = '<?=time();?>';

    function updateTime() {
        $('#time').html(Date(timestamp));
        timestamp++;
    }

    $(function () {
        setInterval(updateTime, 1000);
    });
</script>

<script type="application/javascript">

    function runSchedule(data) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        Swal.fire({
            title: 'You want to disburse airtime to ' + data + '.<br>Do you want to Proceed',
            showDenyButton: true, showCancelButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "{{url('/disburse-airtime')}}",
                    data: {_token: CSRF_TOKEN, recordCount: data},
                    success: function (data) {
                        Swal.fire('Airtime Disbursement Initiated Successfully', '', 'success');
                        window.location.href = '/dashboard';
                    }


                });

            } else if (result.isDenied) {
                Swal.fire('Action Reversed', '', 'info')
            }
        });

    }


</script>


