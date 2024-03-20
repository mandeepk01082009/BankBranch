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
                        <h2 class="fs-4 mb-4">Apply for Loan - OTP Verification</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <p>Applying for a loan involves several key steps to ensure a smooth process. Here's a form below to apply for a loan. Remember, it's essential to borrow responsibly and only take out a loan if you can afford to repay it.</p>
                                <p><span class="text-danger">*</span> Kindly enter the OTP sent on your mobile +91 98XXX XXX32</p>
                                <form action="#">
                                    <div class="mb-3 row">
                                        <label for="" class="col-sm-3 col-form-label">Enter OTP <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="" placeholder="">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-primary">Submit Application</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12">
                                <div class="alert alert-success" role="alert">
                                    Your application has been submitted successfully. We will get in touch with you soon on your registered mobile number. Your application ID is: <strong>SP-123456</strong>
                                </div>
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


@stop