<?php

namespace FleetCart\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Modules\FptService\Entities\FptCategory;
use Modules\Group\Entities\Group;
use Modules\Post\Entities\Post;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap.xml file';

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
     * @return int
     */
    public function handle()
    {
        $indexPath = public_path('sitemap.xml');
        $pagesPath = '/pages_sitemap.xml';
        $postsPath = '/posts_sitemap.xml';
        $servicesPath = '/services_sitemap.xml';
        $postCategoriesPath = '/post_categories_sitemap.xml';

        SitemapIndex::create()
            ->add(Sitemap::create($pagesPath)
                ->setLastModificationDate(Carbon::now()))
            ->add(Sitemap::create($postsPath)
                ->setLastModificationDate(Carbon::now())
            )->add(Sitemap::create($servicesPath)
                ->setLastModificationDate(Carbon::now())
            )
            ->add(Sitemap::create($postCategoriesPath)
                ->setLastModificationDate(Carbon::now())
            )
            ->writeToFile($indexPath);

        // Generate pages_sitemap.xml
        $pageSitemap =  \Spatie\Sitemap\Sitemap::create()
            ->add(
                Url::create(route('home'))
                    ->setLastModificationDate(Carbon::now())
                    ->setPriority(0.8)
            );
        $pageSitemap->writeToFile(public_path($pagesPath));

        // Generate posts_sitemap.xml
        $posts = Post::all();
        $postSitemap =  \Spatie\Sitemap\Sitemap::create();

        foreach ($posts as $post) {
            $postSitemap
                ->add(
                    Url::create($post->url())
                    ->setLastModificationDate($post->updated_at)
                    ->setPriority(0.8)
                );
        }
        $postSitemap->writeToFile(public_path($postsPath));

        // Generate services_sitemap.xml
        $serviceSitemap =  \Spatie\Sitemap\Sitemap::create();
        $fptCategories = FptCategory::searchable()->get();

        foreach ($fptCategories as $fptCategory) {
            $serviceSitemap
                ->add(
                    Url::create($fptCategory->url())
                        ->setLastModificationDate($fptCategory->updated_at)
                        ->setPriority(0.8)
                );
        }
        $serviceSitemap->writeToFile(public_path($servicesPath));

        //Generate post_categories_sitemap.xml
        $postCategorySitemap =  \Spatie\Sitemap\Sitemap::create();
        $groups = Group::searchable()->get();

        $postCategorySitemap
            ->add(
                Url::create(route('fpt.news'))
                    ->setLastModificationDate(Carbon::now())
                    ->setPriority(0.8)
            );

        foreach ($groups as $group) {
            $postCategorySitemap
                ->add(
                    Url::create($group->url())
                    ->setLastModificationDate($group->updated_at)
                    ->setPriority(0.8)
                );
        }
        $postCategorySitemap->writeToFile(public_path($postCategoriesPath));

        $this->info('Sitemap generated successfully.');
    }
}
