@if(isset($foods))
	<ul>
	@foreach ($foods as $food)

			<li class="samples" id="{{ $food->ndbno }}"> {{ $food->name }} </li>

	@endforeach
	</ul>
@endif