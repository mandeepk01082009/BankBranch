@extends('admin.layout.app')

@section('styles')
@endsection

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <a href="{{ route('sliders') }}"><button type="button" class="btn btn-primary"
                            style="float: right;">Back</button></a>
                    <h6 class="mb-4">Edit slider</h6>
                    <form action="{{ route('update_slider', $slider->id) }}" method="post">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="id" id="id" value="{{ $slider->id }}" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="sort">Title</label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text"
                                name="title" id="title" placeholder="Title" value="{{ $slider->title }}" />
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="objective" class="form-label">Description</label>
                            <textarea id="description" placeholder="Description" type="text" class="form-control"
                                rows="4" name="description" autocomplete="description" autofocus>{{ $slider->description}} </textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sort">Image</label>
                            <!-- Show the current image -->
                            @if ($slider->image)
                                <img src="{{ asset('storage/' . $slider->image) }}" alt="Current image"
                                    style="max-width: 70px; max-height: 70px;">
                            @endif

                            <!-- File input for image -->
                            <input type="file" name="image" id="image"
                                class="form-control @error('image') is-invalid @enderror">

                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="mb-3">
                            <label for="sort">Sort Number</label>
                            <input class="form-control @error('sort_col') is-invalid @enderror" type="text"
                                name="sort_col" id="sort_col" placeholder="Sr No." value="{{ $slider->sort_col }}" />
                            @error('sort_col')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
