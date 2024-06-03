@extends('department.layout.app')

@section('styles')
@endsection

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <a href="{{ route('depts') }}"><button type="button" class="btn btn-primary" style="float: right;">Back</button></a>
                    <h6 class="mb-4">Edit Department</h6>
                    <form action="{{ route('update_dept',$department->id) }}" method="post">
                        @csrf
                        @method('PATCH')               

                        <input type="hidden" name="id" id="id" value="{{ $department->id }}">  
                       
                        <div class="mb-3">
                            <label for="sort">Department Name</label>
                            <input class="form-control @error('department_name') is-invalid @enderror" type="text"
                                name="department_name" id="department_name" placeholder="Department Name" value="{{ $department->department_name }}" />
                            @error('department_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Contact Person</label>
                            <input class="form-control @error('contact_person') is-invalid @enderror" type="text"
                                name="contact_person" id="contact_person" placeholder="Contact Person" value="{{ $department->contact_person }}" />
                            @error('contact_person')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email"  id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $department->email }}">
                            {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                            </div> --}}
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Contact</label>
                            <input class="form-control @error('mobile') is-invalid @enderror" type="text"
                                name="mobile" id="mobile" placeholder="Mobile" value="{{ $department->mobile }}" />
                            @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                         <div class="mb-3">
                            <label for="sort">Password</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="text"
                                name="password" id="password"/>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        {{-- <div class="mb-3">
                            <label for="sort">Sort Number</label>
                            <input class="form-control @error('sort_col') is-invalid @enderror" type="text"
                                name="sort_col" id="sort_col" placeholder="Sr No." value="{{ $department->sort_col }}" />
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
