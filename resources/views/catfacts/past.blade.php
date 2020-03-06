@extends ('catfacts.template')

@section ('content')

<h1>Cat Facts of the Past!</h1>

<ul>@foreach ($pdfs as $pdf)
	<li>
		<a href="{{ $pdf->url() }}" target="_blank">
			File w/ {{ $pdf->count }} facts
		</a>
		<br>
		Requested on {{ $pdf->created_at }}
	</li>
@endforeach</ul>

{{ $pdfs->links() }}

<a href="{{ url('/') }}">
	Go back?
</a>

@endsection