<?php

namespace Buonzz\Evorg\Commands;

use Illuminate\Console\Command;
use Buonzz\Evorg\Indices\IndexNameBuilder;
use Buonzz\Evorg\Jobs\CreateIndexSchema;
use Buonzz\Evorg\ClientFactory;
use Buonzz\Evorg\Indices\SchemaMappingDecorator;

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
        $this->info('<comment>Connecting to ES Server:</comment> ' . config('evorg.hosts')[0]);

        foreach(config('evorg.event_schemas') as $schema_class)
        {

            $cur_schema = new $schema_class;
            $event_schema = $cur_schema->getEventName();
            $properties = $cur_schema->getMappings();

            $indexname =  $this->idxbuilder->build($event_schema);
            $decorator = new SchemaMappingDecorator($properties);
            $properties = $decorator->decorate();

            $mappings = array(
            'index' =>  $indexname,
            'client' => [ 'ignore' => 400 ],
            'body' => array(
                'settings' => array(
                    'number_of_shards' => config('evorg.number_of_shards'),
                    'number_of_replicas' => config('evorg.number_of_replicas')
                ),
                'mappings' => [ $event_schema => [ 'properties' =>$properties] ]
                )
            );

            $this->info('Building the schema: ' . $event_schema);
            dispatch( new CreateIndexSchema(['indexname' => $indexname, 'mappings' => $mappings]));

            $this->info('Success!');
        }
    }
}