/** @test **/
public function can_update_{{$route->class}}()
{

<?php if ($route->factoryExists) {?>
  $item = factory({{$namespace.$route->class}}::class)->create();

  @isset($tablename)
  $this->assertDatabaseHas('{{$tablename}}', $item->toArray());
  @endisset
  $data = $item->toArray();


  <?php if (isset($field)){?>
    // Change your data here
    $data['{{$field}}'] = 1;


    $response = $this->{{$route->method}}(route('{{ $routePath }}', $data));

    $this->assertEquals($data['{{$field}}'], $item->fresh()->{{$field}});

    $response->assertStatus(302);
  <?php } ?>

  <?php } else { ?> 
   @include("laratests::partials.nofactory")
<?php } ?>


}

/** @test **/
public function cant_update_nonexistent_{{$route->class}}()
{
$response = $this->{{$route->method}}(route('{{ $routePath }}', 0));

$response->assertStatus(302);
}

