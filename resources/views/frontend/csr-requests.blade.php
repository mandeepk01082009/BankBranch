@extends('frontend.layout.master')
@section('title', 'Credit Monitoring System - Govt. of Punjab')
@section('desc', 'Credit Monitoring System - Govt. of Punjab')
@section('keywords', 'Credit Monitoring System - Govt. of Punjab')
@section('content')
@section('styles')
@endsection

@section('content')
    <h1 class="text-center p-3">CSR Requests for {{ $category->csr_category_name }}</h1>

    <div class="container p-2">
        <div class="row">
            @foreach ($csrRequests as $request)
                <div class="col-sm-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $request->banner) }}" class="card-img-top" style="height:320px;"
                            alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $request->reason }}</h5>
                            <p class="card-text">{{ Str::limit($request->description, 110) }}</p>
                            <div class="d-flex justify-content-between">
                                <a class="small fw-medium" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $request->id }}">Donate
                                    Now<i class="fa fa-arrow-right ms-2"></i></a>
                                <!-- Button trigger modal -->

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop{{ $request->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Donate for {{ $request->reason }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="mb-3">
                                                        <label for="donarname"
                                                            class="form-label">Name</label>
                                                        <input type="name" class="form-control"
                                                            id="donarname">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Email
                                                            </label>
                                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                                            aria-describedby="emailHelp">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="mobile"
                                                            class="form-label">Phone No.</label>
                                                        <input type="text" class="form-control"
                                                            id="mobile">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="amount"
                                                            class="form-label">How many amount you want to donate?</label>
                                                        <input type="text" class="form-control"

                                                            id="amount">
                                                    </div>
                                                    {{-- <div class="mb-3 form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">Check me
                                                            out</label>
                                                    </div> --}}
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                            {{-- <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Understood</button>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>

                                <!-- Button to open modal -->
                                <a class="small fw-medium" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $request->id }}" href="#">View Details</a>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $request->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="card mb-8">
                                                        <div class="card-body pt-9 pb-9">
                                                            <div class="row g-9 align-items-center">

                                                                <div class="col-md-5 mb-6 position-relative">
                                                                    <img src="{{ asset('storage/' . $request->banner) }}"
                                                                        class="d-block w-100 rounded" alt="">
                                                                </div>

                                                                <div class="col-md-7">

                                                                    <h2 class="fw-bold text-gray-900 mb-8">
                                                                        {{ $request->reason }} <i
                                                                            class="fas  fa-fw text-success fs-5"></i></h2>
                                                                    <div style="text-align:justify;">
                                                                        {{ $request->description }}
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <a class="small fw-medium" href="auth/index.php">Apply Now<i
                                        class="fa fa-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                        {{-- <div class="card-footer bg-white">
                            Card footer
                          </div> --}}
                        <div class="d-flex justify-content-between py-4 bg-white card-footer">
                            <p class="mb-0">
                                <label class="mb-0 font-weight-700">Raised:</label> <span
                                    class="text-dark fw-bold">Rs.0</span>
                            </p>
                            <p class="mb-0">
                                <label class="mb-0 font-weight-700">Goal:</label> <span
                                    class="text-dark fw-bold">Rs.{{ $request->amount }}</span>
                            </p>
                        </div>

                    </div>
                </div>
            @endforeach
            {{-- <div class="col-sm-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $request->banner) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div> --}}
            {{-- <div class="col-sm-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $request->banner) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div> --}}
        </div>
    </div>

    {{-- <center>
        <table class="table table-bordered text-center mt-3" style="border: 1px solid; width:80%;">
            <thead>
                <tr>
                    <th scope="col">S/N</th>
                    <th scope="col">CSR Category</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Description</th>
                    <th scope="col">Banner</th>
                    <th scope="col">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($csrRequests as $request)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $request->csrCategory->csr_category_name }}</td>
                        <td>{{ $request->reason }}</td>
                        <td>
                            <textarea rows="6" cols="50">{{ $request->description }}</textarea>
                        </td>
                        <td><img src="{{ asset('storage/' . $request->banner) }}"
                                style="max-width: 150px; max-height:150px">
                        </td>
                        <td>{{ $request->amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </center> --}}

@stop
