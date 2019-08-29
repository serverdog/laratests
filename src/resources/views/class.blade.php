
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
@if (is_array($endpoints))
    @php
        $models = collect($endpoints)->pluck('class')->unique();
    @endphp
@endif  

@isset($models)
@foreach($models as $model)
use {!!$namespace!!}{!! $model!!};
@endforeach
@endif

/**
 * @group 
 */

class {!! (strlen($className) > 1) ? ucwords($className) : "General"!!}Test extends TestCase
{
    @yield('content')
}