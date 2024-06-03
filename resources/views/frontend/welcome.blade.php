@extends('frontend.layout.master')
@section('title', 'Credit Monitoring System - Govt. of Punjab')
@section('desc', 'Credit Monitoring System - Govt. of Punjab')
@section('keywords', 'Credit Monitoring System - Govt. of Punjab')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 p-0">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/images/banner1.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/images/banner1.png" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
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

<div class="container-fluid pt-5 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mb-3">
                <div class="card">
                    <div class="card-header bg-dark">
                        <div class="card-title mb-0">
                            <p class="mb-0 text-white h5">Popular Schemes</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><a href="#" class="text-dark">Beti Bachao Beti Padhao</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#" class="text-dark">Deendayal Disabled Rehabilitation Scheme</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#" class="text-dark">Vocational Rehabilitation Centers</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#" class="text-dark">Financial Assistance to Widows and Destitute Women</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#" class="text-dark">Financial Assistance to Persons with Disabilities </a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#" class="text-dark">Indira Gandhi National Old Age Pension Schemes (IGNOAPS) </a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#" class="text-dark">State After Care Home</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#" class="text-dark">Scholarships to Students with Disabilities (Divyang)</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p class="mb-0"><a href="#" class="btn btn-primary btn-sm">View More</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-dark">
                        <div class="card-title mb-0">
                            <p class="mb-0 text-white h5">Circulars & Notifications</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <marquee behavior="scroll" direction="up" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();" style="height: 300px;">
                            <a href="#" class="text-dark py-2">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit, harum.
                                <p class="mb-0 mt-1 position-relative small"><i class="far fa-calendar-alt me-1"></i>12-11-2022 <span><img src="assets/images/new-blinking.gif" width="30" alt=""></span></p>
                            </a>
                            <hr>
                            <a href="#" class="text-dark py-2">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit, harum.
                                <p class="mb-0 mt-1 position-relative small"><i class="far fa-calendar-alt me-1"></i>11-11-2022 <span><img src="assets/images/new-blinking.gif" width="30" alt=""></span></p>
                            </a>
                            <hr>
                            <a href="#" class="text-dark py-2">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit, harum.
                                <p class="mb-0 mt-1 position-relative small"><i class="far fa-calendar-alt me-1"></i>12-10-2022</p>
                            </a>
                            <hr>
                            <a href="#" class="text-dark py-2">
                                Lorem ipsum dolor sit amet.
                                <p class="mb-0 mt-1 position-relative small"><i class="far fa-calendar-alt me-1"></i>19-08-2022</p>
                            </a>
                            <hr>
                            <a href="#" class="text-dark py-2">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit, harum.
                                <p class="mb-0 mt-1 position-relative small"><i class="far fa-calendar-alt me-1"></i>11-06-2022</p>
                            </a>
                            <hr>

                        </marquee>

                        <p class="pt-3 mb-0"><a href="#" class="btn btn-primary btn-sm">View More</a></p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <a href="{{url('/apply-loan')}}" class="btn btn-primary w-100 mb-3">Apply for Loan</a>
                <a href="{{url('/track-loan-status')}}" class="btn btn-secondary w-100">Track Your Loan Status</a>

                <div class="card mt-3">
                    <div class="card-header bg-dark">
                        <div class="card-title mb-0">
                            <p class="mb-0 text-white h5">Helpline Numbers</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Women's Helpline: 181, 1091</li>
                            <li class="list-group-item">Child Helpline: 1098</li>
                            <li class="list-group-item">Police: 100</li>
                            <li class="list-group-item">Fire: 101</li>
                            <li class="list-group-item">Ambulance: 108, 112</li>
                            <li class="list-group-item">Helpline for the Elderly - 14567 </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid bg-light pt-5 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-4">
                <h4 class="text-dark">Popular Categories</h4>
            </div>
            @foreach($category as $categories)
            <div class="col-lg-2">
                <a href="#">
                    <div class="card border-0 bg-blue text-white text-center">
                        <div class="card-body py-4">
                            <p><i class="fas fa-book-reader fa-3x"></i></p>
                            <span>{{ $categories->csr_category_name }}</span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            {{-- <div class="col-lg-2">
                <a href="#">
                    <div class="card border-0 bg-blue text-white text-center">
                        <div class="card-body py-4">
                            <p><i class="fas fa-book-reader fa-3x"></i></p>
                            <span>Education</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2">
                <a href="#">
                    <div class="card border-0 bg-green text-white text-center">
                        <div class="card-body py-4">
                            <p><i class="fas fa-home fa-3x"></i></p>
                            <span>Properties</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2">
                <a href="#">
                    <div class="card border-0 bg-red text-white text-center">
                        <div class="card-body py-4">
                            <p><i class="fas fa-first-aid fa-3x"></i></p>
                            <span>Medical</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2">
                <a href="#">
                    <div class="card border-0 bg-sky text-white text-center">
                        <div class="card-body py-4">
                            <p><i class="fas fa-tractor fa-3x"></i></p>
                            <span>Agriculture</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2">
                <a href="#">
                    <div class="card border-0 bg-purple text-white text-center">
                        <div class="card-body py-4">
                            <p><i class="fas fa-child fa-3x"></i></p>
                            <span>Women & Child</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2">
                <a href="#">
                    <div class="card border-0 bg-yellow text-white text-center">
                        <div class="card-body py-4">
                            <p><i class="fas fa-wheelchair fa-3x"></i></p>
                            <span>Divyang</span>
                        </div>
                    </div>
                </a>
            </div> --}}
        </div>
    </div>
</div>

