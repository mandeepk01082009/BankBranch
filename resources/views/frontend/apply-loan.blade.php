@extends('frontend.layout.master')
@section('title', 'Credit Monitoring System - Govt. of Punjab')
@section('desc', 'Credit Monitoring System - Govt. of Punjab')
@section('keywords', 'Credit Monitoring System - Govt. of Punjab')
@section('content')

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mt-0 wow fadeIn">
    <div class="container text-center">
        <h1 class="display-5 text-white animated slideInDown mb-4">Apply for Loan</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Apply for Loan</li>
            </ol>
        </nav>
    </div>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container-fluid bg-dark">
    <div class="container">
        <div class="row no-gutters d-flex align-items-center">
            <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-lg-block d-md-block d-sm-none d-none">
                <div class="topic-box">What's New</div>

            </div>
            <div class="col-lg-10 col-md-9 col-sm-8 col-12">
                <div class="feeding-text-dark">
                    <marquee class="news-scroll px-3" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                        <span class="dot"></span> <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </a>
                        <span class="dot"></span> <a href="#">Lorem ipsum dolor sit amet, consectetur.</a>
                    </marquee>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid wow fadeIn py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="fs-4 mb-4">Apply for Loan</h2>
                        <div class="row">
                            <div class="col-lg-12">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show border-0" role="alert">
                                        <strong>Great!</strong> Loan Applied Successfully.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif
                                    @if (session('warning'))
                                    <div class="alert alert-danger alert-dismissible fade show border-0" role="alert">
                                        <strong>Oops!</strong> Something went wrong. Please check!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif
                                </div>
                            <div class="col-md-12">
                                <p>Applying for a loan involves several key steps to ensure a smooth process. Here's a form below to apply for a loan. Remember, it's essential to borrow responsibly and only take out a loan if you can afford to repay it.</p>
                                <p><span class="text-danger">*</span> Denotes Mandatory Field</p>
                                 
                                    <form method="POST" action="{{route('saveApplyLoan')}}" enctype="multipart/form-data">
                                        @csrf
                                    <div class="mb-3 row">
                                        <label for="" class="col-sm-3 col-form-label">Name of Applicant <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{old('name')}}" name="name" id="name" placeholder="Full Name">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="" class="col-sm-3 col-form-label">Phone No. <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{old('phoneNumber')}}" name="phoneNumber" id="" placeholder="Write Phone no.">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" value="{{old('email')}}" name="email" id="" placeholder="Write Email ID">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="" class="col-sm-3 col-form-label">Address <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control mb-3" value="{{old('address')}}" name="address" id="" placeholder="Complete Address">
                                            <input type="text" class="form-control mb-3" value="{{old('landmark')}}" name="landmark" id="" placeholder="Landmark (if any)">
                                            <input type="text" class="form-control mb-3" value="{{old('state')}}" name="state" id="" placeholder="State">
                                            <input type="text" class="form-control mb-3" value="{{old('city')}}" name="city" id="" placeholder="City">
                                            <input type="text" class="form-control mb-3" value="{{old('pincode')}}" name="pincode" id="" placeholder="Pin Code">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="" class="col-sm-3 col-form-label">Detail of Loan Required <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="loanDescription" id="" cols="" rows="8" placeholder="Write about loan required">{{old('loanDescription')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="" class="col-sm-3 col-form-label">Bank to which apply <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="bankName" id="bank_name" class="form-select">
                                                <option value="">Choose</option>
                                                @foreach($banks as $bank)
                                                <option value="{{$bank->id}}">{{$bank->bank_name}}</option>
                                                @endforeach
                                                <!--<option value="">State Bank of India</option>-->
                                                <!--<option value="">Punjab National Bank</option>-->
                                                <!--<option value="">HDFC Bank</option>-->
                                                <!--<option value="">ICICI Bank</option>-->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="" class="col-sm-3 col-form-label">Branch of Bank <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="bankBranch" id="bank_branch" class="form-select">
                                                <option value="">Choose</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-primary">Apply for Loan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-3">
                @include('frontend/layout/aside')
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
 <script>
      $(document).ready(function() { 
        $(document).on('change', '#bank_name', function () {
        var bank_id=$(this).val();
         
        // console.log(bank_id);
        // Perform an AJAX request when the button is clicked
        $.ajax({
          url: "{{ route('get-bank-branches-by-bank-name') }}",
          method: "POST",
          data:{bank_id:bank_id},
          headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
          success: function (response) {
            // Handle the successful response
            console.log("Success:", response);
            $('#bank_branch').html(response);
          }
        });
      });
      });
      
      </script>

@stop