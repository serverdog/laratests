<?php

use Symfony\Component\Console\Output\BufferedOutput;
use Serverdog\Laratests\Services\TestGeneratorService;

Route::get('/test', function () {
     new TestGeneratorService();

});
