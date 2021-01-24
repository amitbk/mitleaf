@extends('layouts.admin2')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4">

          <div class="row">
            <div class="col-sm-12">

              <ul class="nav nav-pills check-active-link">
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/home')}}">Schedules</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
              </ul>
              <hr>
              @for($i=1; $i < 30; $i++)

              <div class="post__wrapper mb-3">
                <div class="post_date py-3">
                  <span class="font-weight-bold ">{{$i}} January</span>
                  <span class="text-secondary">2 posts</span>
                  <button type="button" class="btn btn-sm btn-outline-primary float-right">Add Post</button>
                </div>

                @if($i == 3)
                <div class="card">
                  <div class="card-body p-1">
                      <div class="row">
                        <div class="col-12 col-sm-3 mb-2 mb-sm-0 text-center">
                          <img class="img-fluid" src="https://picsum.photos/200/150" alt="">
                        </div>
                        <div class="col-12 col-sm-9">
                          <div class="d-flex">
                            <div class="font-weight-bold">
                              Republic Day
                            </div>
                            <div class="ml-auto">
                              <button type="button" class="btn btn-sm btn-outline-primary">Download</button>
                            </div>
                          </div>

                          <div class="post__content">
                            Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="card-footer p-1 ">
                    <div class="row align-items-center">
                      <div class="col-12 col-sm-6 text-secondary f-12">
                        <i class="fas fa-clock"></i> Scheduled on 10:11 PM (GMT+5.30)
                      </div>
                      <div class="col-12 col-sm-6 text-right">
                          <button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
                          <button type="button" class="btn btn-sm btn-outline-primary">Edit</button>
                          <button type="button" class="btn btn-sm btn-primary">Share Now</button>
                      </div>
                    </div>

                  </div>
                </div>
                @else
                <div class="bg-lightcyan2 p-2 text-center text-secondary">
                  No posts for this day.
                </div>
                @endif
              </div>
              @endfor
            </div>
          </div>
        </div>
        <div class="col-md-4">



        </div>
    </div>
</div>
@endsection
