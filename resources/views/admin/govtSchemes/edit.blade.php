@extends('admin.layout.app')

@section('styles')
@endsection

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <a href="{{ route('add_govt_scheme') }}"><button type="button" class="btn btn-primary" style="float: right;">Back</button></a>
                    <h6 class="mb-4">Update Govt Scheme</h6>
                    <form action="{{ route('update_govt_scheme',$govt_schemes->id) }}" method="post">
                        @csrf
                        @method('PATCH')               

                        <input type="hidden" name="id" id="id" value="{{ $govt_schemes->id }}">  
                        <div class="mb-3">
                            <label for="sort">Sort Number</label>
                            <input class="form-control @error('sort_col') is-invalid @enderror" type="text"
                                name="sort_col" id="sort_col" placeholder="Sr No." value="{{ $govt_schemes->sort_col }}" />
                            @error('sort_col')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Name of Ministry</label>
                            <input class="form-control @error('name_of_ministry') is-invalid @enderror" type="text"
                                name="name_of_ministry" id="name_of_ministry" placeholder="Name of Ministry" value="{{ $govt_schemes->name_of_ministry}}" />
                            @error('name_of_ministry')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Name of Departments</label>
                            <input class="form-control @error('name_of_departments') is-invalid @enderror" type="text"
                                name="name_of_departments" id="name_of_departments" placeholder="Name of Departments" value="{{ $govt_schemes->name_of_departments}}" />
                            @error('name_of_departments')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Scheme</label>
                            <input class="form-control @error('scheme') is-invalid @enderror" type="text"
                                name="scheme" id="scheme" placeholder="Scheme" value="{{ $govt_schemes->scheme }}" />
                            @error('scheme')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Sub scheme</label>
                            <input class="form-control @error('sub_scheme') is-invalid @enderror" type="text"
                                name="sub_scheme" id="sub_scheme" placeholder="Sub Scheme" value="{{ $govt_schemes->sub_scheme }}" />
                            @error('sub_scheme')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Sector</label>
                            <input class="form-control @error('sector') is-invalid @enderror" type="text"
                                name="sector" id="sector" placeholder="Sector" value="{{ $govt_schemes->sector }}" />
                            @error('sector')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="objective" class="form-label">Objective</label>
                            <textarea id="objective" type="text" class="form-control" rows="4" name="objective" autocomplete="objective"
                                    autofocus>{{ $govt_schemes->objective }} </textarea>    
                            @error('objective')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                         <div class="mb-3">
                            <label for="sort">Beneficaries Type</label>
                            <input class="form-control @error('beneficaries_type') is-invalid @enderror" type="text"
                                name="beneficaries_type" id="beneficaries_type" placeholder="Beneficaries Type" value="{{ $govt_schemes->beneficaries_type}}" />
                            @error('beneficaries_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
                        <div class="mb-3">
                            <label for="sort">Grant</label>
                            <input class="form-control @error('grant') is-invalid @enderror" type="text"
                                name="grant" id="grant" placeholder="Grant" value="{{ $govt_schemes->grant }}" />
                            @error('grant')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
                        <div class="mb-3">
                            <label for="sort">Source of Information</label>
                            <input class="form-control @error('source_of_information') is-invalid @enderror" type="text"
                                name="source_of_information" id="source_of_information" placeholder="Source Of Information" value="{{ $govt_schemes->source_of_information }}" />
                            @error('source_of_information')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
                        <div class="mb-3">
                            <label for="sort">Remark</label>
                            <input class="form-control @error('remark') is-invalid @enderror" type="text"
                                name="remark" id="remark" placeholder="Remark" value="{{ $govt_schemes->remark }}" />
                            @error('remark')
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
