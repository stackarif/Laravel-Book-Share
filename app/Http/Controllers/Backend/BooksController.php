<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Support\Str;
use App\Models\Book;
use App\Models\BookAuthor;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        // $parent_books = Book::where('parent_id', null)->get();
        return view('backend.pages.books.index', compact('books',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $categories = Category::all();
        $publishers = Publisher::all();
        $authors = Author::all();
        return view('backend.pages.books.create', compact('categories','publishers','authors'));

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
            'title' => 'required|max:50',
            'category_id' => 'required',
            'publisher_id' => 'required',
            'slug' => 'nullable|unique:books',
            'description' => 'nullable',
        ]);

        $books= new Book();
        $books->title = $request->title; 
        if(empty($request->slug)){
            $books->slug = Str::slug($request->title);

        }else{
            $books->slug = $request->slug;
        }
        $books->category_id = $request->category_id;
        $books->publisher_id = $request->publisher_id;
        $books->publish_year = $request->publish_year;
        $books->description = $request->description;
        $books->is_approved = 1;
        $books->save();

        //Book Author
        $book_author = new BookAuthor();
        $book_author->book_id = $request->book_id;
        $book_author->author_id = $request->author_id;
        $book_author->save();

        session()->flash('success', 'Book has been created !!');
        return redirect()->route('admin.books.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $books= Book::find($id);

        $request->validate([
            'name' => 'required|max:50',
            // 'slug' => 'nullable|unique:books,slug'.$books->id,
            'description' => 'nullable',
        ]);

        $books->name = $request->name;
        if(empty($request->slug)){
            $books->slug = Str::slug($request->name);

        }else{
            $books->slug = $request->slug;
        }
        $books->parent_id = $request->parent_id;
        $books->description = $request->description;
        $books->save();
        session()->flash('success', 'Category has been created !!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete all child books
        $child_books = Book::where('parent_id', $id)->get();
        foreach ($child_books as $child) {
        
            $child->delete();
            
        }

        $books= Book::find($id);
        $books->delete();
        session()->flash('success', 'books has been deleted !!');

        return back();
    }
}
