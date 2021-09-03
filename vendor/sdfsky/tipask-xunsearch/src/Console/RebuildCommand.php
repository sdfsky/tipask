<?php namespace Sdfsky\TipaskXunSearch\Console;

use App;
use Config;
use Illuminate\Console\Command;
use Sdfsky\TipaskXunSearch\Search;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\NullOutput;

/**
 * Class RebuildCommand
 * Rebuild search index
 * @author davin.bao
 * @package DavinBao\LaravelXunSearch\Console
 */
class RebuildCommand extends Command
{
    protected $name = 'search:rebuild';
    protected $description = 'Rebuild the search index';

    public function handle()
    {
        if (!$this->option('verbose')) {
            $this->output = new NullOutput;
        }
        //XunSearch 已经在平滑重建索引时清除了所有旧索引
//        $this->call('search:clear');

        /** @var Search $search */
        $search = App::make('search');
      //dd(App\Models\User::getSearch()->addQuery("admin")->count());
        // 结束上次可能出现异常的重建索引
        $search->index()->stopRebuild();
        // 宣布开始重建索引
        $search->index()->beginRebuild();

        $modelRepositories = Config::get('xunsearch.index.models');
        if (count($modelRepositories) > 0) {
            foreach ($modelRepositories as $modelName=>$value) {
                if(!class_exists($modelName)){
                    $this->info('Not exist model: "' . $modelName . '"');
                    continue;
                }
                $modelRepository = new $modelName();
                $this->info('Creating index for model: "' . get_class($modelRepository) . '"');

                $all = $modelRepository->all();

                $count = count($all);
                //输出 Model 数量
                echo $count . ' ';

                if ($count > 0) {
                    $progress = new ProgressBar($this->getOutput(), $count);
                    foreach ($all as $model) {
                        $search->update($model);
                        $progress->advance();
                    }
                    $progress->finish();

                } else {
                    $this->comment(' No available models found. ');
                }

            }
            $this->info(PHP_EOL . 'Operation is fully complete!');
        } else {
            $this->error('No models found in config.php file..');
        }
        // 告诉服务器重建完比
        $search->index()->endRebuild();
        sleep(5);

        //输出所有 Document 数量
        echo $search->search()->getDbTotal();

    }
}
