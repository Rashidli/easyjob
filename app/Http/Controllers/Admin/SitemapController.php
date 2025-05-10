<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Single;
use App\Models\Vacancy;

class SitemapController extends Controller
{
    public function sitemap()
    {
        $singles   = Single::with('translations')->get();
        $blogs     = Blog::active()->with('translations')->get();
        $vacancies = Vacancy::take(15)->get();

        return response()->view('front.sitemap', compact('singles', 'blogs', 'vacancies'))->header('Content-type', 'text/xml');
    }
}
