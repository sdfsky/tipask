<?php  namespace Sdfsky\TipaskXunSearch\Console;

use App;
use Illuminate\Console\Command;
use Symfony\Component\Console\Output\NullOutput;

/**
 * Class ClearCommand
 * clear all search index
 * @author davin.bao
 * @package DavinBao\LaravelXunSearch\Console
 */
class ClearCommand extends Command
{
    protected $name = 'search:clear';
    protected $description = 'Clear the search index storage';

    public function handle()
    {
        if (!$this->option('verbose')) {
            $this->output = new NullOutput;
        }

        /** @var Search $search */
        $search = App::make('search');

        //clear all index
        $search->index()->clean();

        $this->info('Search index is cleared.');

    }
}
