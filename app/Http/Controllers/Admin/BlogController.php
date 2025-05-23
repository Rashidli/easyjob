<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Services\ImageUploadService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function __construct(protected ImageUploadService $imageUploadService)
    {
        $this->middleware('permission:list-blogs|create-blogs|edit-blogs|delete-blogs', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-blogs', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-blogs', ['only' => ['edit']]);
        $this->middleware('permission:delete-blogs', ['only' => ['destroy']]);
    }

    public function generateUniqueSlug($title)
    {
        $slug  = Str::slug($title);
        $count = Blog::whereTranslation('title', $title)->count();

        if ($count > 0) {
            $slug .= '-' . $count;
        }

        return $slug;
    }

    public function index()
    {
        $blogs = Blog::query()->orderByDesc('id')->paginate(10);

        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.blogs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'az_title'       => 'required',
            'en_title'       => 'required',
            'ru_title'       => 'required',
            'az_img_alt'     => 'nullable',
            'en_img_alt'     => 'nullable',
            'ru_img_alt'     => 'nullable',
            'az_img_title'   => 'nullable',
            'en_img_title'   => 'nullable',
            'ru_img_title'   => 'nullable',
            'az_description' => 'required',
            'en_description' => 'required',
            'ru_description' => 'required',
            'image'          => 'required',
        ]);
        DB::beginTransaction();
        try {
            if ($request->hasFile('image')) {
                $filename = $this->imageUploadService->upload($request->file('image'));
            }

            Blog::create([
                'image'       => $filename,
                'category_id' => $request->category_id,
                'az'          => [
                    'title'            => $request->az_title,
                    'description'      => $request->az_description,
                    'img_alt'          => $request->az_img_alt,
                    'img_title'        => $request->az_img_title,
                    'slug'             => $this->generateUniqueSlug($request->az_title),
                    'meta_title'       => $request->az_meta_title,
                    'meta_description' => $request->az_meta_description,
                    'meta_keywords'    => $request->az_meta_keywords,
                ],
                'en' => [
                    'title'            => $request->en_title,
                    'description'      => $request->en_description,
                    'img_alt'          => $request->en_img_alt,
                    'img_title'        => $request->en_img_title,
                    'slug'             => $this->generateUniqueSlug($request->en_title),
                    'meta_title'       => $request->en_meta_title,
                    'meta_description' => $request->en_meta_description,
                    'meta_keywords'    => $request->en_meta_keywords,
                ],
                'ru' => [
                    'title'            => $request->ru_title,
                    'description'      => $request->ru_description,
                    'img_alt'          => $request->ru_img_alt,
                    'img_title'        => $request->ru_img_title,
                    'slug'             => $this->generateUniqueSlug($request->ru_title),
                    'meta_title'       => $request->ru_meta_title,
                    'meta_description' => $request->ru_meta_description,
                    'meta_keywords'    => $request->ru_meta_keywords,
                ],
            ]);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            return $exception->getMessage();
        }

        return redirect()->route('blogs.index')->with('message', 'Blog added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog): void {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $categories = Category::all();

        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'az_title'       => 'required',
            'en_title'       => 'required',
            'ru_title'       => 'required',
            'az_img_alt'     => 'nullable',
            'en_img_alt'     => 'nullable',
            'ru_img_alt'     => 'nullable',
            'az_img_title'   => 'nullable',
            'en_img_title'   => 'nullable',
            'ru_img_title'   => 'nullable',
            'az_description' => 'required',
            'en_description' => 'required',
            'ru_description' => 'required',
        ]);
        DB::beginTransaction();
        try {
            if ($request->hasFile('image')) {
                $blog->image = $this->imageUploadService->upload($request->file('image'));
            }

            $blog->update([
                'is_active'   => $request->is_active,
                'category_id' => $request->category_id,
                'az'          => [
                    'title'            => $request->az_title,
                    'img_alt'          => $request->az_img_alt,
                    'img_title'        => $request->az_img_title,
                    'description'      => $request->az_description,
                    'meta_title'       => $request->az_meta_title,
                    'meta_description' => $request->az_meta_description,
                    'meta_keywords'    => $request->az_meta_keywords,
                ],
                'en' => [
                    'title'            => $request->en_title,
                    'img_alt'          => $request->en_img_alt,
                    'img_title'        => $request->en_img_title,
                    'description'      => $request->en_description,
                    'meta_title'       => $request->en_meta_title,
                    'meta_description' => $request->en_meta_description,
                    'meta_keywords'    => $request->en_meta_keywords,
                ],
                'ru' => [
                    'title'            => $request->ru_title,
                    'img_alt'          => $request->ru_img_alt,
                    'img_title'        => $request->ru_img_title,
                    'description'      => $request->ru_description,
                    'meta_title'       => $request->ru_meta_title,
                    'meta_description' => $request->ru_meta_description,
                    'meta_keywords'    => $request->ru_meta_keywords,
                ],
            ]);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            return $exception->getMessage();
        }

        return redirect()->back()->with('message', 'Blog updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blogs.index')->with('message', 'Blog deleted successfully');
    }
}
