@extends('frontend.layout.master')
@section('title', 'Credit Monitoring System - Govt. of Punjab')
@section('desc', 'Credit Monitoring System - Govt. of Punjab')
@section('keywords', 'Credit Monitoring System - Govt. of Punjab')
@section('content')

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mt-0 wow fadeIn">
    <div class="container text-center">
        <h1 class="display-5 text-white animated slideInDown mb-4">Contact Us</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Contact Us</li>
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
                        <h2 class="mb-4 fs-4">Contact Us</h2>
                        <div class="row">
                            <div class="col-lg-12">
                                <address class="text-dark">
                                    <strong class="h6">Credit Monitoring System, Administrative Block</strong><br>
                                    Sector 76, SAS Nagar, Mohali - 160076<br>
                                    <strong>Tel No. Office:</strong> +91-172-2614031<br>
                                    <strong>Fax No. Office:</strong> +91-172-2614622<br>
                                    <strong>E-Mail:</strong> contact[at]punjab[dot]gov[dot]in
                                </address>
                            </div>
                        </div>
                        <hr>
                        <div class="row g-5">

                            <div class="col-lg-12">
                                <p class="mb-4 text-dark">If You Have Any Query, Please Contact Us</p>

                                <form>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0 bg-light" id="name" placeholder="Your Name">
                                                <label for="name">Your Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="email" class="form-control border-0 bg-light" id="email" placeholder="Your Email">
                                                <label for="email">Your Email</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0 bg-light" id="subject" placeholder="Subject">
                                                <label for="subject">Subject</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control border-0 bg-light" placeholder="Leave a message here" id="message" style="height: 150px"></textarea>
                                                <label for="message">Message</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary py-3 px-5" type="submit">Send Message</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-12">
                                <div class="position-relative h-100">
                                   
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