<?php namespace DavinBao\LaravelXunSearch\Model;

use App;

/**
 * Trait SearchTrait
 *
 * @author davin.bao
 * @package DavinBao\LaravelXunSearch\Model
 */
trait SearchTrait
{
    public static function getSearch(){
        /** @var Search $search */
        $search = App::make('search');
        return $search->search()->model(new self);
    }

    /**
     * Set event handlers for updating of search index.
     */
    public static function bootSearchTrait()
    {
        self::saved(
            function ($model) {
                App::offsetGet('search')->update($model);
            }
        );

        self::deleting(
            function ($model) {
                App::offsetGet('search')->delete($model);
            }
        );
    }

}
