@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            @include('helpers._flash')
            <h2>{{ $pageTitle ?? 'Users' }}
                <a href="{{ route('users.create')}}" class="btn btn-success btn-sm">Add New</a>
            </h2>
        </div>
    </div>
    <div class="row ">
        @forelse($users as $user)
        <div class="col-md-6">

            <div class="card">
                <div class="card-body">
                    <h4><a href="{{route('users.show', $user->id)}}" class="text-decoration-none">{{$user->name}}</a></h4>
                    {{$user->user_type->name ?? ''}}
                </div>
                <div class="card-footer">
                    <a href="{{route('users.edit',$user->id)}}" class="btn btn-primary btn-sm">Edit Information</a>
                </div>
            </div>

        </div>
        @empty
          No users yet.
        @endforelse
    </div>
</div>
@endsection
