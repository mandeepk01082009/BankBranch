@extends('admin.layout.app')

@section('styles')
@endsection

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <a href="{{ route('useful_links') }}"><button type="button" class="btn btn-primary"
                            style="float: right;">Back</button></a>
                    <h6 class="mb-4">Edit Link</h6>
                    <form action="{{ route('update_useful_link', $useful_link->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="id" id="id" value="{{ $useful_link->id }}" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="sort">Useful Link</label>
                            <input class="form-control @error('useful_link') is-invalid @enderror" type="text"
                                name="useful_link" id="useful_link" placeholder="Useful Link"
                                value="{{ $useful_link->useful_link }}" />
                            @error('useful_link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Link</label>
                            <input class="form-control @error('link') is-invalid @enderror" type="text" name="link"
                                id="link" placeholder="Link" value="{{ $useful_link->link }}" />
                            @error('link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Logo</label>
                            <!-- Show the current logo -->
                            @if ($useful_link->logo)
                                <img src="{{ asset('storage/' . $useful_link->logo) }}" 
                                    style="max-width: 70px; max-height: 70px;">
                            @endif

                            <!-- File input for logo -->
                            <input type="file" name="logo" id="logo"
                                class="form-control @error('logo') is-invalid @enderror">

                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sort">Sort Number</label>
                            <input class="form-control @error('sort_col') is-invalid @enderror" type="text"
                                name="sort_col" id="sort_col" placeholder="Sr No." value="{{ $useful_link->sort_col }}" />
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
