<?php

namespace App\Console\Commands;

use App\Repositories\VideoRepository;
use Illuminate\Console\Command;

class SyncAliVideo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:video';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sync ali video info';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(VideoRepository $videoRepository)
    {
        $this->comment('start to sync ali video...');
        $videoRepository->sync();
        $this->comment('finished!');
    }
}
