
/** @test **/
public function can_access_show()
{

  <?php if ($route->factoryExists) {?>
    $item = factory({{$namespace.$route->class}}::class)->create();

    $response = $this->{{$route->method}}(route('{{ $routePath }}', $item));

    $response->assertStatus(200);
  <?php } else { ?> 
    @include("laratests::partials.nofactory")
 <?php } ?>

}

/** @test **/
public function cant_access_nonexistent_{{$route->class}}()
{
    $response = $this->{{$route->method}}(route('{{ $routePath }}', 0));

    $response->assertStatus(302);
}
