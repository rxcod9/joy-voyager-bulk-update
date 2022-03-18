<?php

namespace Joy\VoyagerBulkUpdate\Http\Traits;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;

trait BulkUpdateAction
{
    //***************************************
    //               ____
    //              |  _ \
    //              | |_) |
    //              |  _ <
    //              | |_) |
    //              |____/
    //
    //      BulkUpdate DataTable our Data Type (B)READ
    //
    //****************************************

    public function bulkUpdate(Request $request)
    {
        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('browse', app($dataType->model_name));

        //
    }
}
