@extends('admin.part.main_body')
@section('admin')
<div class="py-12">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <a href="{{route('slider.add')}}" style="width: 100px; margin:20px" class="btn btn-info"> Add Slider</a>

                <div class="card">
                    @if(session('success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="card-header">Home Slider</div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">SL no</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($sliders as $slider)
                            <tr>
                                <th scope="row">{{$i++}}</th>
                                <td><img src="{{ asset($slider->image) }}" style="height: 50px; width:80px;"></td>
                                <td>{{$slider->title}}</td>
                                <td>{{$slider->description}}</td>
                                <td>{{Carbon\Carbon::parse($slider->created_at)->diffForHumans()}}</td>
                                <td>
                                    <a href=" {{url('slider/edit/'.$slider->id)}}" class="btn btn-info">Edit</a>
                                    <a href="{{url('slider/delete/'.$slider->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{$sliders->links('vendor.pagination.custom')}}

                </div>
                <br>
                <br>
                <!-- <a href="{{url('brand/trash')}}" class="btn btn-danger">Trash</a> -->
            </div>
           
        </div>
    </div>

</div>
@endsection