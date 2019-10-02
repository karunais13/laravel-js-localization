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
    protected $signature = 'localization:generate-js 
                            {--c|compress : Compress the JavaScript file.}';

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
     * @throws \Exception
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

        $description = "/**
* Simple JS Localization (https://karunais13.github.io/simple-js-localization/)
*
* @author Karunaiswaran (karunais1329@gmail.com)
**/";

        $data = "const message=".json_encode($strings).";\n\n\n".$dfContent;

        if( $this->option('compress') ) {
            $data = \JShrink\Minifier::minify($data);
        }

        $data = $description."\n\n".$data;

        $path = 'js/simple-js-localise.js';

        $wFile = fopen(public_path($path), "w");
        fwrite($wFile,$data);
        fclose($wFile);

        $this->info("JS file has been generated at\033[1;33m [public/{$path}]\033[0m");
    }
}
