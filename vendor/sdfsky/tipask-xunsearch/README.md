Laravel 5.1 XunSearch
==============

[![Latest Stable Version](https://poser.pugx.org/davin-bao/laravel-xun-search/v/stable.png)](https://packagist.org/packages/davin-bao/laravel-xun-search)
[![Latest Unstable Version](https://poser.pugx.org/davin-bao/laravel-xun-search/v/unstable.png)](https://packagist.org/packages/davin-bao/laravel-xun-search)
[![License](https://poser.pugx.org/davin-bao/laravel-xun-search/license.png)](https://packagist.org/packages/davin-bao/laravel-xun-search)
[![Total Downloads](https://poser.pugx.org/davin-bao/laravel-xun-search/downloads)](https://packagist.org/packages/davin-bao/laravel-xun-search)

Laravel 5.1 package for full-text search over Eloquent models based on XunSearch.

## Installation

Require this package in your composer.json and run composer update:

```json
{
	"require": {
        "sdfsky/tipask-xunsearch": "dev-master"
	}
}
```

After updating composer, add the ServiceProvider to the providers array in `app/config/app.php`

```php
'providers' => [
	Sdfsky\TipaskXunSearch\ServiceProvider::class,
],
```

If you want to use the facade to search, add this to your facades in `app/config/app.php`:

```php
'aliases' => [
	'Search' => Sdfsky\TipaskXunSearch\Facade::class,
],
```
## Configuration 

Publish the config file into your project by running:

```bash
php artisan vendor:publish --provider="Sdfsky\TipaskXunSearch\ServiceProvider"
```
###Basic
In published config file add descriptions for models which need to be indexed, for example:

```php

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

'index' => [
	
	// ...

	namespace\FirstModel::class => [
		'fields' => [
			'name', 'full_description', // fields for indexing
		],
		'primary_key' => 'id'  //primary_key name in DB, default 'id'
	],
	
	namespace\SecondModel::class => [
		'fields' => [
			'name', 'short_description', // fields for indexing
		]
	],
	
	// ...
	
],

```

## Usage
### Artisan commands
#### Initialize or rebuild search index
For building of search index run:

```bash
php artisan search:rebuild --verbose
```
#### Clear search index
For clearing of search index run:

```bash
php artisan search:clear
```
#### Filtering of models in search results 
For filtering of models in search results each model's class can implements `SearchableInterface`.
For example:

```php

use Illuminate\Database\Eloquent\Model;
use DavinBao\LaravelXunSearch\Model\SearchableInterface;

class Dummy extends Model implements SearchableInterface
{
        // ...

        /**
         * Get id list for all searchable models.
         */
        public static function searchableIds()
        {
            return self::wherePublish(true)->lists('id');
        }

        // ...
}

```

### Partial updating of search index
For register of necessary events (save/update/delete) `use DavinBao\LaravelXunSearch\Model\SearchTrait` in target model:

```php

    use Illuminate\Database\Eloquent\Model;
    use DavinBao\LaravelXunSearch\Model\SearchableInterface;
    use DavinBao\LaravelXunSearch\Model\SearchTrait;

    class Dummy extends Model implements SearchableInterface
    {
        use SearchTrait;
    
        // ...
    }

```

### Query building
Build query in several ways:

#### Using constructor:

By default, queries which will execute search in the **phrase entirely** are created.

##### Simple queries
```php
$query = Model::getSearch()->addQuery("clock"); // search by all fields.
// or 
$query = Model::getSearch()->addQuery('name:clock'); // search by 'name' field.
// or
$query = Model::getSearch()->addQuery('name:clock'); // filter by 'short_description' field.

$Ids = Model::getSearch()->addQuery('name:clock')->getIDList(); // filter by 'short_description' field.
```

### Getting of results

For built query are available following actions:

#### Get all found models

```php
$models = $query->search();
```

#### Get all found models ID

```php
$models = $query->getIDList();
```

#### Get count of results
```php
$count = $query->count();
```

#### Get limit results with offset

```php
$models = $query->limit(5, 10)->get(); // Limit = 5 and offset = 10
```
#### Sort

```php
$query = $query->setSort('chrono', true);
```
### Highlighting of matches

Highlighting of matches is available for any html fragment encoded in **utf-8** and is executed only for the last executed request.

```php

$docs = $search->setQuery('测试')->setLimit(5)->search();
foreach ($docs as $doc)
{
   $subject = $search->highlight($doc->subject); // 高亮处理 subject 字段
   $message = $search->highlight($doc->message); // 高亮处理 message 字段
   echo $doc->rank() . '. ' . $subject . " [" . $doc->percent() . "%] - ";
   echo date("Y-m-d", $doc->chrono) . "\n" . $message . "\n";
}

```
##
## License
Package licenced under the MIT license.
