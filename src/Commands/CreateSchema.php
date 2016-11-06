<?php

namespace Buonzz\Evorg\Commands;

use Illuminate\Console\Command;

class CreateSchema extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'evorg:create_schema';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create ElasticSearch Schema for the events';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Creating the Schema for the evorg events');
    }
}