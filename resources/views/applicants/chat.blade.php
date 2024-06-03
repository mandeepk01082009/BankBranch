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
                        <a href="{{ route('filterapplyloans') }}"><button type="button" class="btn btn-primary" style="float: right;">Back</button></a>
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
                                            {{-- {{  dd($message->userType->id )  }} --}}
                                            @php
                                             if ($message->userType->id == 1) {
                                                    $name = DB::table('users')->where('id', $message->user_id)->value('name');
                                             }
                                             elseif ($message->userType->id == 2) {
                                                $name = DB::table('bank_nodals')->where('id', $message->user_id)->value('dco_name');
                                            } elseif ($message->userType->id == 3) {
                                                $name = DB::table('bank_branches')->where('id', $message->user_id)->value('concerned_person');
                                            } elseif ($message->userType->id == 5) {
                                                $name = DB::table('applys')->where('id', $message->applicant_id)->value('name');
                                            }
                                        @endphp
    
                                            <strong>{{ $name }}({{ $message->userType->name ?? 'N/A' }})</strong>
                                            {{ $message->text }}
                                            @if (!empty(json_decode($message->file, true)))
                                                <ul>
                                                    @foreach (json_decode($message->file, true) as $file)
                                                        @if (!is_null($file))
                                                            <li>
                                                                <a href="{{ asset('storage/' . $file) }}" target="_blank">{{ $file }}</a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                </ul>
                                            @elseif (!empty($message->file))
                                                <ul>
                                                    <li>
                                                        <a href="{{ asset('storage/' . $message->file) }}" target="_blank">{{ $message->file }}</a>
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
                      
                        <form id="message-form" method="POST" action="{{ route('store_message', $applicantId) }}" enctype="multipart/form-data">
                            @csrf
    
                            <div class="form-group">
                                <textarea id="message" name="text" class="form-control @error('text') is-invalid @enderror" rows="3" placeholder="Type your message here...">{{ old('text') }}</textarea>
                                @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="form-group mt-3">
                                <input type="file" name="file[]" class="form-control @error('file') is-invalid @enderror" multiple>
                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary sendMessage">Send</button>
                            </div>
                        </form>
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
    
    {{-- <script>
        $(document).ready(function() {
            // Handle the form submission
            $('.sendMessage').click(function(e) {
                e.preventDefault();
    
                // Serialize the form data
                var formData = $(this).closest('form').serialize();
    
                // Send the AJAX request with the CSRF token
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
    
                $.ajax({
                    type: 'POST',
                    url: '{{ route('messagesStore') }}',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.message) {
                            // Display an alert with thesuccess message
                            alert(response.message);
    
                            // Clear the textarea
                            $('#message').val('');
    
                            // Reload the page
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        // Handle the error response
                        if (xhr.responseJSON.message) {
                            alert(xhr.responseJSON.message);
                        }
                    }
                });
            });
        });
    </script> --}}


</body>

</html>
