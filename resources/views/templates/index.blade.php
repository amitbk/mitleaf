@extends( isset($is_admin) ? 'layouts.admin2' : 'layouts.app8')

@section('content')

<div class="container-fluid">
    @include('helpers.title_admin1', ['name' => 'Templates', 'logo' => '' ] )

    <div class="row">
        <div class="col-md-12">
            @include('helpers._flash')
        </div>
    </div>

    <div class="row justify-content-center py-4">
        <div class="col-md-2 my-2" >
            <a href="{{route('templates.create')}}" class="btn btn-primary btn-block">Add New</a>
            <a href="#" class="btn btn-light btn-block border_f">Filter</a>
        </div>
        <div class="col-md-10">
            @include('templates.list');
            {{$templates->links()}}
        </div>
    </div>
</div>
@endsection
