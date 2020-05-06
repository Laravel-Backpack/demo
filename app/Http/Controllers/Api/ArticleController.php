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

        // keys are present when select2_from_ajax fields are initialized inside a repeatable field
        if ($keys) {
            return Article::findMany($keys);
        }

        if ($search_term) {
            return Article::where('title', 'LIKE', '%'.$search_term.'%')->paginate(10);
        } else {
            return Article::paginate(10);
        }
    }

    // used by the select2_from_ajax FILTER
    // inside MonsterCrudController and FluentMonsterCrudController
    public function search(Request $request)
    {
        $term = $request->input('term');
        $options = Article::where('title', 'like', '%'.$term.'%')->get()->pluck('title', 'id');

        return $options;
    }
}
