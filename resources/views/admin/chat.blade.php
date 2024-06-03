<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Credit Monitoring System</title>

</head>

<body class="bg-light">

    <div class="container p-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Chat
                        <a href="{{ route('filterapplyloanapplications') }}"><button type="button"
                                class="btn btn-primary" style="float: right;">Back</button></a>
                    </div>


                    <div class="card-body">
                        {{-- @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif --}}
                        {{-- <div class="messageDiv" style="width: 400px"> --}}
                        <ul id="messages" class="list-unstyled">
                            @foreach ($messages as $message)
                                <li style="display: flex; justify-content: space-between;">
                                    <div>
                                        @php
                                            if ($message->userType->id == 1) {
                                                $name = DB::table('users')
                                                    ->where('id', $message->user_id)
                                                    ->value('name');
                                            } elseif ($message->userType->id == 2) {
                                                $name = DB::table('bank_nodals')
                                                    ->where('id', $message->user_id)
                                                    ->value('dco_name');
                                            } elseif ($message->userType->id == 3) {
                                                $name = DB::table('bank_branches')
                                                    ->where('id', $message->user_id)
                                                    ->value('concerned_person');
                                            } elseif ($message->userType->id == 5) {
                                                $name = DB::table('applys')
                                                    ->where('id', $message->applicant_id)
                                                    ->value('name');
                                            }
                                        @endphp

                                        @if ($message->userType->id != 1)
                                            <strong>{{ $name }}({{ $message->userType->name ?? 'N/A' }})</strong>
                                        @else
                                            <strong>{{ $name }}</strong>
                                        @endif

                                        {{ $message->text }}
                                        @if (!empty(json_decode($message->file, true)))
                                            <ul>
                                                @foreach (json_decode($message->file, true) as $file)
                                                    @if (!is_null($file))
                                                        <li>
                                                            <a href="{{ asset('storage/' . $file) }}"
                                                                target="_blank">{{ $file }}</a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @elseif (!empty($message->file))
                                            <ul>
                                                <li>
                                                    <a href="{{ asset('storage/' . $message->file) }}"
                                                        target="_blank">{{ $message->file }}</a>
                                                </li>
                                            </ul>
                                        @endif
                                    </div>
                                    <div
                                        style="margin-left: 20px; font-size:12px; color:rgb(110, 110, 110); white-space: nowrap;">
                                        <div>
                                            {{ $message->created_at->timezone('Asia/Kolkata')->format('M d, Y h:i A') }}
                                        </div>
                                        <div style="color: black;"> Status: {{ $applicantStatus }} </div>
                                    </div>
                                </li>
                                <li style="height: 1px; background-color: #f2f2f2; margin: 10px 0;"></li>
                            @endforeach
                        </ul>

                        @php
                            $hasApprovedOrRejectedMessage = $messages
                                ->whereIn('status', ['Approved', 'Rejected'])
                                ->isNotEmpty();
                        @endphp

                        @if (!$hasApprovedOrRejectedMessage)
                            <form id="admin-message-form" method="POST"
                                action="{{ route('message_store', $applicantId) }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <textarea id="admin-message" name="text" class="form-control" rows="3" placeholder="Type your message here...">{{ old('text') }}</textarea>
                                    @error('text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mt-3">
                                    <input type="file" id="admin-file" name="file[]" class="form-control" multiple>
                                    @error('file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="invalid-feedback" id="admin-field-error" style="display: none;"><strong>
                                        Please
                                        fill in
                                        either the text or the file field.</strong></div>


                                <div class="form-group mt-3">
                                    <select class="form-select" name="status" id="status"
                                        aria-label="Default select example" required>
                                        <option value="">Please Select Loan Status</option>
                                        <option value="In Process">In Process</option>
                                        <option value="Send back to user">Send back to user</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div id="status-error" class="invalid-feedback" style="display: none;">
                                        <strong>Please select a loan status.</strong></div>
                                </div>

                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-primary sendMessage">Send</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <script>
        document.getElementById('admin-message-form').addEventListener('submit', function(event) {
            var status = document.getElementById('status').value.trim();
            var text = document.getElementById('admin-message').value.trim();
            var file = document.getElementById('admin-file').value.trim();

            if (!status || (!text && !file)) {
                event.preventDefault();

                if (!status) {
                    document.getElementById('status-error').style.display = 'block';
                }

                if (!text && !file) {
                    document.getElementById('admin-field-error').style.display = 'block';
                }
            } else {
                document.getElementById('status-error').style.display = 'none';
                document.getElementById('admin-field-error').style.display = 'none';
            }
        });
    </script>


</body>

</html>
