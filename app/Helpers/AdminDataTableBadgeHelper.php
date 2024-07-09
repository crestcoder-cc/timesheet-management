<?php

namespace App\Helpers;


class AdminDataTableBadgeHelper
{
    public static function statusBadge($object): string
    {
        $status = '';
        if ((string)$object->status === 'active') {
            $status = '<span style="cursor:pointer" class="badge bg-success status-change" data-status="inactive" data-id="' . $object->id . '" >Active</span>';
        } elseif ((string)$object->status === 'inActive') {
            $status = '<span style="cursor:pointer" class="badge bg-danger status-change" data-status="active" data-id="' . $object->id . '" >Deactivate</span>';
        }
        return $status;
    }

    public static function registerStatusBadge($object)
    {
        $status = '';
        if ((string)$object->register_status === 'pending') {
            $status = '<span class="badge bg-warning " data-status="pending" data-id="' . $object->id . '" >Pending</span>';
        } elseif ((string)$object->register_status === 'approved') {
            $status = '<span class="badge bg-success " data-status="approved" data-id="' . $object->id . '" >Approved</span>';
        } elseif ((string)$object->register_status === 'rejected') {
            $status = '<span class="badge bg-danger " data-status="rejected" data-id="' . $object->id . '" >Rejected</span>';
        }
        return $status;
    }
    public static function taskStatusBadge($object)
    {
        $status = '';
        if ((string)$object->status === 'pending') {
            $status = '<span class="badge bg-warning " data-status="pending" data-id="' . $object->id . '" >Pending</span>';
        } elseif ((string)$object->status === 'approved') {
            $status = '<span class="badge bg-success " data-status="approved" data-id="' . $object->id . '" >Approved</span>';
        } elseif ((string)$object->status === 'reject') {
            $status = '<span class="badge bg-danger " data-status="reject" data-id="' . $object->id . '" >Rejected</span>';
        }
        return $status;
    }
}
