<?php

namespace Joy\VoyagerBulkUpdate\Http\Controllers;

use Joy\VoyagerBulkUpdate\Http\Traits\BulkUpdateAction;
use TCG\Voyager\Http\Controllers\VoyagerBaseController as TCGVoyagerBaseController;

class VoyagerBaseController extends TCGVoyagerBaseController
{
    use BulkUpdateAction;
}
