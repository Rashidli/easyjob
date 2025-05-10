<?php

namespace App\Providers;

use App\Models\Image;
use App\Models\Single;
use App\Models\Social;
use App\Models\Tag;
use App\Models\Touch;
use App\Models\Word;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local') && class_exists(\Laravel\Telescope\TelescopeServiceProvider::class)) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $logo = Image::query()->orderBy('id')->first();
        $favicon = Image::query()->orderByDesc('id')->first();
        Carbon::setLocale(config('app.locale'));

        $home_page = Single::query()->where('type' , 'home_page')->first();
        $category_page = Single::query()->where('type' , 'categories')->first();
        $company_page = Single::query()->where('type' , 'companies')->first();
        $favorite_page = Single::query()->where('type' , 'favorites')->first();
        $blog_page = Single::query()->where('type' , 'blogs')->first();
        $post_vacancy = Single::query()->where('type' , 'post_vacancy')->first();
        $contact = Single::query()->where('type' , 'contact')->first();
        $about_page = Single::query()->where('type' , 'about')->first();
        $socials = Social::active()->get();
        $words = Word::all()->keyBy('key');
        $tags = Tag::all();

        View::share([
            'logo' => $logo,
            'favicon' => $favicon,
            'home_page' => $home_page,
            'category_page' => $category_page,
            'company_page' => $company_page,
            'favorite_page' => $favorite_page,
            'blog_page' => $blog_page,
            'about_page' => $about_page,
            'post_vacancy' => $post_vacancy,
            'contact' => $contact,
            'tags' => $tags,
            'socials' => $socials,
            'words' => $words,
        ]);
    }
}
