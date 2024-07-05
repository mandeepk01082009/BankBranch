{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
</h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                {{ __("You're logged in!") }}
            </div>
        </div>
    </div>
</div>
</x-app-layout> --}}

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
</h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                {{ __("You're logged in!") }}
            </div>
        </div>
    </div>
</div>
</x-app-layout> --}}
@extends('admin.layout.app')

@section('styles')
@endsection

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            {{-- filterapplyloanapplications --}}
            <div class="col-sm-6 col-xl-3">
                {{-- <div class="bg-light rounded p-4 text-center"> --}}
                    <button class="btn-link bg-light rounded text-center" style="border:none; padding:15px 90px;" data-status="All Applications"
                        onclick="filterApplications(this)">
                        <div class="card-box height-100-p widget-style1">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="progress-data">
                                    <div id="chart4"></div>
                                </div>
                                <div class="widget-data">
                                    <div class="h4 mb-0">{{ $all }}</div>
                                    <div class="weight-600 font-10" style="color: black">All</div>
                                </div>
                            </div>
                        </div>
                    </button>
                {{-- </div> --}}
            </div>
            <div class="col-sm-6 col-xl-3">
                {{-- <div class="bg-light rounded p-4 text-center"> --}}
                    <button class="btn-link bg-light rounded text-center" style="border:none; padding:15px 75px;" data-status="Verified"
                        onclick="filterApplications(this)">
                        <div class="card-box height-100-p widget-style1">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="progress-data">
                                    <div id="chart4"></div>
                                </div>
                                <div class="widget-data">
                                    <div class="h4 mb-0">{{ $verified }}</div>
                                    <div class="weight-600 font-10" style="color:black;">Verified</div>
                                </div>
                            </div>
                        </div>
                    </button>
                {{-- </div> --}}
            </div>
            <div class="col-sm-6 col-xl-3">
                {{-- <div class="bg-light rounded p-4 text-center"> --}}
                    <button class="btn-link bg-light rounded text-center" style="border:none; padding:15px 70px;" data-status="In Process"
                        onclick="filterApplications(this)">
                        <div class="card-box height-100-p widget-style1">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="progress-data">
                                    <div id="chart4"></div>
                                </div>
                                <div class="widget-data">
                                    <div class="h4 mb-0">{{ $inProcess }}</div>
                                    <div class="weight-600 font-10" style="color:black;">Inprocess</div>
                                </div>
                            </div>
                        </div>
                    </button>
                {{-- </div> --}}
            </div>
            <div class="col-sm-6 col-xl-3">
                {{-- <div class="bg-light rounded p-4 text-center"> --}}
                    <button class="btn-link bg-light rounded text-center" style="border:none; padding:15px 40px;"
                        data-status="Send back to user" onclick="filterApplications(this)">
                        <div class="card-box height-100-p widget-style1">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="progress-data">
                                    <div id="chart4"></div>
                                </div>
                                <div class="widget-data">
                                    <div class="h4 mb-0">{{ $sendBackToUser }}</div>
                                    <div class="weight-600 font-10" style="color:black;">Send Back to User</div>
                                </div>
                            </div>
                        </div>
                    </button>
                {{-- </div> --}}
            </div>
            <div class="col-sm-6 col-xl-3">
                {{-- <div class="bg-light rounded p-4 text-center"> --}}
                    <button class="btn-link bg-light rounded text-center" style="border:none; padding:15px 70px;" data-status="Approved"
                        onclick="filterApplications(this)">
                        <div class="card-box height-100-p widget-style1">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="progress-data">
                                    <div id="chart4"></div>
                                </div>
                                <div class="widget-data">
                                    <div class="h4 mb-0">{{ $accepted }}</div>
                                    <div class="weight-600 font-10" style="color:black;">Approved</div>
                                </div>
                            </div>
                        </div>
                    </button>
                {{-- </div> --}}
            </div>
            <div class="col-sm-6 col-xl-3">
                {{-- <div class="bg-light rounded p-4 text-center"> --}}
                    <button class="btn-link bg-light rounded text-center" style="border:none; padding:15px 70px;" data-status="Rejected"
                        onclick="filterApplications(this)">
                        <div class="card-box height-100-p widget-style1">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="progress-data">
                                    <div id="chart4"></div>
                                </div>
                                <div class="widget-data">
                                    <div class="h4 mb-0">{{ $rejected }}</div>
                                    <div class="weight-600 font-10" style="color:black;">Rejected</div>
                                </div>
                            </div>
                        </div>
                    </button>
                {{-- </div> --}}
            </div>
        </div>
    </div>

    <!-- Sale & Revenue End -->


    <!-- Sales Chart Start -->
    <!--<div class="container-fluid pt-4 px-4">-->
    <!--    <div class="row g-4">-->
    <!--        <div class="col-sm-12 col-xl-6">-->
    <!--            <div class="bg-light text-center rounded p-4">-->
    <!--                <div class="d-flex align-items-center justify-content-between mb-4">-->
    <!--                    <h6 class="mb-0">Worldwide Sales</h6>-->
    <!--                    <a href="">Show All</a>-->
    <!--                </div>-->
    <!--                <canvas id="worldwide-sales"></canvas>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="col-sm-12 col-xl-6">-->
    <!--            <div class="bg-light text-center rounded p-4">-->
    <!--                <div class="d-flex align-items-center justify-content-between mb-4">-->
    <!--                    <h6 class="mb-0">Salse & Revenue</h6>-->
    <!--                    <a href="">Show All</a>-->
    <!--                </div>-->
    <!--                <canvas id="salse-revenue"></canvas>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- Sales Chart End -->

    </div>
    <!-- Content End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
@endsection

@section('scripts')
    <!-- <script>
        function filterApplications(button) {
            alert('jj');
            const status = button.dataset.status;
            const url = "{{ route('filterapplyloanapplications') }}";

            // Add the status as a query parameter to the URL
            const params = new URLSearchParams({
                accept: status
            });
            const fullUrl = `${url}?${params.toString()}`;

            // Redirect the user to the filtered URL
            window.location.href = fullUrl;
        }
    </script> -->

    <script>
        function filterApplications(button) {
            const status = button.dataset.status;
            const url = "{{ route('filterapplyloanapplications') }}";

            if (status === 'All Applications') {
                // Redirect the user to the unfiltered URL
                window.location.href = url;
            } else {
                // Add the status as a query parameter to the URL
                const params = new URLSearchParams({
                    status: status
                });
                const fullUrl = `${url}?${params.toString()}`;

                // Redirect the user to the filtered URL
                window.location.href = fullUrl;
            }
        }
    </script>
@endsection
