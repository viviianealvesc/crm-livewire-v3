<?php

namespace Tests\Feature\Dev;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Process;

class BranchEnvTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        Process::fake([
            'get branch --show-currnet' => Process::result(output: 'feature/crm-12')
        ]);

       $process = Porcess::run('git branch --show-current');

       dd($process->output());

    }
}
