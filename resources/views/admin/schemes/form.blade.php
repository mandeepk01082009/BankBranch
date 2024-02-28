@extends('admin.layout.app')

@section('styles')
@endsection

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <a href="{{ route('schemes') }}"><button type="button" class="btn btn-primary"
                            style="float: right;">Back</button></a>
                    <h6 class="mb-4">Add Govt. Scheme</h6>
                    <form action="{{ route('store_scheme') }}" method="post">
                        @csrf
                        <div class="mb-3">
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
                        </div>
                        <div class="mb-3">
                            <label for="sort">Scheme Category</label>
                            <input class="form-control @error('scheme_category') is-invalid @enderror" type="text"
                                name="scheme_category" id="scheme_category" placeholder="Scheme Category" />
                            @error('scheme_category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="objective" class="form-label">Description of Scheme</label>
                            <textarea id="description_of_scheme" placeholder="Description of Scheme" type="text" class="form-control"
                                rows="4" name="description_of_scheme" autocomplete="description_of_scheme" autofocus>{{ old('description_of_scheme') }} </textarea>
                            @error('description_of_scheme')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Eligibility Criteria</label>
                            <input class="form-control @error('eligibility_criteria') is-invalid @enderror" type="text"
                                name="eligibility_criteria" id="eligibility_criteria" placeholder="Eligibility Criteria" />
                            @error('eligibility_criteria')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Website Link</label>
                            <input class="form-control @error('website_link') is-invalid @enderror" type="text"
                                name="website_link" id="website_link" placeholder="Website Link" />
                            @error('website_link')
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
