
namespace Tests\Feature;

use Tests\TestCase;

class GenericTest extends TestCase
{
    /** @test **/
    public function can_access_index()
    {
      $response = $this->{{$route->method}}({{ !empty($route->name) ? "route('{$route->name}')" : "'{$route->uri}'" }});

      $response->assertStatus(200);
    }
}
