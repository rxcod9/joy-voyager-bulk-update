<?php

namespace Joy\VoyagerBulkUpdate\Actions;

class BulkParentUpdateAction extends BulkUpdateAction
{
    /**
     * Optional rows
     */
    protected $rows = ['parent_id'];

    public function getTitle()
    {
        return __('joy-voyager-bulk-update::generic.bulk_parent_update');
    }

    public function getIcon()
    {
        return 'fa-solid fa-user-large';
    }

    public function getPolicy()
    {
        return 'edit';
    }

    public function getAttributes()
    {
        return [
            'id'     => 'bulk_parent_update_btn',
            'class'  => 'btn btn-info',
            'target' => '_blank',
        ];
    }
}
