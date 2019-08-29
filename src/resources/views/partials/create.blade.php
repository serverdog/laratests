
/** @test **/
public function can_access_create()
{
  $response = $this->{{$route->method}}(route('{{ $routePath }}'));

  $response->assertStatus(200);
}
