<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LinkController extends Controller
{
    /**
     * Display an overview of all links.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $links = Link::privateOnly(false)
            ->orderBy(
                $request->input('orderBy', 'created_at'),
                $request->input('orderDir', 'desc')
            )
            ->paginate(getPaginationLimit());

        return view('guest.links.index', [
            'links' => $links,
            'route' => $request->getBaseUrl(),
            'orderBy' => $request->input('orderBy', 'created_at'),
            'orderDir' => $request->input('orderDir', 'desc'),
        ]);
    }
}
