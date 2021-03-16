@extends( 'layouts.admin' )

@section('content')
<create-template inline-template>

  <div class="container-fluid">
      @include('helpers.title_admin1', ['name' => 'Template', 'logo' => '' ] )

      <div class="row mt-2">
          <div class="col-md-12">
              @include('helpers._flash')
          </div>
      </div>

      <div class="row justify-content-center py-4">

          <div class="col-md-4">
            <div class="card_media border_b">
                <img class="img-fluid w-100" src="{{asset($template->image->url)}}" alt="">
            </div>
          </div>
          <div class="col-md-8 my-2" >
            <form class="" action="{{url('templates/'.$template->id.'/styles')}}" method="post">
              @csrf
              <div class="d-flex mb-3">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{url('templates/'.$template->id.'/test/3?test=1&location=bottom&x_axis=20&y_axis=20&ratio=35')}}" target="_blank" class="btn btn-primary border_f ml-2">Test</a>

                <a href="{{route('templates.create')}}" class="btn btn-primary ml-auto">Add New</a>
              </div>

              <div class="border p-2">
                <label class="checkbox-inline"><input name="is_verified" type="checkbox" value="1" {{!!$template->is_verified ? 'checked' : ''}}> Verify</label>
                <label class="checkbox-inline"><input name="is_active" type="checkbox" value="1" {{!!$template->is_active ? 'checked' : ''}}> Active</label>

              </div>
              @include('templates._form_logo_support2', ['template' => $template])
              @include('templates._form_strip_support', ['template' => $template])
            </form>

            </div>
      </div>
  </div>
</create-template>
@endsection
