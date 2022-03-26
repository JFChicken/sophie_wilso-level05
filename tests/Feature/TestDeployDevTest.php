<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TestDeployDevTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_DatabaseDeploy()
    {

        $this->artisan('deploy:dev')
            ->expectsConfirmation('Deploy new Database?', 'no')
            ->assertExitCode(1);


        $this->artisan('deploy:dev')
            ->expectsConfirmation('Deploy new Database?', 'yes')
            ->assertExitCode(0);

        $this->assertFileExists('database/database.sqlite','missing database file');


        // Also need to assert that it exist in env file to before this can pass
        $this->artisan('migrate')
            ->assertExitCode(0);


    }
}
