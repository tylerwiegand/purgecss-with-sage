<?php

namespace tylerwiegand\PurgecssWithSage\Console;

use Illuminate\Support\Arr;
use Roots\Acorn\Console\Commands\Command;
use WP_Query;

class PurgecssWithSage extends Command {

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'purgecss-with-sage';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Creates a file in your /views directory containing 
                              all the classes used in your Gutenberg blocks.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $query = new WP_Query([
                                  'posts_per_page' => -1,
                                  'post_status'    => 'published',
                                  'order'          => 'DESC',
                                  'post_type'      => 'any',
                              ]);

        $posts = $query->get_posts();

        $classArray = [];

        foreach($posts as $post) {
            preg_match_all('/(?:"className":)(?:\s|)(?:")([\d\w\s\-:]*)(?:")/m', $post->post_content, $matches);
            if(isset($matches[ 1 ])) {
                $classArray[] = $matches[ 1 ];
            }
        }

        if(class_exists('GFAPI')) {
            $forms = \GFAPI::get_forms();
            if(is_iterable($forms) && !empty($forms)) {
                foreach($forms as $form) {
                    if(is_array($form[ 'fields' ]) && isset($form[ 'fields' ]) && !empty($form[ 'fields' ])) {
                        foreach($form[ 'fields' ] as $field) {
                            $classArray[] = explode(" ", $field[ 'cssClass' ]);
                        }
                    }
                }
            }
        }

        $classArray = Arr::flatten($classArray);
        $classArray = array_unique($classArray);
        $classes    = implode(" ", $classArray);

        $filename = 'classes.blade.php';
        $path     = get_theme_file_path('resources/views/vendor/purgecss-with-sage/');

        if(!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        $result = file_put_contents($path . $filename, $classes);
        if($result > 0) {
            return $this->info("PurgeCSS with Sage: File created at {$path}{$filename}.");
        } else {
            return $this->error("PurgeCSS with Sage: Did not output file!");
        }
    }
}
