<?php

namespace Buonzz\Evorg\Commands;

use Illuminate\Console\Command;
use Buonzz\Evorg\IndexNameBuilder;
use Elasticsearch\ClientBuilder;
use Monolog\Logger;

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

    private $idxbuilder;

    public function __construct()
    {
        parent::__construct();
        $this->idxbuilder = new IndexNameBuilder;
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Creating the Schema for the evorg events');

        foreach(config('evorg.event_schemas') as $event_schema=>$mappings)
        {

            $indexname =  $this->idxbuilder->build($event_schema);

            $mappings = array(
            'index' =>  $indexname,
            'body' => array(
                'settings' => array(
                    'number_of_shards' => config('evorg.number_of_shards'),
                    'number_of_replicas' => config('evorg.number_of_replicas')
                ),
                'mappings' => [ $event_schema => $mappings ]
                )
            );

            $this->info('<comment>Connecting to ES Server:</comment> ' . config('evorg.hosts')[0]);
            $client = ClientBuilder::create() 
                            ->setHosts(config('evorg.hosts'))
                            ->build();

            $this->info('Building the schema');
            $client->indices()->create($mappings);
            $this->info('Success!');
        }
    }
}