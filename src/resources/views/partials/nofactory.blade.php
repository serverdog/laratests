// Stop here and mark this test as incomplete.
  $this->markTestIncomplete(
  "This test cannot work without a Model Factory. \r\nIt's recommended that you create one using \r\n'php artisan
  make:factory {{$route->class}}Factory --model={{$route->class}}' \r\nor editing this test yourself"
  );