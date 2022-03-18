<?php

namespace Joy\VoyagerBulkUpdate\Actions;

class BulkAssigneeUpdateAction extends BulkUpdateAction
{
    /**
     * Optional rows
     */
    protected $rows = ['assigned_to_id'];

    public function getTitle()
    {
        return __('joy-voyager-bulk-update::generic.bulk_assignee_update');
    }

    public function getIcon()
    {
        return 'voyager-person';
    }

    public function getPolicy()
    {
        return 'edit';
    }

    public function getAttributes()
    {
        return [
            'id'     => 'bulk_assignee_update_btn',
            'class'  => 'btn btn-info',
            'target' => '_blank',
        ];
    }
}
