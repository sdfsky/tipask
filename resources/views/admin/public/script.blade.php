
<script type="text/javascript">
    //公告js变量设置
    var site_url = "{{ route('url') }}" ;
</script>

<!-- jQuery 2.1.3 -->
<script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script type="text/javascript" src="{{ asset('/css/admin/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('/js/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<!-- FastClick -->
<script src='{{ asset('/js/fastclick.min.js') }}' type="text/javascript"></script>
<!-- icheck -->
<script src="{{ asset('/css/admin/icheck/icheck.min.js') }}" type="text/javascript"></script>
<!--sco.js-->
<script src="{{ asset('/js/scojs/sco.message.js') }}" type="text/javascript"></script>

<!-- AdminLTE App -->
<script src='{{ asset('/js/admin/admin.js') }}' type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->


<script src='{{ asset('/js/admin/demo.js') }}' type="text/javascript"></script>


<script src='{{ asset('/js/admin/common.js') }}' type="text/javascript"></script>

@if ( session('message') )
<script type="text/javascript">
    $(function(){$.scojs_message('{{ session('message') }}',{{ session('message_type') }});});
</script>
@endif