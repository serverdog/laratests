/** @test **/
public function can_update_{{$route->class}}()
{

<?php if ($route->factoryExists) {?>
  $item = factory({{$namespace.$route->class}}::class)->create();

  $response = $this->{{$route->method}}(route('{{ $routePath }}', $item));
 
  @isset($tablename)
  $this->assertDatabaseHas('{{$tablename}}', $item->toArray());
  @endisset
 

  <?php } else { ?> 
   @include("laratests::partials.nofactory")
<?php } ?>


}

