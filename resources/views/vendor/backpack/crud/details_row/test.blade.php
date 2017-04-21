<div class="m-t-10 m-b-10 p-l-10 p-r-10 p-t-10 p-b-10">
	<div class="row">
		<div class="col-md-12">
			<small>Use the <span class="label label-default">details_row</span> functionality to show more information about the entry, when that information does not fit inside the table column.</small><br><br>
			<strong>Text:</strong> {{ $entry->text }} <br>
			<strong>Textarea:</strong> {{ $entry->textarea }} <br>
			<strong>Email:</strong> {{ $entry->email }} <br>
			<strong>Number:</strong> {{ $entry->number }} <br>
			<strong>Float:</strong> {{ $entry->float }} <br>
			<strong>Week:</strong> {{ $entry->week }} <br>
			<strong>Month:</strong> {{ $entry->month }} <br>
			etc.
		</div>
	</div>
</div>
<div class="clearfix"></div>