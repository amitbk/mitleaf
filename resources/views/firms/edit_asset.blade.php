@extends('layouts.app')

@section('content')
<firm-edit-details  inline-template>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-5">
                @include('helpers._flash')
                <h3 class="text-center font-weight-bold">{{$firm->name}}</h3>
                <h4 class="text-center">Upload a {{$asset_type_name}}</h4>
                <div class="card">


                    <div class="card-body text-center">

                        <form action="{{ route('firms.update_assets', $firm->id) }}" method="post">
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
                            <input type="hidden" name="asset_type_id" value="{{$asset_type_id}}">

                            <div class="alert alert-secondary">
                              Try to upload a PNG logo. If you dont have PNG, still you can upload JPG/JPEG logo.
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-success" @click="$root.loading = true">Upload</button>
                            <a
                              @if($asset_type_id == 3)
                                href="{{route('firms.add_fb_page', $firm->id )}}"
                              @else
                                href="{{route('firms.edit_assets', [$firm->id, 3] )}}"
                              @endif
                              class="btn btn-secondary">I don't have the {{$asset_type_name}}.</a>
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</firm-edit-details>
@endsection
