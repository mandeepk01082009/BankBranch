@extends('department.layout.app')

@section('styles')
@endsection
{{-- 'csr_category_id',
 'details',
'estimated_expense', --}}
@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <a href="{{ route('addCsrRequest') }}"><button type="button" class="btn btn-primary" style="float: right;">Add</button></a>
                    <h6 class="mb-4">CSR Requests</h6>
                    <div class="mt-3" style="margin-top: 10px;">
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">S/N</th>
                                    <th scope="col">CSR Category</th>
                                    <th scope="col">Reason</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Banner</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                             
                                @foreach ($csr_request as $csr_requests)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $csr_requests->csrCategory->csr_category_name }}</td>
                                        <td>{{ $csr_requests->reason }}</td>
                                        <td><textarea rows="4">{{ $csr_requests->description }}</textarea></td>
                                        <td><img src="{{ asset('storage/' . $csr_requests->banner) }}" style="max-width: 150px; max-height:150px"></td>
                                        <td>{{ $csr_requests->amount }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('edit_csr_request', $csr_requests->id) }}"
                                                class="btn btn-info btn-sm waves-effect" title='Edit'>
                                                <i class="fa fa-edit" style="font-size:20px">
                                                </i>
                                            </a>
                                            <form method="POST"
                                                action="{{ route('delete_csr_request', $csr_requests->id) }}">
                                                @csrf
                                                @method('delete')
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm waves-effect show_confirm"
                                                    data-toggle="tooltip" title='Delete'> <i class="fa fa-trash"
                                                        style="font-size:20px">
                                                    </i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type="text/javascript">
        $('.show_confirm').click(function(e) {
            if (!confirm('Are you sure you want to delete this?')) {
                e.preventDefault();
            }
        });
    </script>
@endsection
