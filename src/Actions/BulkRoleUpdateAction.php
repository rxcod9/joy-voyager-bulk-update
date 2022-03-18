<?php

namespace Joy\VoyagerBulkUpdate\Actions;

class BulkRoleUpdateAction extends BulkUpdateAction
{
    /**
     * Optional rows
     */
    protected $rows = ['role_id'];

    public function getTitle()
    {
        return __('joy-voyager-bulk-update::generic.bulk_role_update');
    }

    public function getIcon()
    {
        return 'voyager-edit';
    }

    public function getPolicy()
    {
        return 'edit';
    }

    public function getAttributes()
    {
        return [
            'id'     => 'bulk_role_update_btn',
            'class'  => 'btn btn-info',
            'target' => '_blank',
        ];
    }
}
