@extends('admin.layout.app')

@section('styles')
@endsection

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <a href="{{ route('departments') }}"><button type="button" class="btn btn-primary" style="float: right;">Back</button></a>
                    <h6 class="mb-4">Add Department</h6>
                    <form action="{{ route('store_department') }}" method="post">
                        @csrf
                       
                        <div class="mb-3">
                            <label for="sort">Department Name</label>
                            <input class="form-control @error('department_name') is-invalid @enderror" type="text"
                                name="department_name" id="department_name" placeholder="Department Name" />
                            @error('department_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Contact Person</label>
                            <input class="form-control @error('contact_person') is-invalid @enderror" type="text"
                                name="contact_person" id="contact_person" placeholder="Contact Person" />
                            @error('contact_person')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"" name="email" placeholder="Email"  id="exampleInputEmail1" aria-describedby="emailHelp">
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
                            <input class="form-control @error('contact') is-invalid @enderror" type="text"
                                name="contact" id="contact" placeholder="Contact" />
                            @error('contact')
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
