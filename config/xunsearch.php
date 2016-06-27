<?php

return [
    //@see http://www.xunsearch.com/doc/php/guide/ini.guide
    "project" => [
        "project.name" => "tipask",
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
        "subject" => [
            "type" => "title"
        ],
        "status" => [
            'type' => "numeric"
        ],
        "content" => [
            "type" => "body"
        ]
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
            \App\Models\Question::class => [
                'fields' => [
                    'title' => [
                        'search_field' => 'subject',
                    ],
                    'description' => [
                        'search_field' => 'content',
                    ],
                    'status' => [
                        'search_field' => 'status',
                    ],
                ],
                'primary_key' => 'id'
            ],
            \App\Models\Article::class => [
                'fields' => [
                    'title' => [
                        'search_field' => 'subject',
                    ],
                    'content' => [
                        'search_field' => 'content',
                    ],
                    'status' => [
                        'search_field' => 'status',
                    ],
                ],
                'primary_key' => 'id'
            ],
            \App\Models\User::class => [
                'fields' => [
                    'name' => [
                        'search_field' => 'subject',
                    ],
                    'title' => [
                        'search_field' => 'content',
                    ],
                    'status' => [
                        'search_field' => 'status',
                    ],
                ],
                'primary_key' => 'id'
            ],
            \App\Models\Tag::class => [
                'fields' => [
                    'name' => [
                        'search_field' => 'subject',
                    ],
                    'summary' => [
                        'search_field' => 'content',
                    ],
                ],
                'primary_key' => 'id'
            ]
        ],
    ],

];
