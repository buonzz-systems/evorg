<?php

namespace Buonzz\Evorg\Commands;

use Illuminate\Console\Command;
use Buonzz\Evorg\Indices\IndexNamesRetriever;

class OptimizeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'evorg:optimize';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Optimize ElasticSearch indices.';
    /**
     * Create a new command instance.
     *
     * @return void
     */

    private $idx_names;

    public function __construct()
    {
        parent::__construct();
        $this->idx_names = new IndexNamesRetriever;
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('initiating..');


        if($this->confirm('Are you sure you want to delete all documents, indices and templates of your application?'))
        {
            
        }
        else
            $this->info("Operation aborted");   
    }
}