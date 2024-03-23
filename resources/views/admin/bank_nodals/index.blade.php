@extends('admin.layout.app')

@section('styles')
@endsection

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <a href="{{ route('add-bank-nodal') }}"><button type="button" class="btn btn-primary" style="float: right;">Add</button></a>
                    <h6 class="mb-4">Bank Nodals</h6>
                    <div class="mt-3" style="margin-top: 10px;">
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Sr. No.</th>
                                    <th scope="col">Bank Name</th>
                                    <th scope="col">DCO Name</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bank_nodal as $bank_nodals)
                                    <tr>
                                        {{-- <th scope="row">1</th> --}}
                                        <td>{{ $bank_nodals->sort_col }}</td>
                                        <td>{{ $bank_nodals->bank_name }}</td>
                                        <td>{{ $bank_nodals->dco_name }}</td>
                                        <td>{{ $bank_nodals->mobile }}</td>
                                        <td>{{ $bank_nodals->email }}</td>
                                        <td>{{ $bank_nodals->is_active == 1 ? 'Active' : ''  }}</td>
                                        <td>{{ $bank_nodals->created_at }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('edit-bank-nodal', $bank_nodals->id) }}"
                                                class="btn btn-info btn-sm waves-effect" title='Edit'>
                                                <i class="fa fa-edit" style="font-size:20px">
                                                </i>
                                            </a>
                                            
                                            
                                            <form method="POST"
                                                action="{{ route('delete-bank-nodal', $bank_nodals->id) }}">
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
