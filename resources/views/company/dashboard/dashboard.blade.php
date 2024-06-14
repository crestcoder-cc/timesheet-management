@extends('company.layouts.master')
@section('title','Dashboard')
@section('content')
    <style>
        .table-details {
            display: none;
        }
        .btn-show-details {
            cursor: pointer;
        }
    </style>
    <div class="row">
        <div class="row g-1 g-xl-8">
            <div class="col-xl-3">
                <a href="{{ route('admin.company.index')}}"
                   class="card bg-white card-dash hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <div class="text-dark fw-bolder fs-1">{{$employee_count}}</div>
                        <div
                            class="text-dark fw-bolder fs-5">Total Employees
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3">
                <a href="{{ route('admin.company.index')}}"
                   class="card bg-white card-dash hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <div class="text-dark fw-bolder fs-1">150</div>
                        <div
                            class="text-dark fw-bolder fs-5">Total Hours
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3">
                <a href="{{ route('admin.company.index')}}"
                   class="card bg-white card-dash hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <div class="text-dark fw-bolder fs-1">150</div>
                        <div
                            class="text-dark fw-bolder fs-5">Total Work Hours
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3">
                <a href="{{ route('admin.company.index')}}"
                   class="card bg-white card-dash hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <div class="text-dark fw-bolder fs-1">150</div>
                        <div
                            class="text-dark fw-bolder fs-5">Overtime Hours
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row mt-5 bg-white">
        <h3 class="mb-2 mt-2">Company Employee</h3>
        <table class="table table-borderless">
            <thead class="" style="background-color: #0071B2">
            <tr class="text-white fs-5">
                <th>Employee</th>
                <th>Employee ID</th>
                <th>Total work hours</th>
                <th>Overtime</th>
                <th>Total hours</th>
                <th>Actions</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Karan</td>
                <td>123456789</td>
                <td>8 hours</td>
                <td>2 hours</td>
                <td>10 hours</td>
                <td>
                    <button class="btn btn-success btn-sm btn-show-details">✓</button>
                    <button class="btn btn-danger btn-sm btn-hide-details">×</button>
                </td>
                <td>
                    <span class="toggle-icon cursor-pointer" ><i class="ri-arrow-down-s-fill fs-4"></i></span>
                </td>

            </tr>
            <tr class="table-details">
                <td colspan="6">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Project</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Timesheet Management</td>
                            <td>Create a employee dashboard page</td>
                            <td>22/05/2024</td>
                            <td>09:30 AM</td>
                            <td>07:00 PM</td>
                        </tr>
                        <tr>
                            <td>Timesheet Management</td>
                            <td>Create a employee dashboard page</td>
                            <td>22/05/2024</td>
                            <td>09:30 AM</td>
                            <td>07:00 PM</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>Dharmik</td>
                <td>123456788</td>
                <td>6 hours</td>
                <td>0 hours</td>
                <td>6 hours</td>
                <td>
                    <button class="btn btn-success btn-sm btn-show-details">✓</button>
                    <button class="btn btn-danger btn-sm btn-hide-details">×</button>
                </td>
                <td>
                    <span class="toggle-icon cursor-pointer"><i class="ri-arrow-down-s-fill fs-4"></i></span>
                </td>
            </tr>
            <tr class="table-details">
                <td colspan="6">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Project</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Timesheet Management</td>
                            <td>Develop react App</td>
                            <td>22/05/2024</td>
                            <td>09:30 AM</td>
                            <td>07:00 PM</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="row mt-5 bg-white">
            <h3 class="mb-2 mt-2">Holidays List</h3>
            @if(empty($holidays))
                <div class="alert alert-info" role="alert">
                    No holidays have been set yet.
                </div>
            @else
                <table class="table table-borderless">
                    <thead class="text-white" style="background-color: #0071B2">
                    <tr>
                        <th>No</th>
                        <th>Holiday Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($holidays as $holiday)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($holiday)->format('F j, Y') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
    </div>
@endsection
@section('custom-script')
    <script>
        $(document).ready(function () {
            $('.toggle-icon').click(function () {
                var $detailsRow = $(this).closest('tr').next('.table-details');
                $detailsRow.toggle();
                $(this).html($detailsRow.is(':visible') ? '<i class="ri-arrow-up-s-fill fs-4"></i>' : '<i class="ri-arrow-down-s-fill fs-4"></i>');
            });
        });
    </script>
@endsection
