<?php

return [
    //@see http://www.xunsearch.com/doc/php/guide/ini.guide
    "project" => [
        "project.name" => "demo",
        "project.default_charset" => "utf-8",
        "server.index" => "127.0.0.1:8383",
        "server.search" => "127.0.0.1:8384",
        //remember change FIELD_LABEL_DEFAULT_SEARCH_PK value in Config.php
        "primary_key" => [
            "type" => "id"
        ],
        //remember change FIELD_LABEL_DEFAULT_CLASS_ID value in Config.php
        "class_uid" => [
            "index" => "both"
        ],
        //remember change FIELD_LABEL_DEFAULT_DB_PK value in Config.php
        "id" => [
            "type" => "numeric"
        ],
        "username" => [
            "type" => "title"
        ],
        "email" => [
            "index" => "both"
        ],
        "last_seen" => [
            "type" => "numeric"
        ],
        "role" => [
            "index" => "both"
        ],
        "uri" => [
            "index" => "both"
        ],
        "action" => [
            "index" => "both"
        ],
    ],
    /*
     |--------------------------------------------------------------------------
     | The configurations of search index.
     |--------------------------------------------------------------------------
     |
     | The "models" is the list of the descriptions for models. Each description
     | must contains class of model and fields available for search indexing.
     |
     | For example, model's description can be like this:
     |
     |      'namespace\ModelClass' => [
     |          'fields' => [
     |              'name', 'description', // Fields for indexing.
     |          ]
     |      ]
     |
     */
    'index' => [
        'models' => [
            \App\Models\User::class => [
                'fields' => [
                    'username',
                    'email',
                    'last_seen' => ['type' => 'timestamp'],
                ],
                //primary_key name in DB
                'primary_key' => 'id'
            ],
            \App\Models\Role::class => [
                'fields' => [
                    'role'
                ]
            ],
            \App\Models\Action::class => [
                'fields' => [
                    'uri', 'action'
                ]
            ]
        ],
    ],

];
