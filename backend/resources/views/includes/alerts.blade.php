 @if (isset($errors))
    @foreach ($errors->all() as $error)
      <script type="text/javascript">
          swal({
              title: "Opps!",
              text: "{{$error}}",
              icon: "warning",
          });
       </script>
    @endforeach
  @endif

  @if(session('success'))
      <script type="text/javascript">
          swal({
              title: "Uhhum!",
              text: "{{ session('success') }}",
              icon: "success",
          });
       </script>

  @endif

  @if(session('error'))
      <script type="text/javascript">
          swal({
              title: "Opps!",
              text: "{{ session('error') }}",
              icon: "warning",
          });
       </script>

  @endif