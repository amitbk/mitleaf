@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-3">
          <div class="card">
              <div class="card-body">

                  You are logged in!
              </div>
          </div>
        </div>
        <div class="col-md-9">

          <div class="card shadow-sm mb-2">
            <div class="card-body p-0">

              <div class="d-flex flex-sm-row">
                <!-- date -->
                <div class="card__date_wrapper p-3 bg-lightcyan">
                  <div class="card__date f-50 ">
                    23
                  </div>
                  <div class="card__date">
                    Jan
                  </div>
                </div>

                <!-- business and image -->
                <div class="">
                  <img class="img-fluid shadow h-100" src="https://picsum.photos/100/80" alt="">
                </div>
                <div class="flex-grow-1 p-2">
                    <div class="card__business_meta">
                      <span class="font-weight-bold">Kere Patil Machinery</span>
                      <span class="text-secondary">Business post</span>
                    </div>

                    <div class="">
                    </div>
                </div>

              </div>

            </div>
          </div>


          <!-- 2 -->
          @for($i=0; $i<10; $i++)
          <div class="card shadow-sm mb-3">
            <div class="card-body p-0">

              <div class="row">
                <div class="col-6 col-sm-3 col-md-3 col-lg-2 pr-0 h-100">

                  <div class="card__date_wrapper p-3 bg-lightcyan h-100">
                    <div class="card__date f-50 ">
                      23
                    </div>
                    <div class="card__date">
                      Jan
                    </div>
                  </div>

                </div>
                <div class="col-6 col-sm-3 col-md-3 col-lg-2 py-2">
                  <img class="card__image img-fluid h-100 w-100 pr-3 pr-sm-0" src="https://picsum.photos/100/80" alt="">
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-8 p-2">
                  <div class="card__business_meta px-2 px-sm-0">
                    <div class="font-weight-bold">Kere Patil Machinery</div>
                    <div class="text-secondary">Business post</div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          @endfor


        </div>
    </div>
</div>
@endsection
