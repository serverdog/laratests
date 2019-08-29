/** @test **/
public function can_access_{{$route->name ? str_replace('.','_',$route->name) : "route"}}()
{
  $response = $this->{{$route->method}}('{{ $routePath }}');

  $response->assertStatus(200);
}