<div class="container-fluid py-5 mb-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header bg-dark">
                        <div class="card-title mb-0">
                            <p class="mb-0 text-white h5">Applications Invited by Govt.</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="#" class="text-dark py-2">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit, harum.
                                                <p class="mb-0 mt-1 position-relative small"><i class="far fa-calendar-alt me-1"></i>12-11-2022 <span><img src="assets/images/new-blinking.gif" width="30" alt=""></span></p>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#" class="text-dark py-2">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit, harum.
                                                <p class="mb-0 mt-1 position-relative small"><i class="far fa-calendar-alt me-1"></i>12-11-2022</p>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#" class="text-dark py-2">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit, harum.
                                                <p class="mb-0 mt-1 position-relative small"><i class="far fa-calendar-alt me-1"></i>12-11-2022</p>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#" class="text-dark py-2">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit, harum.
                                                <p class="mb-0 mt-1 position-relative small"><i class="far fa-calendar-alt me-1"></i>12-11-2022</p>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#" class="text-dark py-2">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit, harum.
                                                <p class="mb-0 mt-1 position-relative small"><i class="far fa-calendar-alt me-1"></i>12-11-2022</p>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p class="mb-0"><a href="#" class="btn btn-primary btn-sm">View More</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 h-100">
                    <div class="card-header bg-dark">
                        <div class="card-title mb-0 py-1">
                            <p class="mb-0 text-white h5">Other Related Links</p>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group">
                            <a href="#" class="text-dark list-group-item list-group-item-action"><i class="fas fa-hand-point-right me-2"></i> Pension Portal</a>
                            <a href="#" class="text-dark list-group-item list-group-item-action"><i class="fas fa-hand-point-right me-2"></i> ICDS - Schemes for Adolescent Girls</a>
                            <a href="#" class="text-dark list-group-item list-group-item-action"><i class="fas fa-hand-point-right me-2"></i> Public Grievances Portal</a>
                            <a href="#" class="text-dark list-group-item list-group-item-action"><i class="fas fa-hand-point-right me-2"></i> Ministry of Social Justice and Empowerment</a>
                            <a href="#" class="text-dark list-group-item list-group-item-action"><i class="fas fa-hand-point-right me-2"></i> Ministry of Women and Child Development</a>
                            <a href="#" class="text-dark list-group-item list-group-item-action"><i class="fas fa-hand-point-right me-2"></i> PMMVY : PM Matru Vandana Yojana</a>
                            <a href="#" class="text-dark list-group-item list-group-item-action"><i class="fas fa-hand-point-right me-2"></i> Senior Citizen Pension</a>
                            <a href="#" class="text-dark list-group-item list-group-item-action"><i class="fas fa-hand-point-right me-2"></i> Widow Pension Schemes</a>
                            <a href="#" class="text-dark list-group-item list-group-item-action"><i class="fas fa-hand-point-right me-2"></i> Lorem ipsum dolor sit amet consectetur</a>
                            <a href="#" class="text-dark list-group-item list-group-item-action"><i class="fas fa-hand-point-right me-2"></i> Lorem ipsum dolor sit</a>
                            <a href="#" class="text-dark list-group-item list-group-item-action"><i class="fas fa-hand-point-right me-2"></i> Widow Pension/Loan Schemes</a>
                            <a href="#" class="text-dark list-group-item list-group-item-action"><i class="fas fa-hand-point-right me-2"></i> PM Kisan Samridhi Yojna</a>
                            <a href="#" class="text-dark list-group-item list-group-item-action"><i class="fas fa-hand-point-right me-2"></i> PM Kisan Samridhi Nidhi Yojna</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-body p-1 text-center">
                        <p class="mb-1">Advertisment Here</p>
                        <img src="assets/images/ad1.jpg" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="card">
                    <div class="card-body p-1 text-center">
                        <p class="mb-1">Advertisment Here</p>
                        <img src="assets/images/ad2.jpg" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid bg-light py-5 mb-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-4">
                <h4 class="text-dark">CSR Initiatives</h4>
            </div>
        </div>
        <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
            <div class="col text-center">
                <img src="assets/images/scheme1.jpg" class="img-thumbnail rounded-circle" width="160" alt="">
                <p class="text-dark h6 my-3">Schemes for<br>Children</p>
                <a href="#" class="btn btn-dark btn-sm">View More</a>
            </div>
            <div class="col text-center">
                <img src="assets/images/scheme2.jpg" class="img-thumbnail rounded-circle" width="160" alt="">
                <p class="text-dark h6 my-3">Schemes for<br>Women</p>
                <a href="#" class="btn btn-dark btn-sm">View More</a>
            </div>
            <div class="col text-center">
                <img src="assets/images/scheme3.jpg" class="img-thumbnail rounded-circle" width="160" alt="">
                <p class="text-dark h6 my-3">Schemes for<br>Senior Citizens</p>
                <a href="#" class="btn btn-dark btn-sm">View More</a>
            </div>
            <div class="col text-center">
                <img src="assets/images/scheme4.jpg" class="img-thumbnail rounded-circle" width="160" alt="">
                <p class="text-dark h6 my-3">Schemes for Persons<br>with Disabilities</p>
                <a href="#" class="btn btn-dark btn-sm">View More</a>
            </div>
            <div class="col text-center">
                <img src="assets/images/scheme5.jpg" class="img-thumbnail rounded-circle" width="160" alt="">
                <p class="text-dark h6 my-3">Pensions & Other Financial Assistance</p>
                <a href="#" class="btn btn-dark btn-sm">View More</a>
            </div>
        </div>
    </div>
</div>
@stop