<?php

namespace Joy\VoyagerBulkUpdate\Http\Traits;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Facades\Voyager;
use Joy\VoyagerCore\Http\Controllers\Traits\BreadRelationshipParser;

trait BulkUpdateAction
{
    use BreadRelationshipParser;

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
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $dataTypeDataRows = \bulkUpdateRows($dataType);
        $dataTypeDataRows = $request->get('rows', $dataTypeDataRows);

        $dataTypeRows = $dataType->editRows->filter(function ($row) use ($dataTypeDataRows) {
            return isDataRowInPatternsReverse($row, $dataTypeDataRows);
        })->filter(function ($row) use ($request) {
            return $request->has($row->field) ||
                    (optional($row->details)->column && $request->has(optional($row->details)->column)) ||
                    (optional($row->details)->type_column && $request->has(optional($row->details)->type_column));
        });

        $ids = explode(',', $request->ids);
        foreach ($ids as $id) {
            $this->processBulkUpdate(
                $request,
                $id,
                $slug,
                $dataType,
                $dataTypeRows
            );
        }

        if (auth()->user()->can('browse', app($dataType->model_name))) {
            $redirect = redirect()->route("voyager.{$dataType->slug}.index");
        } else {
            $redirect = redirect()->back();
        }

        return $redirect->with([
            'message'    => __('voyager::generic.successfully_updated') . " {$dataType->getTranslatedAttribute('display_name_singular')}",
            'alert-type' => 'success',
        ]);
    }

    protected function processBulkUpdate(
        Request $request,
        $id,
        $slug,
        $dataType,
        $dataTypeRows
    ) {
        // Compatibility with Model binding.
        $id = $id instanceof \Illuminate\Database\Eloquent\Model ? $id->{$id->getKeyName()} : $id;

        $model = app($dataType->model_name);
        $query = $model->query();
        if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope' . ucfirst($dataType->scope))) {
            $query = $query->{$dataType->scope}();
        }
        if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
            $query = $query->withTrashed();
        }

        $data = $query->findOrFail($id);

        // Check permission
        $this->authorize('edit', $data);

        // Validate fields with ajax
        $val = $this->validateBread($request->except('action', 'ids'), $dataTypeRows, $dataType->name, $id)->validate();

        // Get fields with images to remove before updating and make a copy of $data
        $to_remove = $dataTypeRows->where('type', 'image')
            ->filter(function ($item, $key) use ($request) {
                return $request->hasFile($item->field);
            });
        $original_data = clone ($data);

        $this->insertUpdateData($request, $slug, $dataTypeRows, $data);

        // Delete Images
        $this->deleteBreadImages($original_data, $to_remove);

        event(new BreadDataUpdated($dataType, $data));

        return $data;
    }
}
