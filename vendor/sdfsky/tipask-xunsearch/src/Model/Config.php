<?php namespace Sdfsky\TipaskXunSearch\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @TODO add unit tests
 * Class Config
 *
 * @author davin.bao
 * @package DavinBao\LaravelXunSearch\Model
 */
class Config
{

    /**
     * Search field Name enum
     */
    const FIELD_LABEL_DEFAULT_CLASS_ID = 'class_uid';

    const FIELD_LABEL_DEFAULT_SEARCH_PK = 'primary_key';

    const FIELD_LABEL_DEFAULT_DB_PK = 'id';

    /**
     * Search field Type enum
     */
    const FIELD_TYPE_TIMESTAMP = 'timestamp';

    const FIELD_TYPE_STRING = 'string';

    /**
     * The list of configurations for each searchable model.
     *
     * @var array
     */
    private $configuration = [];

    /**
     * Model factory.
     *
     * @var \DavinBao\LaravelXunSearch\Model\Factory
     */
    private $modelFactory;

    /**
     * Create configuration for models.
     *
     * @param array $configuration
     * @param Factory $modelFactory
     * @throws \InvalidArgumentException
     */
    public function __construct(array $configuration, Factory $modelFactory)
    {
        if (empty($configuration)) {
            throw new \InvalidArgumentException('Configurations of index are empty.');
        }

        $this->modelFactory = $modelFactory;

        foreach ($configuration as $className => $options) {

            $fields = array_get($options, 'fields', []);

            if (count($fields) == 0) {
                throw new \InvalidArgumentException(
                    "Parameter 'fields' and/or 'optional_attributes ' for '{$className}' class must be specified."
                );
            }

            $modelRepository = $modelFactory->newInstance($className);
            $classUid = $modelFactory->classUid($className);

            $this->configuration[] = [
                'repository' => $modelRepository,
                'class_uid' => $classUid,
                'fields' => $fields,
                'primary_key' => array_get($options, 'primary_key', self::FIELD_LABEL_DEFAULT_DB_PK)
            ];
        }
    }

    /**
     * Get configuration for model.
     *
     * @param Model $model
     * @return array
     * @throws \InvalidArgumentException
     */
    private function config(Model $model)
    {
        $classUid = $this->modelFactory->classUid($model);

        foreach ($this->configuration as $config) {
            if ($config['class_uid'] === $classUid) {
                return $config;
            }
        }

        throw new \InvalidArgumentException(
            "Configuration doesn't exist for model of class '" . get_class($model) . "'."
        );
    }

    /**
     * Create instance of model by class UID.
     *
     * @param $classUid
     * @return Model
     * @throws \InvalidArgumentException
     */
    private function newInstanceBy($classUid)
    {
        foreach ($this->configuration as $config) {
            if ($config['class_uid'] == $classUid) {
                /** @var Model $repository */
                $repository = $config['repository'];

                return $repository->newInstance();
            }
        }

        throw new \InvalidArgumentException("Can't find class for classUid: '{$classUid}'.");
    }

    /**
     * Get full list of models instances.
     *
     * @return Model[]
     */
    public function repositories()
    {
        $repositories = [];
        foreach ($this->configuration as $config) {
            $repositories[] = $config['repository'];
        }
        return $repositories;
    }

    /**
     * Get 'key-value' pair for private key of model.
     *
     * @param Model $model
     * @return array
     */
    public function primaryKeyPair(Model $model)
    {
        $c = $this->config($model);
        return [self::FIELD_LABEL_DEFAULT_SEARCH_PK, $model->{$c['primary_key']}];
    }

    /**
     * Get 'key-value' pair for UID of model class.
     *
     * @param Model $model
     * @return array
     */
    public function classUidPair(Model $model)
    {
        $c = $this->config($model);
        return [self::FIELD_LABEL_DEFAULT_CLASS_ID, $c['class_uid']];
    }

    /**
     * Get model fields for indexing.
     *
     * @param Model $model
     * @return array
     */
    public function fields(Model $model)
    {
        $fields = [];
        $c = $this->config($model);
        foreach ($c['fields'] as $key => $value) {
            $value['type'] = array_get($value, 'type', self::FIELD_TYPE_STRING);
            $fields[$key] = $value;
        }

        return $fields;
    }

    /**
     * 根据字段类型转换数据库中的字段的值
     * @param $field
     * @return int
     */
    public function getSearchFieldValue($field){
        switch($field['type']){
            case self::FIELD_TYPE_TIMESTAMP:
                return strtotime($field['value']);
            case self::FIELD_TYPE_STRING:
            default:
                return strip_tags($field['value']);
        }
    }

    /**
     * 根据字段类型转换索引服务中的字段的值
     * @param $field
     * @param string $format
     * @return bool|string
     */
    public function getShowFieldValue($field, $format = 'Y-m-d H:i:s'){
        switch($field['type']){
            case self::FIELD_TYPE_TIMESTAMP:
                return date($format, $field['value']);
        }
        return $field['value'];
    }

}
