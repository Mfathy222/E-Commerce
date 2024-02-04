<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Redirect;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request=request();

        $categories =Category::filter($request->query())->paginate(2); // return object coll
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create', compact('category', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validtion
        $clean_data=$request->validate(Category::rules());

        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        // uploade image in public
        $data = $request->except('image');


        $data['image'] = $this->UploadImage($request);

        $category = Category::create($data);
        //prg
        return Redirect::route('dashboard.categories.index')
        ->with('success', 'Category Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // select*from categories where
        //id != $id AND(parent_id IS NULL OR parent_id != $id)
        $category = Category::FindOrFail($id);
        $parents = Category::where('id', '!=', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orwhere('parent_id', '!=', $id);
            })
            ->get();

        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        // $request->validate(Category::rules($id));

        $category = Category::FindOrFail($id);
        //update image and delete old image
        $old_image = $category->image;
        $data = $request->except('image');

        $new_image = $this->UploadImage($request);
        if ($new_image) {
            $data['image']=$new_image;
        }

        $category->update($data);

        if ($old_image && $new_image) {
        Storage::disk('public')->delete($old_image);
        }

        return Redirect::route('dashboard.categories.index')
        ->with('success', 'Category updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::FindOrFail($id);
        $category->delete();

        // if ($category->image) {
        //     Storage::disk('public')->delete($category->image);
        // }
        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category deleted');
    }

    //function upload image

    protected function UploadImage(Request $request)
    {
        if (!$request->file('image'))
        {
        return;
        }
        $file = $request->file('image');
        $path = $file->store('uploads', 'public');
        return $path;
    }

    //softdelete & trash
    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash', compact('categories'));
    }

    public function restore(Request $request, $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('dashboard.categories.trash')
            ->with('succes', 'Category restored!');
    }

    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        return redirect()->route('dashboard.categories.trash')
            ->with('succes', 'Category deleted forever!');
    }

}
