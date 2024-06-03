@extends('applicants.layout.app')

@section('styles')
@endsection

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    {{-- <a href="{{ route('add_bank_nodal') }}"><button type="button" class="btn btn-primary" style="float: right;">Add</button></a> --}}
                    <h6 class="mb-4">List of Applicants that apply Loan</h6>
                    <div class="mt-3" style="margin-top: 10px;">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Bank Name</th>
                                        <th>Bank Branch</th>
                                        <th>Address</th>
                                        <th>Last Chat Date</th>
                                        <th>Last Chat By</th>
                                        <th>Status</th>
                                        {{-- <th>View</th> --}}
                                        <th>Chat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $serialNumber = 1; @endphp
                                    @foreach ($applicants as $applicant)
                                        <tr>
                                            <td>{{ $serialNumber }}</td>
                                            <td>{{ $applicant->name }}</td>
                                            <td>{{ $applicant->email }}</td>
                                            <td>{{ $applicant->phoneNumber }}</td>
                                            <td>{{ $applicant->bankNodal->bank_name }}</td>
                                            <td>{{ $applicant->bankBranches->branch_address }}</td>
                                            <td>{{ $applicant->address }}</td>
                                            <td>
                                                @if ($applicant->messages->count() > 0)
                                                    {{ $applicant->messages->last()->created_at->timezone('Asia/Kolkata')->format('M d, Y h:i A') }}
                                                @else
                                                    No messages yet
                                                @endif
                                            </td>
                                            <td>
                                                @if ($applicant->messages->count() > 0)
                                                    @php
                                                        $message = $applicant->messages->last();
                                                        if ($message->userType->id == 1) {
                                                            $name = DB::table('users')->where('id', $message->user_id)->value('name');
                                                        } elseif ($message->userType->id == 2) {
                                                            $name = DB::table('bank_nodals')->where('id', $message->user_id)->value('dco_name');
                                                        } elseif ($message->userType->id == 3) {
                                                            $name = DB::table('bank_branches')->where('id', $message->user_id)->value('concerned_person');
                                                        } elseif ($message->userType->id == 5) {
                                                            $name = DB::table('applys')->where('id', $message->applicant_id)->value('name');
                                                        }
                                                    @endphp
                                                    {{ $name }}({{ $message->userType->name ?? 'N/A' }})
                                                @else
                                                    No messages yet
                                                @endif
                                            </td>
                                           
                                            <td>{{ $applicant->status }}</td>
                                            {{-- <td>
                                                <form action="{{ route('applicant.view', ['applicant' => $applicant->id]) }}"
                                                    method="GET">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">View</button>
                                                </form>
                                            </td> --}}
                                            <td>
                                                <a href="{{ route('send_message', ['applicantId' => $applicant->id]) }}" class="btn btn-success">Chat</a>
                                            </td>
                                        </tr>
                                        @php $serialNumber++; @endphp
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
