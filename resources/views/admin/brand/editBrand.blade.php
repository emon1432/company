@extends('admin.part.main_body')
@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">
                
                <div class="col-md-8">
                    <div class="card">
                    @if(session('success'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{session('success')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <div class="card-header">Update Brand</div>
                        <div class="card-body">
                            <form action="{{url('/brand/update/'.$brands->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputBrand" class="form-label">Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control" id="brandNameId" value="{{$brands->brand_name}}">
                                    @error('brand_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputBrandImage" class="form-label">Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control" id="brandImageId">
                                    @error('brand_image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <img src="{{ asset($brands->brand_image) }}" style="height: 400px; width:800px;">
                                    <input type="hidden" value="{{ $brands->brand_image}}" name="old_image">
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