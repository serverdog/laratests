
/** @test **/
public function can_access_index()
{
  $response = $this->{{$route->method}}(route('{{ $routePath }}'));

  $response->assertStatus(200);
}
