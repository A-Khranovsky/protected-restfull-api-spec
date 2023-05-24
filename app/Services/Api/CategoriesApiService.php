<?php


namespace App\Services\Api;


use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesApiService
{
    private Request $request;
    private ?Builder $filteredQuery;

    public function __construct(Request $request, QueryFilter $queryFilter)
    {
        $this->request = $request;
        $this->filteredQuery = $queryFilter->filter(new Category, $request);
    }

    public function getAll()
    {
        if (!is_null($this->filteredQuery)) {
            $categories = $this->filteredQuery->get();
            return response()->json($categories);
        } else {
            $categories = Category::all();
            return response()->json($categories);
        }
    }

    public function getById(int $id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    public function store(CategoryRequest $request)
    {
        Category::create(
            [
                'name' => $request->name
            ]
        );
        return response()->json(['message' => 'Successfully stored'], 201);
    }

    public function update(int $id, CategoryRequest $request)
    {
        $category = Category::whereId($id)->firstOr(function(){
            return null;
        });

        if(is_null($category)){
            return response()->json(['message' => 'Wrong Id'], 400);
        } else {
            $category->update($request->toArray());
            return response()->json(['message' => 'Successfully updated'], 201);
        }
    }

    public function destroyById(int $id)
    {
        $category = Category::whereId($id)->firstOr(function(){
            return null;
        });

        if(is_null($category)){
            return response()->json(['message' => 'Wrong Id'], 400);
        } else {
            $category->delete();
            return response()->json(['message' => 'Successfully deleted'], 201);
        }
    }

    public function destroy()
    {
        DB::table('categories')->delete();
        return response()->json(['message' => 'Successfully deleted'], 201);
    }
}

