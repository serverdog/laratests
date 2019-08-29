
/** @test **/
public function can_destroy_{{$route->class}}()
{

<?php if ($route->factoryExists) {?>
  $item = factory({{$namespace.$route->class}}::class)->create();

  $response = $this->{{$route->method}}(route({{ $routePath }}, $item));

  //We are expecting a redirect
  $response->assertStatus(302);
  <?php } else { ?> 
    @include("laratests::partials.nofactory")
 <?php } ?>
  

}

/** @test **/
public function cant_edit_nonexistent_{{$route->class}}()
{
    $response = $this->{{$route->method}}(route({{ $routePath }}, 0));

    $response->assertStatus(302);
}

