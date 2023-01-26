<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function publisher(){
        return $this->belongsTo(Publisher::class);
    }
    public static function isAuthorSelected($book_id, $author_id){
        $book_author = BookAuthor::where('book_id', $book_id)->where('author_id', $author_id)->first();
        if(!is_null($book_author)){
            return true;
        }
        return false;

    }
      
}
