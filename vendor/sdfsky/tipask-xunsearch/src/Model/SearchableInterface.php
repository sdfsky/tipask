<?php namespace DavinBao\LaravelXunSearch\Model;

/**
 * Interface Searchable
 *
 * @author davin.bao
 * @package DavinBao\LaravelXunSearch\Model
 */
interface SearchableInterface
{
    /**
     * Get id list for all searchable models.
     *
     * @return integer[]
     */
    public static function searchableIds();
}
