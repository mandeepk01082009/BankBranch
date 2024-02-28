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
                    <h6 class="mb-4">Edit Link</h6>
                    <form action="{{ route('update_public_notice', $public_notice->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="id" id="id" value="{{ $public_notice->id }}">

                        <div class="mb-3">
                            <label for="sort">Title</label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                                id="title" placeholder="Title" value="{{ $public_notice->title }}" />
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Notice</label><br>
                            <!-- Show the current logo -->
                            @if ($public_notice->notice)
                                <span class="mt-3">
                                    <a href="{{ asset('storage/' . $public_notice->notice) }}" target="_blank"><i
                                            class="fa fa-file-text" style="font-size:30px;margin-left:2rem"></i></a>
                                </span>
                            @endif

                            <!-- File input for logo -->
                            <input type="file"
                                accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                name="notice" id="notice" class="form-control @error('notice') is-invalid @enderror">

                            @error('notice')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sort">Sort Number</label>
                            <input class="form-control @error('sort_col') is-invalid @enderror" type="text"
                                name="sort_col" id="sort_col" placeholder="Sr No."
                                value="{{ $public_notice->sort_col }}" />
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
