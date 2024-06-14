<?php

namespace App\Helpers;


class AdminDataTableButtonHelper
{
    public static function actionButtonDropdown2($array): string
    {
        $action_button_dropdown = '<div class="dropdown d-inline-block">
                                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill align-middle"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">';
        foreach ($array['actions'] as $key => $value) {
            if ((string)$key === 'edit') {
                $action_button_dropdown .= '<li><a class="dropdown-item edit-item-btn" href="' . $value . '" ><i class="ri-pencil-fill align-bottom me-2 text-muted"></i>Edit</a></li>';
            } else if ((string)$key === 'view') {
                $action_button_dropdown .= '<li><a href="javascript:void(0)" class="dropdown-item detail-button" data-id="' . $value . '"><i class="ri-eye-fill align-bottom me-2 text-muted"></i>View</a></li>';
            } else if ((string)$key === 'view-page') {
                $action_button_dropdown .= '<li><a class="dropdown-item detail-page-button" href="' . $value . '" ><i class="ri-eye-fill align-bottom me-2 text-muted"></i>Details</a></li>';
            } else if ((string)$key === 'delete') {
                $action_button_dropdown .= '<li><a href="javascript:void(0)"   data-id="' . $array['id'] . '" class="dropdown-item remove-item-btn delete-single"> <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>';
            } else if ((string)$key === 'invoice') {
                $action_button_dropdown .= '<li><a href="javascript:void(0)"   data-id="' . $array['id'] . '" class="dropdown-item download-invoice"> <i class="ri-file-download-line align-bottom me-2 text-muted"></i>Download</a></li>';
            } else if ((string)$key === 'print') {
                $action_button_dropdown .= '<li><a href="javascript:void(0)"   data-id="' . $array['id'] . '" class="dropdown-item print-report"> <i class="ri-printer-line align-bottom me-2 text-muted"></i>Print</a></li>';
            } else if ((string)$key === 'add_credit') {
                $action_button_dropdown .= '<li><a href="javascript:void(0)"   data-id="' . $array['id'] . '" class="dropdown-item add_credit"> <i class="ri-printer-line align-bottom me-2 text-muted"></i>Add Cradit</a></li>';
            } else if ((string)$key === 'checkout') {
                $action_button_dropdown .= '<li><a href="javascript:void(0)"   data-id="' . $array['id'] . '" class="dropdown-item checkout_driver"> <i class="ri-logout-circle-r-line align-bottom me-2 text-muted"></i>Checkout</a></li>';
            } else if ((string)$key === 'approve') {
                $action_button_dropdown .= '<a href="javascript:void(0)"   data-id="' . $array['id'] . '" class="dropdown-item approve-btn"> <i class="ri-check-double-fill align-bottom me-2 text-muted"></i>Approve</a>';
            } else if ((string)$key === 'reject') {
                $action_button_dropdown .= '<a href="javascript:void(0)"   data-id="' . $array['id'] . '" class="dropdown-item reject-btn"> <i class="ri-user-unfollow-fill align-bottom me-2 text-muted"></i>Reject</a>';
            } else if ((string)$key === 'status' && (string)$value === 'active') {
                $action_button_dropdown .= '<a href="javascript:void(0)" data-status="inActive" data-id="' . $array['id'] . '" class="dropdown-item status-change"> <i class="ri-user-unfollow-fill align-bottom me-2 text-muted"></i>InActive</a>';
            } else if ((string)$key === 'status' && (string)$value === 'inActive') {
                $action_button_dropdown .= '<a href="javascript:void(0)" data-status="active" data-id="' . $array['id'] . '" class="dropdown-item status-change"> <i class="ri-user-unfollow-fill align-bottom me-2 text-muted"></i>Active</a>';
            }
        }
        $action_button_dropdown .= '</ul></div>';
        return $action_button_dropdown;
    }


    public static function editButton($array): string
    {
        return '<button data-href="' . $array['route'] . '"
             class="edit-button btn btn-primary  ' . trans('themes_setting.button_style') . '"
             data-toggle="tooltip"
             data-placement="top"
             title="' . trans('admin_string.common_edit') . '">
             <i class="fa fa-pencil-square align-middle"></i>
             </button>';
    }

    public static function showRedirectButton($array): string
    {
        return '<button data-href="' . $array['show_route'] . '"
             class="edit-button btn btn-success  ' . trans('themes_setting.button_style') . '"
             data-toggle="tooltip"
             data-placement="top"
             title="' . trans('admin_string.view') . '">
             <i class="fa fa-eye align-middle"></i>
             </button>';
    }

    public static function detailButton($array): string
    {
        return '<button data-id="' . $array['id'] . '"
             class="detail-button btn btn-sm btn-info"
             data-toggle="tooltip"
             data-placement="top"
             title="' . trans('messages.common_view') . '">
             <i class="ri-eye-fill align-bottom"></i>
             </button>';
    }

    public static function deleteButton($array): string
    {
        return '<button data-id="' . $array['id'] . '"
            class="delete-single btn btn-danger ' . trans('themes_setting.button_style') . '"
            data-toggle="tooltip"
            data-placement="top"
            title="' . trans('admin_string.common_delete') . '">
            <i class="fa fa-trash align-middle"></i>
            </button>';
    }

    public static function activeInactiveStatusButton($array): string
    {
        if ((string)$array['status'] === 'active') {
            return '<button data-id="' . $array['id'] . '"
            data-status="inActive" class="status-change btn btn-warning  ' . trans('themes_setting.button_style') . '"
            data-effect="effect-fall" data-toggle="tooltip"
            data-placement="top" title="' . trans('admin_string.common_status_inActive') . '" >
            <i class="fa fa-refresh font-size-16 align-middle"></i></button>';
        }
        return '<button data-id="' . $array['id'] . '"
        data-status="active" class="status-change btn btn-success btn-icon"
        data-effect="effect-fall" data-toggle="tooltip"
        data-placement="top" title="' . trans('admin_string.common_status_active') . '" >
        <i class="fa fa-refresh  align-middle"></i></button>';
    }

    public static function statusBadge($array): string
    {
        if ((string)$array['status'] === 'active') {
            return '<div class="badge badge-success">' . trans('vendor_string.common_status_active') . '</div>';
        }

        if ((string)$array['status'] === 'expired') {
            return '<div class="badge badge-warning">' . trans('vendor_string.common_status_expire') . '</div>';
        }

        return '<div class="badge badge-danger">' . trans('vendor_string.common_status_inActive') . '</div>';
    }

    public static function promoStatusBadge($array): string
    {
        if ($array['end_date'] < date('Y-m-d')) {
            return '<div class="badge badge-danger">Expired</div>';
        } else if ((int)$array['status'] === 1) {
            return '<div class="badge badge-success">Active</div>';
        } else if ((int)$array['status'] === 0) {
            return '<div class="badge badge-warning">InActive</div>';
        }
    }

    public static function serviceStatusBadge($service): string
    {
        if ((int)$service->is_cancel === 1) {
            return '<div class="badge badge-danger">Cancelled</div>';
        } else if ((int)$service->status === 2) {
            return '<div class="badge badge-primary">Completed</div>';
        } else if ((int)$service->status === 1) {
            return '<div class="badge badge-success">Booked</div>';
        } else {
            return '<div class="badge badge-warning">Pending</div>';
        }
    }

    public static function serviceStatus($service): string
    {
        if ((int)$service->is_cancel === 1) {
            return 'Cancelled';
        } else if ((int)$service->status === 2) {
            return 'Completed';
        } else if ((int)$service->status === 1) {
            return 'Booked';
        } else {
            return 'Pending';
        }
    }
}
