@extends('admin.layout.app')

@section('styles')
@endsection

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <a href="{{ route('sliders') }}"><button type="button" class="btn btn-primary" style="float: right;">Back</button></a>
                    <h6 class="mb-4">Add Slider</h6>
                    <form action="{{ route('store_slider') }}" method="post" enctype="multipart/form-data">
                        @csrf
                       
                        <div class="mb-3">
                            <label for="sort">Title</label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text"
                                name="title" id="title" placeholder="Title" />
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="objective" class="form-label">Description</label>
                            <textarea id="description" placeholder="Description" type="text" class="form-control"
                                rows="4" name="description" autocomplete="description" autofocus>{{ old('description') }} </textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Image</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">  
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                       

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
