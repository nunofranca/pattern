<?php

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;


test('Create Service With Interface', function () {
   $teste = $this->artisan('create:service', [
        'name' => 'Test',
        '--interface' => true
    ]);

    $resource = config('pattern_paths.paths.services')."Test/TestService.php";

    expect($resource)->toBeResource();

});


