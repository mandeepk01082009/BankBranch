@extends('frontend.layout.master')
{{-- @section('title', 'Credit Monitoring System - Govt. of Punjab')
@section('desc', 'Credit Monitoring System - Govt. of Punjab')
@section('keywords', 'Credit Monitoring System - Govt. of Punjab') --}}

@section('content')
    <div class="ms-5">
        <h1 class="">Loan Status</h1>

        @if (isset($applyLoans) && count($applyLoans) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Loan Description</th>
                        <th>Bank Name</th>
                        <th>Bank Branch</th>
                        <th>Status</th>
                        <th>OTP Verified</th>
                        <th>Communication</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applyLoans as $applyLoan)
                        <tr>
                            <td>{{ $applyLoan->name }}</td>
                            <td>{{ $applyLoan->email }}</td>
                            <td>{{ $applyLoan->phoneNumber }}</td>
                            <td>{{ $applyLoan->address }}</td>
                            <td>{{ $applyLoan->loanDescription }}</td>
                            <td>{{ $applyLoan->bank_name }}</td>
                            <td>{{ $applyLoan->branch_address }}</td>
                            <td>{{ $applyLoan->status }}</td>
                            <td>
                                @if ($applyLoan->otp !== null)
                                    Verified
                                @else
                                    Not Verified
                                @endif
                            </td>
                             
                            <td>
                                <a href="{{ route('messSend', ['applicantId' => $applyLoan->id]) }}"
                                    class="btn btn-success">Chat</a>
                                {{-- @if ($applyLoan->otp !== null)
                                    <a href="https://www.example.com" target="_blank" class="btn btn-success">Go to chat</a>
                                @else
                                    <a href="#" id="communication-link-{{ $applyLoan->id }}"
                                        class="btn btn-primary">Verify OTP</a>
                                    <script>
                                        document.getElementById('communication-link-{{ $applyLoan->id }}').addEventListener('click', function(event) {
                                            event.preventDefault();
                            
                                            // Send an AJAX request to the server to update the user's OTP field
                                            $.ajax({
                                                url: '{{ route('updateOtp') }}',
                                                method: 'POST',
                                                dataType: 'json', // Add this line
                                                data: {
                                                    phoneNumber: '{{ $applyLoan->phoneNumber }}',
                                                    otp: '4321', // Set the new OTP value here
                                                    _token: '{{ csrf_token() }}'
                                                },
                                                success: function(response) {
                                                    if (response.success) {
                                                        // Redirect the user to the desired URL after the OTP has been updated
                                                        window.location.href =
                                                            '{{ route('applyLoanOtp', ['phoneNumber' => $applyLoan->phoneNumber]) }}';
                                                    }
                                                }
                                            });
                                        });
                                    </script>
                                @endif --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No loan applications found.</p>
        @endif
    </div>

@stop
