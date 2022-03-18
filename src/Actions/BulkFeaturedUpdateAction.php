<?php

namespace Joy\VoyagerBulkUpdate\Actions;

class BulkFeaturedUpdateAction extends BulkUpdateAction
{
    /**
     * Optional rows
     */
    protected $rows = ['featured'];

    public function getTitle()
    {
        return __('joy-voyager-bulk-update::generic.bulk_featured_update');
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
            'id'     => 'bulk_featured_update_btn',
            'class'  => 'btn btn-info',
            'target' => '_blank',
        ];
    }
}
