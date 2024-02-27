@extends('admin.layout.app')

@section('styles')
@endsection

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <a href="{{ route('bank_branches') }}"><button type="button" class="btn btn-primary" style="float: right;">Back</button></a>
                    <h6 class="mb-4">Edit Bank</h6>
                    <form action="{{ route('update_bank_branch',$bank_branch->id) }}" method="post">
                        @csrf
                        @method('PATCH')               

                        <input type="hidden" name="id" id="id" value="{{ $bank_branch->id }}">  
                       
                        <div class="mb-3">
                            <label for="sort">Bank Name</label>
                            <select class="form-select" name="bank_id" >  
                                <option value="">Choose Bank</option>
                                @foreach($bank as $banks)
                                <option value="{{$banks->id}}" @if($banks->id == $bank_branch->bank_id) selected @endif>{{$banks->bank_name}}</option>
                             @endforeach    
                                   
                            </select>
                            @error('bank_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Branch Address</label>
                            <input class="form-control @error('branch_address') is-invalid @enderror" type="text"
                                name="branch_address" id="branch_address" placeholder="Branch Address" value="{{ $bank_branch->branch_address }}" />
                            @error('branch_address')   
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Concerned Person</label>
                            <input class="form-control @error('concerned_person') is-invalid @enderror" type="text"
                                name="concerned_person" id="concerned_person" placeholder="Concerned Person" value="{{ $bank_branch->concerned_person }}" />
                            @error('concerned_person')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Mobile</label>
                            <input class="form-control @error('mobile') is-invalid @enderror" type="text"
                                name="mobile" id="mobile" placeholder="Mobile" value="{{ $bank_branch->mobile }}" />
                            @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $bank_branch->email }}"placeholder="Email"  id="exampleInputEmail1" aria-describedby="emailHelp">
                            {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                            </div> --}}
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                       
                       
                        <div class="mb-3">
                            <label for="sort">Sort Number</label>
                            <input class="form-control @error('sort_col') is-invalid @enderror" type="text"
                                name="sort_col" id="sort_col" placeholder="Sr No." value="{{ $bank_branch->sort_col }}" />
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
