@extends('frontend.layout.master')
@section('title', 'Credit Monitoring System - Govt. of Punjab')
@section('desc', 'Credit Monitoring System - Govt. of Punjab')
@section('keywords', 'Credit Monitoring System - Govt. of Punjab')
<style>
    .verifyOtpButton, .resendOtpButton {
        width: 100%;
    }
</style>
@section('content')

    @php
        // Get the route URL with the placeholder for phoneNumber
        $verifyOtpRoute = route('verifyOtp', ['phoneNumber' => ':phoneNumber']);
    @endphp

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mt-0 wow fadeIn">
        <div class="container text-center">
            <h1 class="display-5 text-white animated slideInDown mb-4">Apply for Loan</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">Home</a></li>
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
                            <h2 class="fs-4 mb-4">Apply for Loan - OTP Verification</h2>
                            <div class="row">
                                <div class="col-md-12">
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
                                    @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                    <p>Applying for a loan involves several key steps to ensure a smooth process. Here's a form below to apply for a loan. Remember, it's essential to borrow responsibly and only take out a loan if you can afford to repay it.</p>
                                    <p><span class="text-danger">*</span> Kindly enter the OTP sent on your mobile +91 {{ $phoneNumber }}</p>
                                    <form action="{{ route('verifyOtp', ['phoneNumber' => $phoneNumber]) }}" method="post">
                                        @csrf
                                        <div class="mb-3 row">
                                            <label for="" class="col-sm-3 col-form-label">Enter OTP <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="otp" id="" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-sm-2">
                                                <button type="submit" class="btn btn-primary verifyOtpButton">Verify OTP</button>
                                            </div>
                                            <div class="col-sm-1"></div>
                                        </div>
                                    </form>
                                    <div class="mb-3 row">
                                        <div class="col-sm-2">
                                            <form action="{{ route('resendOtp') }}" method="post" id="resendOtpForm">
                                                @csrf
                                                <input type="hidden" name="phoneNumber" value="{{ $phoneNumber }}">
                                                <button type="submit" class="btn btn-success resendOtpButton">Resend OTP</button>
                                            </form>
                                        </div>
                                        <div class="col-sm-7"></div>
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

    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Core-js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/3.18.3/minified.js"></script>


    <script>
       $(document).ready(function() {
    // Handle the form submission
    $('.verifyOtpButton').click(function(e) {
        e.preventDefault();

        // Get the phoneNumber value
        var phoneNumber = '{{ $phoneNumber }}';

        // Serialize the form data
        var formData = $(this).closest('form').serialize();

        // Send the AJAX request with the CSRF token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '{{ $verifyOtpRoute }}'.replace(':phoneNumber', phoneNumber),
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.email) {
                    // Display a success alert
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        html: '<p>Email: ' + response.email + '</p>' +
                            '<p>Password: ' + response.password +
                            '</p>',
                        showCancelButton: true,
                        confirmButtonText: 'Login',
                        cancelButtonText: 'Close'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect to the redirect_url
                            window.location.href = response.redirect_url;
                        }
                    });
                } else {
                    // Email is null, redirect to apply-loan route
                    var message = 'Loan applied successfully.';
                    var url = '{{ route('apply-loan') }}' + '?message=' +
                        encodeURIComponent(message);
                    window.location.href = url;
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errorMessage = xhr.responseJSON.error;
                    alert(errorMessage);
                } else {
                    // Handle other errors
                    console.error('Error:', xhr.responseText);
                }
            }
        });
    });
});

    </script>


@stop
