<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class NewsArticle extends Eloquent
{

    /**
     * cast the field names to a carbon instance
     * @var Array
     */
    protected $dates = ['published_at','display_until'];
    /**
     * cast the set fields to their sets
     * @var Array
     */
    protected $casts = [
        'status' => 'boolean',
        'archived' => 'boolean',
    ];
    /**
     * enable the writable fields for mass asignment
     * @var Array
     */
     protected $fillable = [
         'title',
         'slug',
         'image',
         'excerpt',
         'copy',
         'archived',
         'status',
         'published_at',
         'dsiplay_until'
     ];

     public function active(){
         return $this->whereStatus(true)
                    ->whereArchived(false)
                    ->whereDate('published_at','<=',\Carbon\Carbon::now())
                    ->whereDate('display_until','>=',\Carbon\Carbon::now())
                    ->orderBy('published_at', 'asc')
                    ->get();
     }

     public function archived(){
         return $this->whereArchived(true)
                    ->whereStatus(true)
                    ->whereDate('published_at','<=',\Carbon\Carbon::now())
                    ->whereDate('display_until','>=',\Carbon\Carbon::now())
                    ->orderBy('published_at', 'asc')
                    ->get();

     }

     public function scheduled(){
         return $this->whereStatus(true)
                    ->whereArchived(false)
                    ->whereDate('published_at','>',\Carbon\Carbon::now())
                    ->whereDate('display_until','>',\Carbon\Carbon::now())
                    ->orderBy('published_at', 'desc')
                    ->get();

     }

}
