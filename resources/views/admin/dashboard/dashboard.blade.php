@extends('admin.layouts.master')
@section('title','Dashboard')
@section('content')
    <div class="row">
        <div class="row g-1 g-xl-8">
            <div class="col-xl-3">
                <a href="{{ route('admin.company.index')}}"
                   class="card bg-white card-dash hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <div class="text-dark fw-bolder fs-1">{{$companies_count}}</div>
                        <div
                            class="text-dark fw-bolder fs-5">Total Companies
                        </div>
                    </div>
                </a>
            </div>
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
            <div class="col-xl-3">
                <a href="{{ route('admin.company.index')}}"
                   class="card bg-white card-dash hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <div class="text-dark fw-bolder fs-1">{{$holiday_count}}</div>
                        <div
                            class="text-dark fw-bolder fs-5">Total Holiday
                        </div>
                    </div>
                </a>
            </div>
        </div>
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
    <div class="row mt-2 mb-2">
    <a href="{{ route('admin.setting.index') }}" class="btn btn-primary w-auto mt-3">Manage Holidays</a>
    </div>
@endsection
@section('custom-script')

@endsection
