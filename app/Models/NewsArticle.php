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
     /**
      * get all active artilces
      *
      * @return Collection/Object
      */
     public function active(){
         return $this->whereStatus(true)
                    ->whereArchived(false)
                    ->whereDate('published_at','<=',\Carbon\Carbon::now())
                    ->whereDate('display_until','>=',\Carbon\Carbon::now())
                    ->orderBy('published_at', 'asc')
                    ->get();
     }
     /**
      * get all archived artilces
      *
      * @return Collection/Object
      */
     public function archived(){
         return $this->whereArchived(true)
                    ->whereStatus(true)
                    ->whereDate('published_at','<=',\Carbon\Carbon::now())
                    ->whereDate('display_until','>=',\Carbon\Carbon::now())
                    ->orderBy('published_at', 'asc')
                    ->get();

     }
     /**
      * get all scheduled artilces
      *
      * @return Collection/Object
      */
     public function scheduled(){
         return $this->whereStatus(true)
                    ->whereArchived(false)
                    ->whereDate('published_at','>',\Carbon\Carbon::now())
                    ->orderBy('published_at', 'desc')
                    ->get();

     }
     /**
      *
      * @param  String $query
      * @return Collection/Object       
      */
     public function article($query){
         return $this->whereSlug($query)->first();
     }

}
