<?php

namespace Joy\VoyagerBulkUpdate\Http\Controllers;

use Joy\VoyagerBulkUpdate\Http\Traits\BulkUpdateAction;
use Joy\VoyagerCore\Http\Controllers\VoyagerBaseController as BaseVoyagerBaseController;

class VoyagerBaseController extends BaseVoyagerBaseController
{
    use BulkUpdateAction;
}
