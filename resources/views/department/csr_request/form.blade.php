@extends('department.layout.app')

@section('styles')
@endsection

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <a href="{{ route('csr_requests') }}"><button type="button" class="btn btn-primary"
                            style="float: right;">Back</button></a>
                    <h6 class="mb-4">Add CSR Request</h6>
                    <form action="{{ route('store_csr_request') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- <div class="mb-3">
                            <label for="sort">Department Name</label>
                            <select class="form-select" name="department_id">
                                <option value="">Choose Department</option>
                                @foreach ($department as $departments)
                                    <option value="{{ $departments->id }}">{{ $departments->department_name }}</option>
                                @endforeach

                            </select>
                            @error('department_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}

                        <div class="mb-3">
                            <label for="sort">Select of CSR Category</label>
                            <select class="form-select" name="csr_category_id">
                                <option value="">Choose CSR Category</option>
                                @foreach ($csr_category as $csr_categories)
                                    <option value="{{ $csr_categories->id }}">{{ $csr_categories->csr_category_name }}</option>
                                @endforeach

                            </select>
                            @error('csr_category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sort">Reason</label>
                            <input class="form-control @error('reason') is-invalid @enderror" type="text"
                                name="reason" id="reason" placeholder="Reason" />
                            @error('reason')
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
                            <label for="sort">Banner</label>
                            <input type="file" name="banner" id="banner" class="form-control @error('banner') is-invalid @enderror">  
                            @error('banner')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sort">Amount</label>
                            <input class="form-control @error('amount') is-invalid @enderror" type="text"
                                name="amount" id="amount" placeholder="Amount" />
                            @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                       
                        {{-- <div class="mb-3">
                            <label for="sort">Sort Number</label>
                            <input class="form-control @error('sort_col') is-invalid @enderror" type="text"
                                name="sort_col" id="sort_col" placeholder="Sr No." />
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
