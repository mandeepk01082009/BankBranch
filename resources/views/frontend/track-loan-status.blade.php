@extends('frontend.layout.master')
@section('title', 'Credit Monitoring System - Govt. of Punjab')
@section('desc', 'Credit Monitoring System - Govt. of Punjab')
@section('keywords', 'Credit Monitoring System - Govt. of Punjab')
@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mt-0 wow fadeIn">
        <div class="container text-center">
            <h1 class="display-5 text-white animated slideInDown mb-4">Track Loan Status</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Track Loan Status</li>
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
                        <marquee class="news-scroll px-3" behavior="scroll" direction="left" onmouseover="this.stop();"
                            onmouseout="this.start();">
                            <span class="dot"></span> <a href="#">Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit. </a>
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
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <h2 class="fs-4 mb-4">Track Loan Status</h2>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><span class="text-danger">*</span> Denotes Mandatory Fields</p>
                                    <form action="{{ route('show-loan-status') }}" method="POST">
                                        @csrf
                                        {{-- <div class="col-md-12">
                                        <div class="alert alert-danger" role="alert">
                                            Phone No. entered is not in our database.
                                        </div>
                                    </div> --}}
                                        {{-- <div class="mb-3 row">
                                        <label for="" class="col-sm-3 col-form-label">Application ID <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="" placeholder="">
                                        </div>
                                    </div> --}}
                                        <div class="mb-3 row">
                                            <label for="" class="col-sm-3 col-form-label">Mobile No. <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id=""
                                                    placeholder="Mobile No." name="phoneNumber">
                                            </div>   
                                        </div>

                                        {{-- @if ($errors->has('phoneNumber'))
                                        <span class="text-danger">{{ $errors->first('phoneNumber') }}</span>
                                    @endif   --}}

                                        {{-- <div class="captcha">
                                        <div class="mb-3 row">
                                            <label for="" class="col-sm-3 col-form-label">Enter Captcha<span
                                                class="text-danger">*</span></label>
                                           
                                            <div class="col-sm-9">
                                            <div class="preview"></div>
                                            <div class="captcha-form">
                                              
                                                <input type="text" id="captcha-form"  placeholder="Enter captcha text" required>
                                                <span class="captcha-refresh">
                                                    <i class="fa fa-refresh"
                                                        style="margin-top: 12px; margin-left: 10px;"></i>
                                                </span>
                                            </div>
                                            <div class="captchaError"  style="color: red; display: none;">
                                                Please fill in the correct captcha to apply for loan.
                                            </div>
                                        </div>
                                    </div>
                                    </div> --}}

                                        <div class="mb-3 row">
                                            <label for="" class="col-sm-3 col-form-label">Captcha <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <div class="captcha">
                                                    <span>{!! captcha_img() !!}</span>
                                                    <button type="button" class="btn btn-danger reload">
                                                        &#x21bb;
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"
                                                    placeholder="Enter Captcha" name="captcha">
                                            </div>
                                            {{-- @if ($errors->has('captcha'))
                                            <span class="text-danger">{{ $errors->first('captcha') }}</span>
                                        @endif      --}}
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-lg-12">
                                                <button type="submit" class="btn btn-primary loginBtn">Submit Form</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                {{-- <div class="col-md-12">
                                <div class="alert alert-success" role="alert">
                                    Your application ID is: <strong>SP-123456</strong> is in under process.
                                </div>
                            </div> --}}
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

    <script type="text/javascript">
        $('.reload').click(function() {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>

@stop
