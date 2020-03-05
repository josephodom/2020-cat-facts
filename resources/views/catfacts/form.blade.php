@extends ('catfacts.template')

@section ('content')

<h1>Cat Facts!</h1>

<form method="post">
	<fieldset>
		<label for="fact-count">
			How many facts would you like?
		</label>
		
		<input type="number" name="fact-count" id="fact-count" placeholder="Number Of Facts" min="1" max="{{ $limit }}" required autofocus>
		
		<button type="submit">
			Submit
		</button>
	</fieldset>
	
	@csrf
</form>

@endsection