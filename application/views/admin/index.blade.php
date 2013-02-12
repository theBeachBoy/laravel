@layout('master')

@section('container')
	
	<br /><br />

	<h1>Admin Panel</h1>

	<br />

	<h2>MonEpicerie Tables</h2>
	<table class="table table-striped table-bordered">

		@foreach($tables as $table)
			<tr>
				<td>
				{{ HTML::link('admin/index/'.$table->table_name, $table->table_name) }}
				</td>
			</tr>
		@endforeach

	</table>
@endsection