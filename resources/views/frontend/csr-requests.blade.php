@extends('frontend.layout.master')
@section('title', 'Credit Monitoring System - Govt. of Punjab')
@section('desc', 'Credit Monitoring System - Govt. of Punjab')
@section('keywords', 'Credit Monitoring System - Govt. of Punjab')
@section('content')
@section('styles')
@endsection

@section('content')
<h1 class="text-center mt-3">CSR Requests for {{ $category->csr_category_name }}</h1>
<center>
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
                <td><img src="{{ asset('storage/' . $request->banner) }}" style="max-width: 150px; max-height:150px">
                </td>
                <td>{{ $request->amount }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</center>

@stop
