<!-- Essential javascripts for application to work-->
<script src="{{asset('admin/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('admin/js/popper.min.js')}}"></script>
<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin/js/main.js')}}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{asset('admin/js/plugins/pace.min.js')}}"></script>
<!-- Page specific javascripts-->
{{--<script type="text/javascript" src="{{asset('admin/js/plugins/chart.js')}}"></script>--}}
<script type="text/javascript" src="{{asset('admin/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/plugins/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/confirm.js')}}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
@stack('js')
@stack('chart')
<script>
    function confirmation(actionID, type) {
        event.preventDefault()
            dialog.confirm({
                title: "{{__('Confirm Action')}}",
                message: "{{__('Are You Sure Want To ')}}" + type +'?',
                cancel: "No",
                button: "Yes",
                required: true,
                callback: function(value){
                    if(value) {
                        document.getElementById(actionID).submit();
                    }
                }
            });
    }
</script>
