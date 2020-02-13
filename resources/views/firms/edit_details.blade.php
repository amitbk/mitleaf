@extends('layouts.app')

@section('content')
<firm-edit-details  inline-template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                @include('helpers._flash')
                <h3 class="text-center">Upload a logo of {{$firm->name}}.</h3>
                <div class="card">


                    <div class="card-body text-center">

                        <form action="{{ route('firms.update_details', $firm->id) }}" method="post">
                            @csrf
                            <image-uploader
                                :debug="0"
                                :max-width="600"
                                :quality="0.7"
                                :auto-rotate=true
                                output-format="verbose"
                                :preview=true
                                :class-name="['fileinput', { 'fileinput--loaded' : hasImage }]"
                                :capture="false"
                                accept="video/*,image/*"
                                doNot-resize="['gif', 'svg']"
                                @input="setImage"
                                @on-upload="startImageResize"
                                @on-complete="endImageResize"
                              >
                              <span class="clearfix"></span>
                              <label for="fileInput" slot="upload-label">
                                <div class="upload-caption">@{{ hasImage ? 'Replace File' : 'Select a file' }}</div>
                              </label>

                            </image-uploader>

                            <input type="hidden" id="file" name="image" id="image" v-model="image.dataUrl">

                            <div class="alert alert-secondary">
                              Try to upload a PNG logo. If you dont have PNG, still you can upload JPG/JPEG logo.
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-success">Upload</button>
                            <a href="{{route('firms.edit_details2', $firm->id)}}" class="btn btn-secondary">I don't have the logo.</a>
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</firm-edit-details>
@endsection
