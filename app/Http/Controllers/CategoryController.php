<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function viewAllCategory(){

        return view('backend.modules.category.view_all_categories');
    }
}
