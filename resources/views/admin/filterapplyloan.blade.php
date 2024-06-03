@extends('admin.layout.app')

@section('styles')
@endsection

@section('content')

@if (session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                {{-- <a href="{{ route('add_bank_nodal') }}"><button type="button" class="btn btn-primary" style="float: right;">Add</button></a> --}}
                <h6 class="mb-4">List of Applicants that apply Loan</h6>
                <!-- Search and Filter Form -->
                <form id="filterForm" action="{{ route('filterapplyloanapplications') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="status">Status:</label>
                            <select name="status" id="status" class="form-select">
                                <option value="">All</option>
                                <option value="Verified" {{ request()->query('status') == 'Verified' ? 'selected' : '' }}>Verified</option>
                                <option value="In Process" {{ request()->query('status') == 'In Process' ? 'selected' : '' }}>In Process</option>
                                <option value="Send back to user" {{ request()->query('status') == 'Send back to user' ? 'selected' : '' }}>Send back to user</option>
                                <option value="Approved" {{ request()->query('status') == 'Approved' ? 'selected' : '' }}>Approved</option>
                                <option value="Rejected" {{ request()->query('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="last_chat_date">Last chat date:</label>
                            <input type="date" name="created_at" id="last_chat_date" class="form-control" value="{{ request()->query('created_at') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="apply_date">Apply date:</label>
                            <input type="date" name="apply_date" id="apply_date" class="form-control" value="{{ request()->query('apply_date') }}">
                        </div>
                        <!-- <div class="col-md-3">
                            <label for="search">Search:</label>
                            <input type="text" name="search" id="search" class="form-control" value="{{ request()->query('search') }}">
                        </div> -->
                        <div class="col-md-2 mt-4">
                            <!-- Remove the submit button -->
                            <button type="reset" id="resetBtn" class="btn btn-danger">Reset</button>
                        </div>
                    </div>
                </form>
                @if ($applyloan->isEmpty())
                <div class="alert alert-info mt-5">No records found.</div>
                @else
                <div filtered-applications class="mt-3" style="margin-top: 10px;">
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
                                    <th>Apply Date</th>
                                    <th>Last Chat Date</th>
                                    <th>Last Chat By</th>
                                    <th>Status</th>
                                    <th>View</th>
                                    <th>Chat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $serialNumber = 1; @endphp
                                @foreach ($applyloan as $applicant)
                                <tr>
                                    <td>{{ $serialNumber }}</td>
                                    <td>{{ $applicant->name }}</td>
                                    <td>{{ $applicant->email }}</td>
                                    <td>{{ $applicant->phoneNumber }}</td>
                                    <td>{{ $applicant->bankNodal->bank_name }}</td>
                                    <td>{{ $applicant->bankBranches->branch_address }}</td>
                                    <td>{{ $applicant->address }}</td>
                                    <td>{{ $applicant->created_at->timezone('Asia/Kolkata')->format('M d, Y h:i A') }}</td>
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
                                            @if ($message->userType->id != 1)
                                                {{ $name }}({{ $message->userType->name ?? 'N/A' }})
                                            @else
                                                {{ $name }}
                                            @endif
                                        @else
                                            No messages yet
                                        @endif
                                    </td>
                                    
                                    <td>{{ $applicant->status }}</td>
                                    <td>
                                        <form action="{{ route('applicant_view', ['applicant' => $applicant->id]) }}" method="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">View</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('message_send', ['applicantId' => $applicant->id]) }}" class="btn btn-success">Chat</a>
                                    </td>
                                </tr>
                                @php $serialNumber++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                        {{ $applyloan->links() }}

                    </div>
                </div>
                @endif
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

<!-- Add JavaScript to set the selected value after the page reloads -->
<script>
    // Set the initial value of the last_chat_date input field
    document.addEventListener('DOMContentLoaded', function() {
        var created_at = '{{ request()->query('
        created_at ') }}';
        if (created_at) {
            document.getElementById('last_chat_date').value = created_at;
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
    // Function to update the disabled state of the reset button
    function updateResetButton() {
        var isEmpty = $('#status').val() == '' && $('#last_chat_date').val() == '' && $('#apply_date').val() == '';
        $('#resetBtn').prop('disabled', isEmpty);
    }

    // Listen for changes in the form fields
    $('#filterForm').on('change input', 'input, select', function() {
        // Automatically submit the form
        $('#filterForm').submit();
        // Update the disabled state of the reset button
        updateResetButton();
    });

    // Listen for click on the reset button
    $('#resetBtn').click(function() {
        // Set the status field to "All"
        $('#status').val('');

        // Clear other field values
        $('#last_chat_date').val('');
        $('#apply_date').val('');

        // Update the disabled state of the reset button
        updateResetButton();

        // Automatically submit the form
        $('#filterForm').submit();
    });

    // Initial state of the reset button
    updateResetButton();
});

</script>

@endsection