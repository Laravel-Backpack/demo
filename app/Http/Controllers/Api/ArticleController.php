<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Backpack\NewsCRUD\app\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // used by the select2_from_ajax and select2_fromAjax FIELDS
    // inside MonsterCrudController, FluentMonsterCrudController and DummyCrudController
    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $keys = $request->input('keys');
        
        if ($keys) {
            // since we're also using this API endpoint inside a repeatable field
            // we take that into account, and if "keys" was passed we just
            // find and return those entries  
            if (is_string($keys)) {
                $keys = explode(',', $keys);
            }

            if (is_array($keys) && count($keys) > 1) {
                return Article::findMany($keys);
            } else {
                return Article::find($keys);
            }
        }
        elseif ($search_term) {
            $results = Article::where('title', 'LIKE', '%'.$search_term.'%')->paginate(10);
        } else {
            $results = Article::paginate(10);
        }

        return $results;
    }

    // used by the select2_from_ajax FILTER
    // inside MonsterCrudController and FluentMonsterCrudController
    public function search(Request $request)
    {
        $term = $request->input('term');
        $options = Article::where('title', 'like', '%'.$term.'%')->get()->pluck('title', 'id');

        return $options;
    }

    // No idea why or if this was ever used. If nobody cries we can remove it.
    // public function show($id)
    // {
    //     return Article::find($id);
    // }
}
