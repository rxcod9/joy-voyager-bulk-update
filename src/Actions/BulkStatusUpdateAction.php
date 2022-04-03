<?php

namespace Joy\VoyagerBulkUpdate\Actions;

class BulkStatusUpdateAction extends BulkUpdateAction
{
    /**
     * Optional rows
     */
    protected $rows = ['status'];

    public function getTitle()
    {
        return __('joy-voyager-bulk-update::generic.bulk_status_update');
    }

    public function getIcon()
    {
        return 'fa-solid fa-list-check';
    }

    public function getPolicy()
    {
        return 'edit';
    }

    public function getAttributes()
    {
        return [
            'id'     => 'bulk_status_update_btn',
            'class'  => 'btn btn-info',
            'target' => '_blank',
        ];
    }
}
