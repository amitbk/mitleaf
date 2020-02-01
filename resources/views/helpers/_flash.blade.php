@if (Session::has('message'))
  <div class="alert alert-{{Session::get('message_level')}} alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{Session::get('message')}}
  </div>
@endif
