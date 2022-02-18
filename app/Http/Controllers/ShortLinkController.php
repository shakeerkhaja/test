<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shortLinks = ShortLink::latest()->get();

        return view('shortenLink', compact('shortLinks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'link' => ['required', 'url']
        ]);

        $exist = ShortLink::where('link', '=', $request->link)->first();

        if($exist) {
            return redirect('generate-shorten-link')
                ->with('errors', 'Shorten Link Exists! '.$exist->code);
        }

        $input['link'] = $request->link;
        $input['code'] = Str::random(6);

        try {
            $link = ShortLink::create($input);
        } catch (\Exception $exception) {
            return redirect('generate-shorten-link')
                ->with('errors', 'Something went wrong! '.$exception->getMessage());
        }

        return redirect('generate-shorten-link')
            ->with('success', 'Shorten Link Generated Successfully! '.$link->code);

    }


    /**
     * Get a link using code.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function shortenLink($code)
    {
        $find = ShortLink::where('code', $code)->first();

        return redirect($find->link);
    }

    /**
     * Display full url page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getUrl()
    {
        return view('fullUrl');
    }

    /**
     * Get Full URL using shorten code.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getFullUrl(Request $request)
    {
        $url = ShortLink::where('code', '=', $request->code)->first();

        if(!$url) {
            return redirect('generate-full-url-link')
                ->with('errors', 'Shorten Link Doesn\'t Exists!');
        }

        $url->visits = $url->visits + 1;
        $url->update();

        return view('fullUrl', compact('url'));

    }
}
