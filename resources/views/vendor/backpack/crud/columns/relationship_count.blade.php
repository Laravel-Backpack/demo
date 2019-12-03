{{-- snippets column - used to show Nested CRUDs inside Backpack Demo --}}
@php
	$value = $entry->{$column['name']}->count();
	$link = isset($column['link']) ? $column['link']($entry) : false;
	$target = isset($column['target']) ? $column['target'] : false;
@endphp

<a {{ $link ? " href=$link": "" }} {{ $target ? " target=$target" : '' }}>{{ (array_key_exists('prefix', $column) ? $column['prefix'] : '').str_limit(strip_tags($value), array_key_exists('limit', $column) ? $column['limit'] : 40, "[...]").(array_key_exists('suffix', $column) ? $column['suffix'] : '') }}</a>