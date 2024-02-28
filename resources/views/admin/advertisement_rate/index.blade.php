@extends('admin.layout.app')

@section('styles')
@endsection

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <a href="{{ route('add_advertisement_rate') }}"><button type="button" class="btn btn-primary" style="float: right;">Add</button></a>
                    <h6 class="mb-4">Advertisement Rates</h6>
                    <div class="mt-3" style="margin-top: 10px;">
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Sr. No.</th>
                                    <th scope="col">Advertisement Slot</th>
                                    <th scope="col">Minimum Days</th>
                                    <th scope="col">Per Day Rate</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($advertisement_rate as $advertisement_rates)
                                    <tr>
                                        {{-- <th scope="row">1</th> --}}
                                        <td>{{ $advertisement_rates->sort_col }}</td>
                                        <td>{{ $advertisement_rates->advertisement_slot }}</td>
                                        <td>{{ $advertisement_rates->minimum_days }}</td>
                                        <td>{{ $advertisement_rates->per_day_rate }}</td>
                                        <td>{{ $advertisement_rates->size }}</td>
                                        <td>{{ $advertisement_rates->status == 1 ? 'Active' : ''  }}</td>
                                        <td>{{ $advertisement_rates->created_at }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('edit_advertisement_rate', $advertisement_rates->id) }}"
                                                class="btn btn-info btn-sm waves-effect" title='Edit'>
                                                <i class="fa fa-edit" style="font-size:20px">
                                                </i>
                                            </a>
                                            
                                            
                                            <form method="POST"
                                                action="{{ route('delete_advertisement_rate', $advertisement_rates->id) }}">
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
