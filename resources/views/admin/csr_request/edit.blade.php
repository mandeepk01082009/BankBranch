@extends('admin.layout.app')

@section('styles')
@endsection

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <a href="{{ route('csr_requests') }}"><button type="button" class="btn btn-primary" style="float: right;">Back</button></a>
                    <h6 class="mb-4">Update CSR Request</h6>
                    <form action="{{ route('update_csr_request',$csr_request->id) }}" method="post">
                        @csrf
                        @method('PATCH')               

                        <input type="hidden" name="id" id="id" value="{{ $csr_request->id }}">  
                       
                        <div class="mb-3">
                            <label for="sort">Department Name</label>
                            <select class="form-select" name="department_id">
                                <option value="">Choose Department</option>
                                @foreach ($department as $departments)
                                    <option value="{{ $departments->id }}" @if($departments->id  == $csr_request->department_id) selected @endif>{{ $departments->department_name }}</option>
                                @endforeach

                            </select>
                            @error('department_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Name of CSR Category</label>
                            <select class="form-select" name="csr_category_id">
                                <option value="">Choose CSR Category</option>
                                @foreach ($csr_category as $csr_categories)
                                    <option value="{{ $csr_categories->id }}" @if($csr_categories->id  == $csr_request->csr_category_id) selected @endif>{{ $csr_categories->csr_category_name }}</option>
                                @endforeach

                            </select>
                            @error('csr_category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="objective" class="form-label">Details</label>
                            <textarea id="details" placeholder="Details" type="text" class="form-control"
                                rows="4" name="details" autocomplete="details" autofocus>{{ $csr_request->details }} </textarea>
                            @error('details')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Estimated Expense</label>
                            <input class="form-control @error('estimated_expense') is-invalid @enderror" type="text"
                                name="estimated_expense" id="estimated_expense" value="{{ $csr_request->estimated_expense }} placeholder="Estimated Expense" />
                            @error('estimated_expense')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sort">Sort Number</label>
                            <input class="form-control @error('sort_col') is-invalid @enderror" type="text"
                                name="sort_col" id="sort_col" placeholder="Sr No." value="{{ $csr_request->sort_col }}" />
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
