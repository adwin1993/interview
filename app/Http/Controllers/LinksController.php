<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlRequest;
use Illuminate\Http\Request;
use App\Models\Links;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class LinksController extends Controller
{
    /**
     *  listing function and it will also load ajax datatable response
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Links::where('token', csrf_token())->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('short_link', function ($row) {
                    // added button to redirect the url wih selected data id
                    $btn = '<a class="edit btn btn-success btn-sm" href="' . route('shortenLink', $row->id) . '" target="_blank">' . $row->short_link . '</a>';

                    return $btn;
                })
                ->addColumn('link', function ($row) {
                    // restrcited the length of the string
                    $btn = Str::limit($row->link, 60);

                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    // used carbon for date formatting
                    $btn = '<a  class="btn btn-danger btn-sm" id="copy_' . $row->id . '" onclick="copyToClipboard(' . $row->id . ')" newVal="' . $row->short_link . '">Copy</a>';

                    return $btn;
                })
                ->rawColumns(['short_link', 'link', 'created_at', 'action'])
                ->make(true);
        }
        return view('index');
    }


    /**
     *
     *   save url and reduce length
     *   created a request file for validate url
     * @return \Illuminate\Http\Response
     */

    public function create(UrlRequest $request)
    {
        $host = $request->getSchemeAndHttpHost(); // returns current host
        $input['short_link'] = $host . '/shortenLink' . '/' . Str::random(15); // appending random string with parsed url
        $input['link']       = $request->url;
        $input['token']      = csrf_token();
        Links::create($input);

        return response()->json(['message' => 'Shorten Link Generated Successfully!']);
    }


    /**
     * redirecting to original url.
     *
     * @return \Illuminate\Http\Response
     */
    public function shortenLink($id)
    {
        $find = Links::where('id', $id)->first(); // fetching the actual url with selected id
        if (!$find) {
            $host = request()->getSchemeAndHttpHost(); // returns current host
            $host = $host . '/shortenLink' . '/' . $id;
            $find = Links::where('short_link', $host)->first(); // fetching the actual url with selected short url
        }

        return redirect($find->link);
    }
}
