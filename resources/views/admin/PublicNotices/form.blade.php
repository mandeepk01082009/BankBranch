@extends('admin.layout.app')

@section('styles')
@endsection

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <a href="{{ route('public_notices') }}"><button type="button" class="btn btn-primary"
                            style="float: right;">Back</button></a>
                    <h6 class="mb-4">Add Notice</h6>
                    <form action="{{ route('store_public_notice') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="sort">Title</label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                                id="title" placeholder="Title" />
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Upload Notice</label>
                            <input type="file" name="notice"
                                accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                id="notice" class="form-control @error('notice') is-invalid @enderror">
                            @error('notice')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Sort Number</label>
                            <input class="form-control @error('sort_col') is-invalid @enderror" type="text"
                                name="sort_col" id="sort_col" placeholder="Sr No." />
                            @error('sort_col')
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
