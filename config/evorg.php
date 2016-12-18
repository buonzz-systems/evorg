<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application ID
    |--------------------------------------------------------------------------
    |
    | This is going to be used as "db" name when creating the ElasticSearch Schema
    | and should be unique per application. Since this will be a part of the ES
    | index name, make sure it is only alpha-numeric and doesnt contains whitespaces
    */
	'app_id' => 'default',		

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | A descriptive name for this application, this is something that is meant to
    | shown in dashboards and reports for example.
    */
	'app_name' => 'Default Application',

    /*
    |--------------------------------------------------------------------------
    | Evorg Logging
    |--------------------------------------------------------------------------
    |
    | When set to true, it writes all the ElasticSearch operations 
    | to storage/logs/evorg.log 
    | can be useful in troubleshooting and monitoring purposes.
    */
	'logging' => true,

    /*
    |--------------------------------------------------------------------------
    | Number of Shards
    |--------------------------------------------------------------------------
    |
    |  An index can potentially store a large amount of data that can exceed the 
    |  hardware limits of single server. You can split an enormously huge amount 
    |  of data into shards so it can be split between multiple servers and then 
    |  query it as if its just a single database. If you expect to have tons of 
    |  data, adjust this to higher values. 
    */
	'number_of_shards' => 2,

    /*
    |--------------------------------------------------------------------------
    | Number of Replicas
    |--------------------------------------------------------------------------
    |
    | You can instruct ElasticSearch to store multiple copies of your data into
    | multiple servers. This increases the chances of your data to be recovered
    | when lets say a hardware failure occured. It is also needed to be increased
    | when you have a lots of read queries that needs to be distributed to multiple
    | servers.
    */
	'number_of_replicas' => 1,

    /*
    |--------------------------------------------------------------------------
    | hostnames of your ElasticSearch Servers
    |--------------------------------------------------------------------------
    |
    | This is an array of IP, domain name or hostname of the ElasticSearch servers.
    | You dont have to worry about which one is master/slave since it is automatically
    | being decided by the cluster itself.
    */
	'hosts' => ['localhost'],


    /*
    |--------------------------------------------------------------------------
    | connection timetout to ES
    |--------------------------------------------------------------------------
    |
    | how long curl should wait for the "connect" phase to finish.
    */
    'connect_timeout' => 2,

    /*
    |--------------------------------------------------------------------------
    | query timetout to ES
    |--------------------------------------------------------------------------
    |
    | how long curl should wait for the entire request to finish
    */
    'query_timeout' => 5,


    /*
    |--------------------------------------------------------------------------
    | how old the indices you want to query?
    |--------------------------------------------------------------------------
    |
    | Each month a, a new index is being created. By default, querying operations
    | only searches the current month, previous month and a month before the previous
    | month. You can increase this value to query as much index you like.
    */
    'query_months' => 3,

    /*
    |--------------------------------------------------------------------------
    | The Event Schemas
    |--------------------------------------------------------------------------
    |
    | Although you can virtuall insert anything in the eventData parameter when 
    | inserting data. There are certain cases wherein you need to explicitly define
	| the datatype of a certain field. Specially when you need to query it by its 
	| exact value instead of doing a fuzzy searching.   
	*/

	'event_schemas' =>[
		'click' => [ 
            'timestamp' => ['type'=> 'date', 'index' => 'not_analyzed'],
            'ip'=> ['type' => "ip"],
            'user_agent' => ['type' => "string"],
            'app_id' => ['type' => 'string', 'index' => 'not_analyzed'],
            'app_name' => ['type' => 'string', 'index' => 'not_analyzed'],
            'element' => ['type' => 'string', 'index' => 'not_analyzed']
         ],
        'pageview' => [ 
            'timestamp' => ['type'=> 'date', 'index' => 'not_analyzed'],
            'ip'=> ['type' => "ip"],
            'user_agent' => ['type' => "string"],
            'app_id' => ['type' => 'string', 'index' => 'not_analyzed'],
            'app_name' => ['type' => 'string', 'index' => 'not_analyzed'],
            'element' => ['type' => 'string', 'index' => 'not_analyzed']
         ]
	]
];
