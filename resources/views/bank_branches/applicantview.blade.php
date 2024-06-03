@extends('bank_branches.layout.app')

@section('styles')
@endsection

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                     <a href="{{ route('filter-apply-loan') }}"><button type="button" class="btn btn-primary" style="float: right;">Back</button></a>
                    <div class="mt-3" style="margin-top: 10px;">
                        <div class="table-responsive">
                            <h1>Applicant Details</h1>

                            <table>
                                <tbody>
                                    <tr>
                                        <th>Name:</th>
                                        <td>{{ $applicant->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td>{{ $applicant->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mobile:</th>
                                        <td>{{ $applicant->phoneNumber }}</td>
                                    </tr>
                                    <tr>
                                        <th>Address:</th>
                                        <td>{{ $applicant->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>City:</th>
                                        <td>{{ $applicant->city }}</td>
                                    </tr>
                                    <tr>
                                        <th>PinCode:</th>
                                        <td>{{ $applicant->pincode }}</td>
                                    </tr>
                                    <tr>
                                        <th>Loan Description:</th>
                                        <td>{{ $applicant->loanDescription }}</td>
                                    </tr>
                                    <tr>
                                        <th>Loan Category:</th>
                                        <td>{{ $applicant->loan_category_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bank Name:</th>
                                        <td>{{ $applicant->bank_name }}</td>
                                    </tr>
                                    <tr>
                                      <th>Bank Branch:</th>
                                      <td>{{ $applicant->branch_address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status:</th>
                                        <td>{{ $applicant->status }}</td>
                                    </tr>
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
