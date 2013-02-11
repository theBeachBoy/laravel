@layout('master')

@section('container')

	<table class="table table-striped">

		@foreach($tables as $table)
			<tr>
				<td>
				{{ $table->table_name }}
				</td>
			</tr>
		@endforeach

	</table>
@endsection