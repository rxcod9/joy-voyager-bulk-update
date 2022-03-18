<form id="bulk_bulk_update_form" method="post" action="{{ route('voyager.'.$dataType->slug.'.action') }}">
    {{ csrf_field() }}
    <button type="submit"><i class="{{ $action->getIcon() }}"></i> {{ $action->getTitle() }}</button>
    <input type="hidden" name="action" value="{{ get_class($action) }}">
    <input type="hidden" name="ids" value="" class="selected_ids">
</form>