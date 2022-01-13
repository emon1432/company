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
                    <div class="card-header">All Brands</div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">SL no</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Brand Image</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach($brands as $brand)
                            <tr>
                            <th scope="row">{{$brands->firstItem()+$loop->index}}</th>
                                <td>{{$brand->brand_name}}</td>
                                <td><img src="{{ asset($brand->brand_image) }}" style="height: 40px; width:70px;"></td>
                                <td>{{Carbon\Carbon::parse($brand->created_at)->diffForHumans()}}</td>
                                <td>
                                    <a href=" {{url('brand/edit/'.$brand->id)}}" class="btn btn-info">Edit</a>
                                    <a href="{{url('brand/delete/'.$brand->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{$brands->links('vendor.pagination.custom')}}
                </div>
                <br>
                <br>
                <!-- <a href="{{url('brand/trash')}}" class="btn btn-danger">Trash</a> -->
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Add Brand</div>
                    <div class="card-body">
                        <form action=" {{route('add.brand')}} " method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputBrand" class="form-label">Brand Name</label>
                                <input type="text" name="brand_name" class="form-control" id="brandNameId">
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
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection