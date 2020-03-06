@extends ('catfacts.template')

@section ('content')

<h1>Cat Facts!</h1>

<form method="post">
	<fieldset>
		<label for="fact-count">
			How many facts would you like?
		</label>
		
		<input type="number" name="fact-count" id="fact-count" placeholder="Number Of Facts" min="1" step="1" max="{{ $limit ?? 20 }}" required autofocus>
		
		<button type="submit">
			Submit
		</button>
	</fieldset>
	
	<a href="{{ url('/past') }}">
		Psst! Click here to see past facts!
	</a>
	
	@csrf
</form>

@endsection