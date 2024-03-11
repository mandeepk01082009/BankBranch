@extends('frontend.layout.master')
@section('title', 'Credit Monitoring System - Govt. of Punjab')
@section('desc', 'Credit Monitoring System - Govt. of Punjab')
@section('keywords', 'Credit Monitoring System - Govt. of Punjab')
@section('content')

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mt-0 wow fadeIn">
    <div class="container text-center">
        <h1 class="display-5 text-white animated slideInDown mb-4">About Us</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">About Us</li>
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
                        <h2 class="fs-4 mb-4">About Us</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Non repellat perferendis voluptatem quibusdam libero, eius sapiente sed? Quam omnis suscipit dolores quas, animi qui aperiam rerum nisi fuga id. Quisquam necessitatibus, vitae, rem aspernatur autem unde officia suscipit impedit nisi quis velit atque laborum architecto.</p>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facilis quia magni deserunt sunt numquam, voluptas nulla ducimus eaque perferendis accusantium. Expedita recusandae assumenda nesciunt iusto labore dolores obcaecati nulla enim soluta velit dignissimos quisquam repellendus, consectetur atque facilis, repudiandae in temporibus consequuntur excepturi esse est sapiente nemo. Asperiores, accusantium quas, repellendus eligendi sunt incidunt cum voluptatum deserunt ea quis eveniet veniam, minima aspernatur modi tempora? Autem ipsa quas, soluta ab corporis ipsam illo iure eveniet nobis!</p>
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