@extends ('catfacts.template')

@section ('content')

<h1>Cat Facts!</h1>

<form method="post">
	<fieldset>
		<label for="fact-count">
			How many facts would you like?
		</label>
		
		<input type="number" name="fact-count" id="fact-count" placeholder="Number Of Facts" min="0" max="{{ $max ?? 0 }}">
		
		<button type="submit">
			Submit
		</button>
	</fieldset>
	
	@csrf
</form>

@endsection