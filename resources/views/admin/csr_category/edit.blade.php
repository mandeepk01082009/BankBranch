@extends('admin.layout.app')

@section('styles')
@endsection

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <a href="{{ route('csr_categories') }}"><button type="button" class="btn btn-primary"
                            style="float: right;">Back</button></a>
                    <h6 class="mb-4">Edit CSR Category</h6>
                    <form action="{{ route('update_csr_category', $csr_category->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="id" id="id" value="{{ $csr_category->id }}" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="sort">Name of CSR Category</label>
                            <input class="form-control @error('csr_category_name') is-invalid @enderror" type="text"
                                name="csr_category_name" id="csr_category_name" value="{{ $csr_category->csr_category_name }}" placeholder="Name of CSR Category" />
                            @error('csr_category_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        
                        <div class="mb-3">
                            <label for="sort">Logo</label>
                            <!-- Show the current logo -->
                            @if ($csr_category->logo)
                                <img src="{{ asset('storage/' . $csr_category->logo) }}" 
                                    style="max-width: 70px; max-height: 70px;">
                            @endif

                            <!-- File input for logo -->
                            <input type="file" name="logo" id="logo" value="{{ $csr_category->logo }}"
                                class="form-control @error('logo') is-invalid @enderror">

                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sort">Background Color</label>
                            <input class="form-control @error('bg_color') is-invalid @enderror" type="text"
                                name="bg_color" id="bg_color" value="{{ $csr_category->bg_color }}"/>
                            @error('bg_color')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sort">Sort Number</label>
                            <input class="form-control @error('sort_col') is-invalid @enderror" type="text"
                                name="sort_col" id="sort_col" placeholder="Sr No." value="{{ $csr_category->sort_col }}" />
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
