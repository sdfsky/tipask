<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 15/10/27
 * Time: 下午7:11
 */


if (! function_exists('get_distributed_dir')) {

    /**
     * 生成分布式目录
     * @param $source_id
     * @param $root_path
     * @return string
     */
    function get_distributed_dir($source_id,$root_path)
    {
        $id = sprintf("%09d", $source_id);
        $dir1 = $root_path .'/'. substr($id, 0, 3);
        $dir2 = $dir1 . '/' . substr($id, 3, 2);
        $dir3 = $dir2 . '/' . substr($id, 5, 2);
        return $dir3;
    }
}