@extends('admin.layout.app')

@section('styles')
@endsection

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <a href="{{ route('advertisement_rates') }}"><button type="button" class="btn btn-primary" style="float: right;">Back</button></a>
                    <h6 class="mb-4">Add Advertisement Rate</h6>
                    <form action="{{ route('store_advertisement_rate') }}" method="post">
                        @csrf      
                        <div class="mb-3">
                            <label for="sort">Advertisement Slot</label>
                            <input class="form-control @error('advertisement_slot') is-invalid @enderror" type="text"
                                name="advertisement_slot" id="advertisement_slot" placeholder="Advertisement Slot" />
                            @error('advertisement_slot')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Minimum Days</label>
                            <input class="form-control @error('minimum_days') is-invalid @enderror" type="text"
                                name="minimum_days" id="minimum_days" placeholder="Minimum Days" />
                            @error('minimum_days')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="per_day_rate" class="form-label">Per Day Rate</label>
                            <input type="text" class="form-control @error('per_day_rate') is-invalid @enderror" name="per_day_rate" placeholder="Per Day Rate"  id="exampleInputper_day_rate1" aria-describedby="per_day_rateHelp">
                            @error('per_day_rate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Size</label>
                            <input class="form-control @error('size') is-invalid @enderror" type="text"
                                name="size" id="size" placeholder="Size" />
                            @error('size')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                       
                        <div class="mb-3">
                            <label for="sort">Sort Number</label>
                            <input class="form-control @error('sort_col') is-invalid @enderror" type="text"
                                name="sort_col" id="sort_col" placeholder="Sr No." />
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
