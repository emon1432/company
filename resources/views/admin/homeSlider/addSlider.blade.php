@extends('admin.part.main_body')
@section('admin')
<div class="col-md-8" style="margin:0 auto;">
    <div class="card">
        @if(session('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{session('success')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="card-header">Add Slider</div>
        <div class="card-body">
            <form action=" {{route('add.slider')}} " method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputSlider" class="form-label">Title</label>
                    <input type="text" name="slider_title" class="form-control" id="sliderTitleId">
                    @error('slider_title')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputSlider" class="form-label">Description</label>
                    <textarea name="slider_description" class="form-control" rows="3"></textarea>
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
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection