<?php

namespace Karu\SimpleJsLocalization\Command;

use Illuminate\Console\Command;

class GenerateLangJs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'localization:generate-js';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate JS to use language json file for localization/transalation';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $files   = glob(resource_path('lang/*.json'));
        $strings = [];
        foreach ($files as $file) {
            $name           = basename($file, '.json');
            $open = fopen($file, 'r');
            $message = fread($open, filesize($file));
            $close = fclose($open);
            $strings['locale.'.$name] = json_decode($message);
        }

        $dfFile = __DIR__."/../js/localization.js";
        $dafaultFile = fopen($dfFile, "r");
        $dfContent = fread($dafaultFile, filesize($dfFile));
        fclose($dafaultFile);

        $data = "const message=".json_encode($strings).";\n\n\n".$dfContent;

        $wFile = fopen(public_path('js/simple-js-localise.js'), "w");
        fwrite($wFile,$data);
        fclose($wFile);
    }
}
