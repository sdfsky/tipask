<?php namespace Sdfsky\TipaskXunSearch\XunSearch;

use App;

/**
 * Class XsSearch
 * Rewrite class XSSearch
 *
 * @author davin.bao
 * @package DavinBao\LaravelXunSearch\XunSearch
 */
class XsSearch extends \XSSearch
{

    public function model($model){

        $search = App::make('search');
        list($uidName, $uidValue) = $search->config()->classUidPair($model);
        $this->addQuery($uidName . ':' . $uidValue);

        return $this;
    }

    public function addQuery($query, $addOp=0, $scale=1){
        $this->addQueryString($query, $addOp, $scale);
        return $this;
    }

    public function getIDList($query = null, $saveHighlight = true){

        $result = $this->search($query, $saveHighlight);

        $array = [];

        foreach ($result as $item) {
            $array[] = $item['id'];
        }

        return $array;
    }
}