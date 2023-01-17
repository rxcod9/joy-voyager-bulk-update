<?php
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;

// if (! function_exists('bulkUpdateRows')) {
//     /**
//      * Helper
//      */
//     function bulkUpdateRows($argument1 = null)
//     {
//         //
//     }
// }

if (!function_exists('dataRowByField')) {
    /**
     * DataRow by field
     *
     * @param DataRow
     */
    function dataRowByField($field): DataRow
    {
        return Voyager::model('DataRow')->where('field', $field)->first();
    }
}

if (!function_exists('isDataRowInPatterns')) {
    /**
     * Helper
     */
    function isDataRowInPatterns($dataRow, $dataRowPatterns)
    {
        foreach ($dataRowPatterns as $pattern) {
            if (
                Str::is($pattern, $dataRow->field) ||
                (optional($dataRow->details)->column && Str::is($pattern, optional($dataRow->details)->column)) ||
                (optional($dataRow->details)->type_column && Str::is($pattern, optional($dataRow->details)->type_column))
            ) {
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('isDataRowInPatternsReverse')) {
    /**
     * Helper
     */
    function isDataRowInPatternsReverse($dataRow, $dataRowPatterns)
    {
        foreach ($dataRowPatterns as $pattern) {
            $patternDataRow = dataRowByField($pattern);
            if (
                $patternDataRow &&
                Str::is($dataRow->field, $dataRow->field) ||
                (optional($patternDataRow->details)->column && Str::is($dataRow->field, optional($patternDataRow->details)->column)) ||
                (optional($patternDataRow->details)->type_column && Str::is($dataRow->field, optional($patternDataRow->details)->type_column))
            ) {
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('bulkUpdateRows')) {
    /**
     * Helper
     */
    function bulkUpdateRows(DataType $dataType)
    {
        $dataTypeDataRows = config('joy-voyager-bulk-update.data_rows.' . $dataType->slug, []);

        if ($dataTypeDataRows) {
            $dataTypeRows = $dataType->editRows->filter(function ($row) use ($dataTypeDataRows) {
                return isDataRowInPatterns($row, $dataTypeDataRows);
            });

            return $dataTypeRows->pluck('field')->toArray();
        }

        $dataTypeDataRowTypes = config('joy-voyager-bulk-update.data_row_types', []);

        if ($dataTypeDataRowTypes) {
            $dataTypeRows = $dataType->editRows->filter(function ($row) use ($dataTypeDataRowTypes) {
                return isInPatterns($row->type, $dataTypeDataRowTypes);
            });

            return $dataTypeRows->pluck('field')->toArray();
        }

        return [];
    }
}
