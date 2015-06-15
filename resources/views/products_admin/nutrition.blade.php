<h3>{{ $selectedfood }}</h3>
@foreach ($nutrients as $nutrient) 
           <div> {{ $nutrient->name }} : Per 100g {{ $nutrient->value }} {{ $nutrient->unit }}
            Per {{ $nutrient->measures[0]->label }} : {{ $nutrient->measures[0]->value }} {{ $nutrient->unit }} </div>
@endforeach
