@extends('department.layout.app')

@section('styles')
@endsection

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    {{-- <a href="{{ route('add_dept') }}"><button type="button" class="btn btn-primary" style="float: right;">Add</button></a> --}}
                    <h6 class="mb-4">Department</h6>
                    <div class="mt-3" style="margin-top: 10px;">
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    {{-- <th scope="col">Sr. No.</th> --}}
                                    <th scope="col">Department Name</th>
                                    <th scope="col">Contact Person</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($department as $department) --}}
                                    <tr>
                                        {{-- <th scope="row">1</th> --}}
                                        {{-- <td>{{ $department->sort_col }}</td> --}}
                                        <td>{{ $department->department_name }}</td>
                                        <td>{{ $department->contact_person }}</td>
                                        <td>{{ $department->email }}</td>
                                        <td>{{ $department->mobile }}</td>
                                        <td>{{ $department->is_active == 1 ? 'Active' : ''  }}</td>
                                        <td>{{ $department->created_at }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('edit_dept', $department->id) }}"
                                                class="btn btn-info btn-sm waves-effect" title='Edit'>
                                                <i class="fa fa-edit" style="font-size:20px">
                                                </i>
                                            </a>
                                            
                                            
                                            {{-- <form method="POST"
                                                action="{{ route('delete_dept', $department->id) }}">
                                                @csrf
                                                @method('delete')
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm waves-effect show_confirm"
                                                    data-toggle="tooltip" title='Delete'> <i class="fa fa-trash"
                                                        style="font-size:20px">
                                                    </i></button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                {{-- @endforeach --}}
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
