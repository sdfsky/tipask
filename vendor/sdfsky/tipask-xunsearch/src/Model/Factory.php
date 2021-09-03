<?php namespace Sdfsky\TipaskXunSearch\Model;

use App;

/**
 * Class Factory
 *
 * @author davin.bao
 * @package DavinBao\LaravelXunSearch\Model
 */
class Factory
{
    /**
     * @param $className
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \InvalidArgumentException
     */
    public function newInstance($className)
    {
        $baseClass = 'Illuminate\Database\Eloquent\Model';

        if (!is_subclass_of($className, $baseClass)) {
            throw new \InvalidArgumentException(
                "The class '{$className}' must be inherited from dd '{$baseClass}'."
            );
        }

        return App::make($className);
    }

    /**
     * Get class UID for object/class.
     *
     * @param $obj
     * @return string
     * @throws \InvalidArgumentException
     */
    public function classUid($obj)
    {
        $className = is_object($obj) ? get_class($obj) : $obj;

        if (!class_exists($className, true)) {
            throw new \InvalidArgumentException("Class '{$className}' doesn't not exist.");
        }

        return md5($className);
    }
}
