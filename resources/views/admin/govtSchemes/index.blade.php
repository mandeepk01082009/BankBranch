@extends('admin.layout.app')

@section('styles')
@endsection

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <a href="{{ route('add_govt_scheme') }}"><button type="button" class="btn btn-primary" style="float: right;">Add</button></a>
                    <h6 class="mb-4">Govt Schemes</h6>
                    <div class="mt-3" style="margin-top: 10px;">
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Sr. No.</th>
                                    <th scope="col">Sceme Type</th>
                                    <th scope="col">Name of Departments</th>
                                    <th scope="col">Scheme</th>
                                    <th scope="col">Sub Scheme</th>
                                    <th scope="col">Sector</th>
                                    <th scope="col">Objective</th>
                                    <th scope="col">Beneficaries Type</th>
                                    <th scope="col">Grant</th>
                                    <th scope="col">Website URL</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($govt_schemes as $govt_scheme)
                                    <tr>
                                        {{-- <th scope="row">1</th> --}}
                                        <td>{{ $govt_scheme->sort_col }}</td>
                                        <td>{{ $govt_scheme->scheme_type }}</td>
                                        <td>{{ $govt_scheme->name_of_departments }}</td>
                                        <td>{{ $govt_scheme->scheme }}</td>
                                        <td>{{ $govt_scheme->sub_scheme }}</td>
                                        <td>{{ $govt_scheme->sector }}</td>
                                        <td><textarea rows="4">{{ $govt_scheme->objective }}</textarea></td>
                                        <td>{{ $govt_scheme->beneficaries_type }}</td>
                                        <td>{{ $govt_scheme->grant }}</td>
                                        <td>{{ $govt_scheme->website_url }}</td>
                                        <td>{{ $govt_scheme->status }}</td>
                                        {{-- <td>{{ $govt_scheme->status == 1 ? 'Active' : '' }}</td> --}}
                                        <td>{{ $govt_scheme->remark }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('edit_govt_scheme', $govt_scheme->id) }}"
                                                class="btn btn-info btn-sm waves-effect" title='Edit'>
                                                <i class="fa fa-edit" style="font-size:20px">
                                                </i>
                                            </a>
                                            <form method="POST"
                                                action="{{ route('delete_govt_scheme', $govt_scheme->id) }}">
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
