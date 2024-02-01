<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'string',
            'active' => 'bool',
            'price' => 'numeric',
            'reviewable_type' => ['string', ],
        ]);
    }
}