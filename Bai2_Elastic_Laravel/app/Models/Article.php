<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Elasticsearch\ClientBuilder;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'body', 'tags'];

    public static function boot()
    {
        parent::boot();

        static::created(function ($article) {
            $client = ClientBuilder::create()->build();
            $params = [
                'index' => 'articles',
                'id' => $article->id,
                'body' => $article->toArray(),
            ];
            $client->index($params);
        });
    }
    public static function searchByQuery($query)
    {
        $client = ClientBuilder::create()->setHosts(['127.0.0.1:9222'])->build();

        $params = [
            'index' => 'articles',
            'body' => [
                'query' => [
                    'match' => [ // Or use a different query type as needed
                        'body' => $query
                    ]
                ]
            ]
        ];

        $response = $client->search($params);
        return $response['hits']['hits'];
    }

}
