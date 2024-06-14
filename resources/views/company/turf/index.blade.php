@extends('company.layouts.master')
@section('title','Turf')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Turfs</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h5 class="card-title mb-0 flex-grow-1">Turf List</h5>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <a href="{{ route('company.company.create') }}"
                               class="btn btn-primary btn-sm">{{trans('messages.add_new')}}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered dt-responsive nowrap table-striped align-middle"
                           id="basic-1" style="width:100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Unique ID</th>
                            <th>Turf Name</th>
                            <th>Mobile No</th>
                            <th>Contact Person</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Register Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="rejectForm" method="post">
                    @csrf
                    <input type="hidden" id="reject_id" name="reject_id" value=""/>
                    <div class="modal-header">
                        <h5 class="modal-title">Reject Turf</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="reject_reason">Reject Reason</label>
                                <input type="text" class="form-control" id="reject_reason" required
                                       name="reject_reason"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        let datatable_url = '/get-company'
        let redirect_url = '/company'
        let form_url = '/company'
        const sweetalert_delete_title = 'Delete Turf ?'
        const sweetalert_delete_text = 'Are you sure want to delete this record ?'

        $.extend(true, $.fn.dataTable.defaults, {
            columns: [
                {data: 'id', name: 'id'},
                {data: 'unique_id', name: 'unique_id'},
                {data: 'name', name: 'name'},
                {data: 'mobile_no', name: 'mobile_no'},
                {data: 'contact_person_name', name: 'contact_person_name'},
                {data: 'address', name: 'address'},
                {data: 'status', name: 'status'},
                {data: 'register_status', name: 'register_status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [0, 'desc']
        })
    </script>
    <script src="{{ asset('assets/custom-js/custom/datatable.js') }}?v={{time()}}"></script>
    <script src="{{ asset('assets/custom-js/company/company.js') }}?v={{time()}}"></script>
@endsection
