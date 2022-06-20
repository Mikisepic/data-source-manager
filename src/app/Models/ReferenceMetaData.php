<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceMetaData extends Model
{
    use HasFactory;

    protected $table = "reference_metadata";

    public static function scrape($url)
    {
        // init DOMDocument
        $doc = new \DOMDocument();

        // Get HTML page
        @$doc->loadHTML(file_get_contents($url));

        // Extract page Title
        $res['title'] = $doc->getElementsByTagName('title')->item(0)->nodeValue;

        // Extract page description, image from meta data
        foreach ($doc->getElementsByTagName('meta') as $m){
            // find all meta tags, and look for name = description || image
            // it also looks for prefix og:
            // then gets data from content attribute
            $tag = $m->getAttribute('name') ?: $m->getAttribute('property');
            if(in_array($tag,['description', 'image']) || strpos($tag,'og:')===0) $res[str_replace('og:','',$tag)] = $m->getAttribute('content');
        }

        // Extract product image, price from structured product data
        foreach ($doc->getElementsByTagName('script') as $m){
            // find all scripts, and look for type = application/ld+json
            $tag = $m->getAttribute('type');
            // since the data we get is json, we need to use json_decode so we could access data in PHP
            if(in_array($tag,['application/ld+json'])) $res['product_image'] = json_decode($m->nodeValue)->image[0];
            if(in_array($tag,['application/ld+json'])) $res['product_price'] = json_decode($m->nodeValue)->offers->price;
        }

        // return extracted data
        return $res;
    }

    public function thumbnail($url) 
    {

        // remove all unnecessary data from url, and leave only variables like v=000000&type=000
        // all variables are kept in $vars
        parse_str( 
            parse_url( 
                $url, PHP_URL_QUERY 
            ), $vars
        );

        // extract v variable
        $thumbnail = 'https://img.youtube.com/vi/'.$vars[v].'/sddefault.jpg';

        return $thumbnail;

    }
}
