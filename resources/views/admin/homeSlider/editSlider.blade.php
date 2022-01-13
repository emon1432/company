@extends('admin.part.main_body')
@section('admin')
<div class="py-12">
    <div class="container">
        <div class="row">

            <div class="col-md-10">
                <div class="card">
                    @if(session('success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="card-header">Update Slide</div>
                    <div class="card-body">
                        <form action="{{url('/slider/update/'.$sliders->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputSlider" class="form-label">Title</label>
                                <input type="text" name="slider_title" class="form-control" id="sliderTitleId" value="{{$sliders->title}}">
                                @error('slider_title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputSlider" class="form-label">Description</label>
                                <textarea name="slider_description" class="form-control" rows="3" >{{$sliders->description}}</textarea>
                                @error('slider_description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputSliderImage" class="form-label">Slider Image</label>
                                <input type="file" name="slider_image" class="form-control" id="sliderImageId">
                                @error('slider_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <img src="{{ asset($sliders->image) }}" style="height: 400px; width:800px;">
                                <input type="hidden" value="{{ $sliders->image}}" name="old_image">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection>