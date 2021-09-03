<?php namespace Sdfsky\TipaskXunSearch\XunSearch;

/**
 * Class Xs
 * Rewrite class XS
 *
 * @author davin.bao
 * @package DavinBao\LaravelXunSearch\XunSearch
 */
class Xs extends \XS
{
    /**
     * Init by laravel Config
     * @param $config see demo.ini file
     */
    public function __construct($config)
    {
        self::setConfig($config);

        $scheme = new \XSFieldScheme();
        foreach ($this->_config as $key => $value) {
            if (is_array($value)) {
                $scheme->addField($key, $value);
            }
        }
        $scheme->checkValid(true);

        $this->_scheme = $this->_bindScheme = $scheme;
        $this->setScheme($scheme);

    }

    public function getSearch()
    {

        if ($this->_search === null) {
            $conns = array();
            if (!isset($this->_config['server.search'])) {
                $conns[] = 8384;
            } else {
                foreach (explode(';', $this->_config['server.search']) as $conn) {
                    $conn = trim($conn);
                    if ($conn !== '') {
                        $conns[] = $conn;
                    }
                }
            }
            if (count($conns) > 1) {
                shuffle($conns);
            }
            for ($i = 0; $i < count($conns); $i++) {
                try {
                    $this->_search = new XsSearch($conns[$i], $this);
                    $this->_search->setCharset($this->getDefaultCharset());
                    return $this->_search;
                } catch (XSException $e) {
                    if (($i + 1) === count($conns)) {
                        throw $e;
                    }
                }
            }
        }
        return $this->_search;
    }
}
