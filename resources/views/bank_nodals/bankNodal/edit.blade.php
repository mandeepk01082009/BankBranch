@extends('bank_nodals.layout.app')

@section('styles')
@endsection

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <a href="{{ route('bank_nodals') }}"><button type="button" class="btn btn-primary" style="float: right;">Back</button></a>
                    <h6 class="mb-4">Edit Bank</h6>
                    <form action="{{ route('update_bank_nodal',$bank_nodal->id) }}" method="post">
                        @csrf
                        @method('PATCH')               

                        <input type="hidden" name="id" id="id" value="{{ $bank_nodal->id }}">  
                       
                        {{-- <div class="mb-3">
                            <label for="sort">Bank Name</label>
                            <input class="form-control @error('bank_name') is-invalid @enderror" type="text"
                                name="bank_name" id="bank_name" placeholder="Bank Name" value="{{ $bank_nodal->bank_name }}" />
                            @error('bank_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}
                        <div class="mb-3">
                            <label for="sort">DCO Name</label>
                            <input class="form-control @error('dco_name') is-invalid @enderror" type="text"
                                name="dco_name" id="dco_name" placeholder="DCO Name" value="{{ $bank_nodal->dco_name }}" />
                            @error('dco_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Mobile</label>
                            <input class="form-control @error('mobile') is-invalid @enderror" type="text"
                                name="mobile" id="mobile" placeholder="Mobile" value="{{ $bank_nodal->mobile }}" />
                            @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email"  id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $bank_nodal->email }}">
                            {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                            </div> --}}
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Password</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="text"
                                name="password" id="password" />
                            @error('password')
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
