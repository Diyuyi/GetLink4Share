<?php

namespace App\Http\Controllers;

use App\Models\FourShare;
use App\Models\Link_Download_4Share;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FourShareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($url_4share)
    {
        $client = new Client([
            'verify' => 'C:\wamp64\www\get_link_4share\cacert.pem',
        ]);
        $response = $client->request('POST', "https://api.4share.vn/api/v1/?cmd=get_file_info&file_id={$url_4share}", [
            'headers' => [
                'accesstoken01' => 'TK_2255501b1343141341154f0c13141110121317',
            ],
        ]);
        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);
        $data = $data['payload'];
        if (empty(DB::table('four_shares')->where('link', $data['full_link'])->first())) {
            $this->store($data);
        }
        $four_share = DB::table('four_shares')->where('link', $data['full_link'])->first();
        if (empty(DB::table('link_download_4share')->where('id', $four_share->id)->first())) {
            $link_vip = $this->create($url_4share);
            $this->store_link_vip($four_share->id, $link_vip);
        }
        if ($four_share !== null) {
            array_push($data, ['id_4share_vip' => $four_share->id]);
        }
        return $data;
    }

    public function updateAccessCount(Request $request)
    {
        $id = $request->input('id');
        $link = FourShare::find($id);
        $link->access_count = +1;
        $link->save();
    }

    public function getPopularLink(Request $request)
    {
        $index = $request->input('index', 0);
        $offset = $index * 10;
        $links = FourShare::orderBy('access_count', 'desc')->offset($offset)->limit(10)->get();
        return response()->json($links);
    }


    public function searchName($keyword)
    {
        $results = FourShare::where('name', 'like', '%' . $keyword . '%')->get();
        return $results;
    }

    public function infoFile($id)
    {
        $result = FourShare::with('Link_Vip')->where('id', $id)->first();
        return $result;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($url_4share)
    {
        $client = new Client([
            'verify' => 'C:\wamp64\www\get_link_4share\cacert.pem',
        ]);
        $response = $client->request('POST', "https://api.4share.vn/api/v1/?cmd=get_download_link&file_id={$url_4share}", [
            'headers' => [
                'accesstoken01' => 'TK_2255501b1343141341154f0c13141110121317',
            ],
        ]);
        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);
        $link_4share_download = $data['payload']['download_link'];
        Str::replace(' ', '_', $link_4share_download);
        return $link_4share_download;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($data)
    {
        $four_share = FourShare::create([
            'link' => $data['full_link'],
            'name' => $data['name'],
            'size' => $data['size'],
            'access_count' => 0,
        ]);
        $four_share->save();

        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(FourShare $fourShare)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FourShare $fourShare)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FourShare $fourShare)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FourShare $fourShare)
    {
        //
    }

    public function return_link_vip($id)
    {
        $request = Link_Download_4Share::findOrFail($id);
        return $request;
    }

    public function store_link_vip($id, $link)
    {
        $link_vip = Link_Download_4Share::create([
            'id' => $id,
            'link_download_vip' => $link,
        ]);
        $link_vip->save();
    }
}
