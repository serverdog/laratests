@extends('laratests::class')

@section('content')
    @foreach ($endpoints as $route)
        @php
            $routePath = !empty($route->name) ? $route->name :$route->uri;
           
            $modelName = $namespace.$route->class;
            $model = new $modelName;
            $attributes = collect($model->getFillable());
            $tablename = $model->getTable();
            if ($attributes->count()) {
                $field=$attributes->first();
            } 

        @endphp
@includeFirst(["laratests::partials.{$route->type}", 'laratests::partials.default'])
    @endforeach

@endsection