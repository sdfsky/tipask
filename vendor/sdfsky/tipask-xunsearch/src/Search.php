<?php namespace Sdfsky\TipaskXunSearch;

use App;
use Illuminate\Database\Eloquent\Model;
use Sdfsky\TipaskXunSearch\Model\Config as ModelsConfig;
use Sdfsky\TipaskXunSearch\XunSearch\Xs as XunSearch;

/**
 * Class Search
 * Main search class
 *
 * @author sdfsky
 * @package Sdfsky\TipaskXunSearch
 */
class Search
{
    /**
     * @var Connection
     */
    private $xs;

    /**
     * Get descriptor for open index.
     *
     * @return \XSIndex
     */
    public function index()
    {
        return $this->xs->index;
    }

    public function search()
    {
        return $this->xs->search;
    }

    /**
     * Get new document instance
     * @return \XSDocument
     */
    public function getDocumentInstance(){
        return new \XSDocument();
    }

    /**
     * Model configurator.
     *
     * @var Config
     */
    private $config;

    /**
     * @return \Sdfsky\TipaskXunSearch\Model\Config
     */
    public function config()
    {
        return $this->config;
    }

    /**
     * Create index instance.
     *
     * @param string $config
     */
    public function __construct($config, ModelsConfig $modelsConfig)
    {
        $this->xs = new XunSearch($config);
        $this->config =  $modelsConfig;
    }

    /**
     * Destroy the entire index.
     *
     * @return bool
     */
    public function destroy()
    {
        $this->connection->destroy();
    }

    /**
     * All calls of inaccessible methods send to xs->search object.
     *
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->search(), $name], $arguments);
    }

    /**
     * Update document in index for model
     *
     * @param Model $model
     */
    public function update(Model $model)
    {
        // Remove any existing documents for model.
        $this->delete($model);

        // Create new document for model.
        $doc = $this->getDocumentInstance();

        // Add model's class UID.
        list($uidName, $uidValue) = $this->config->classUidPair($model);

        // Add class uid for identification of model's class.
        $doc->setField($uidName, $uidValue);

        list($pkName, $pkValue) = $this->config->primaryKeyPair($model);

        // Add primary key.
        $doc->setField($pkName, $uidValue . '_' . $pkValue);

        //Add id key
        $doc->setField(ModelsConfig::FIELD_LABEL_DEFAULT_DB_PK, $pkValue);

        // Get base fields.
        $fields = $this->config->fields($model);


        // Add fields to document to be indexed (but not stored).
        foreach ($fields as $fieldName => $options) {
            //获取数据库中的值
            $options['value'] = $model->{trim($fieldName)};
            //获取需要索引的数据值
            $value = $this->config()->getSearchFieldValue($options);
            // Get base fields.
            $doc->setField($options['search_field'], $value);
        }

        $this->index()->add($doc);
    }

    /**
     * Delete document for model from index.
     *
     * @param Model $model
     */
    public function delete(Model $model)
    {
        list($uidName, $uidValue) = $this->config->classUidPair($model);
        list($pkName, $pkValue) = $this->config->primaryKeyPair($model);
        $this->index()->del($uidValue . '_' . $pkValue); // delete document from index by ID of hit.
    }
}
