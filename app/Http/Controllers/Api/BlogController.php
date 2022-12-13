<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use App\Traits\HasImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\HasApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;

class BlogController extends Controller
{
    use HasImage, HasApiResponse;

    public function index(Request $request)
    {
        try {
            $blogs = Blog::latest()->search($request->search)->get();
            if(count($blogs) > 0){
                return $this->success($blogs, 'Success Get Blogs Data');
            }

            return $this->error("","No Blogs Found");
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    public function store(StoreBlogRequest $request)
    {
        DB::beginTransaction();
        try {
            $file = $request->validated('thumbnail');
            $this->uploadImage($file,'blogs');

            $blog = Blog::create([
                'title'         => $request->validated('title'),
                'slug'          => Str::slug($request->validated('title')),
                'description'   => $request->validated('description'),
                'thumbnail'     => $file->hashName(),
            ]);

            DB::commit();
            return $this->success($blog, 'Blog Has Been Created');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
        }
    }

    public function show(Blog $blog)
    {
        try {
            return $this->success($blog, 'Success Get Blog Data');
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        DB::beginTransaction();
        try {
            if($request->hasFile('thumbnail')){
                $file = $request->validated('thumbnail');
                $this->removeImage($blog->thumbnail, 'blogs');
                $this->uploadImage($file,'blogs');

                $blog->update([
                    'title'         => $request->validated('title'),
                    'slug'          => Str::slug($request->validated('title')),
                    'description'   => $request->validated('description'),
                    'thumbnail'     => $file->hashName(),
                ]);
            }

            $blog->update([
                'title'         => $request->validated('title'),
                'slug'          => Str::slug($request->validated('title')),
                'description'   => $request->validated('description')
            ]);

            DB::commit();
            return $this->success($blog, 'Blog Has Been Updated');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
        }
    }

    public function destroy(Blog $blog)
    {
        DB::beginTransaction();
        try {
            $blog->delete();

            DB::commit();
            return $this->success($blog, 'Blog Has Been Deleted');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
        }
    }
}
