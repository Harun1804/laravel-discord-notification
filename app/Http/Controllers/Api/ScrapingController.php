<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Goutte\Client;

class ScrapingController extends Controller
{
    public function index(Request $request)
    {
        $client = new Client();

        $crawler = $client->request('GET', 'https://mytimeatportia.fandom.com/wiki/Cooking_Set');

        // $headings = $crawler->filter('h1, h2, h3, h4, h5, h6')->extract(['_text']);
        // $headings = $crawler->filter('.mw-parser-output')->text();
        // $headings = $crawler->filter('.mw-parser-output')->each(function ($node) {
        //     echo $node->text()."\n";
        // });

        $headings = $crawler->filter('h2, p, tr')->extract(['_text']);

        return response()->json($headings,200);
    }
}
