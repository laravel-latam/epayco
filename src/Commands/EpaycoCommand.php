<?php

namespace LaravelLatam\Epayco\Commands;

use Illuminate\Console\Command;

class EpaycoCommand extends Command
{
    public $signature = 'epayco';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
