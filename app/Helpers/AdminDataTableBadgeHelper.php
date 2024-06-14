<?php

namespace App\Helpers;


class AdminDataTableBadgeHelper
{
    public static function statusBadge($object): string
    {
        $status = '';
        if ((string)$object->status === 'active') {
            $status = '<span class="badge badge-soft-success" data-status="inactive" data-id="' . $object->id . '" >Active</span>';
        } elseif ((string)$object->status === 'inActive') {
            $status = '<span class="badge badge-soft-danger" data-status="active" data-id="' . $object->id . '" >Deactivate</span>';
        }
        return $status;
    }

    public static function registerStatusBadge($object)
    {
        $status = '';
        if ((string)$object->register_status === 'pending') {
            $status = '<span class="badge badge-soft-warning " data-status="pending" data-id="' . $object->id . '" >Pending</span>';
        } elseif ((string)$object->register_status === 'approved') {
            $status = '<span class="badge badge-soft-success " data-status="approved" data-id="' . $object->id . '" >Approved</span>';
        } elseif ((string)$object->register_status === 'rejected') {
            $status = '<span class="badge badge-soft-danger " data-status="rejected" data-id="' . $object->id . '" >Rejected</span>';
        }
        return $status;
    }
}
