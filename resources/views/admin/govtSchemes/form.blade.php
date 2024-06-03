@extends('admin.layout.app')

@section('styles')
@endsection

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <a href="{{ route('govt_schemes') }}"><button type="button" class="btn btn-primary" style="float: right;">Back</button></a>
                    <h6 class="mb-4">Add Govt. Scheme</h6>
                    <form action="{{ route('store_govt_scheme') }}" method="post">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="sort">Scheme Type</label>
                            {{-- <input class="form-control @error('name_of_ministry') is-invalid @enderror" type="text"
                                name="name_of_ministry" id="name_of_ministry" placeholder="Name of Ministry" /> --}}
                                <select class="form-select@error('scheme_type') is-invalid @enderror" aria-label="Default select example" name="scheme_type">
                                    <option value="">Please Select Scheme Type</option>
                                    <option value="State Scheme">State Scheme</option>
                                    <option value="Center Scheme">Center Scheme</option>
                                    <option value="Combined Scheme">Combined Scheme</option>
                                </select>
                            @error('scheme_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Name of Departments</label>
                            <input class="form-control @error('name_of_departments') is-invalid @enderror" type="text"
                                name="name_of_departments" id="name_of_departments" placeholder="Name of Departments" />
                            @error('name_of_departments')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Scheme</label>
                            <input class="form-control @error('scheme') is-invalid @enderror" type="text"
                                name="scheme" id="scheme" placeholder="Scheme" />
                            @error('scheme')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Sub scheme</label>
                            <input class="form-control @error('sub_scheme') is-invalid @enderror" type="text"
                                name="sub_scheme" id="sub_scheme" placeholder="Sub Scheme" />
                            @error('sub_scheme')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Sector</label>
                            <input class="form-control @error('sector') is-invalid @enderror" type="text"
                                name="sector" id="sector" placeholder="Sector" />
                            @error('sector')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="objective" class="form-label">Objective</label>
                            <textarea id="objective" type="text" class="form-control" rows="4" name="objective" autocomplete="objective"
                                    autofocus>{{ old('objective') }} </textarea>    
                            @error('objective')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                         <div class="mb-3">
                            <label for="sort">Beneficaries Type</label>
                            <input class="form-control @error('beneficaries_type') is-invalid @enderror" type="text"
                                name="beneficaries_type" id="beneficaries_type" placeholder="Beneficaries Type" />
                            @error('beneficaries_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
                        <div class="mb-3">
                            <label for="sort">Grant</label>
                            <input class="form-control @error('grant') is-invalid @enderror" type="text"
                                name="grant" id="grant" placeholder="Grant" />
                            @error('grant')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
                        <div class="mb-3">
                            <label for="sort">Website URL</label>
                            <input class="form-control @error('website_url') is-invalid @enderror" type="text"
                                name="website_url" id="website_url" placeholder="Source Of Information" />
                            {{-- @error('website_url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror --}}
                        </div> 
                        <div class="mb-3">
                            <label for="sort">Status</label>
                            <input class="form-control @error('status') is-invalid @enderror" type="text"
                                name="status" id="status" placeholder="Status" />
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
                        <div class="mb-3">
                            <label for="sort">Remark</label>
                            <input class="form-control @error('remark') is-invalid @enderror" type="text"
                                name="remark" id="remark" placeholder="Remark" />
                            @error('remark')
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
                        {{-- <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
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
