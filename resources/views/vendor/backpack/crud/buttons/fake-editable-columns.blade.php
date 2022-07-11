@if(request()->boolean('fake'))
<a href="{{ backpack_url('editable-monster') }}" class="btn btn-warning">
    <span><i class="la la-magic"></i> Editable Columns</span>
</a>
@else
<a href="{{ backpack_url('editable-monster/?fake=true') }}" class="btn btn-warning">
    <span><i class="la la-magic"></i> Fake Editable Columns</span>
</a>
@endif