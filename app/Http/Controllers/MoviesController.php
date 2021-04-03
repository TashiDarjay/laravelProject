<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use Session;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies=Movie::latest()->paginate(4);
        return view('movies.index',compact('movies'))->with('i',(request()->input('page',1) -1) *4);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = ['Action','Comedy','Biopic','Horror','Drama'];
        return view('movies.create', compact( 'genres' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $request->validate(['title'=>'required',
                            'genre'=>'required',
                            'poster'=>'required|image|mimes:jpeg,png,gif|max:5048',

        ]);
        $imageName='';
        if($request->poster){
            $imageName = time().'.'. $request->poster->extension();
            $request->poster->move(public_path('uploads'), $imageName);
        }
        //create object
        $data=new Movie;
        $data->title = $request->title;
        $data->genre = $request->genre;
        $data->release_year = $request->release_year;
        $data->poster = $imageName;
        $request->session()->flash('status', 'Movie has been added successfully.');
        $data->save();
        return redirect()->route('movies.index');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return view('movies.show',compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        $genres = ['Action','Comedy','Biopic','Horror','Drama'];
        return view('movies.edit', compact('movie','genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title'=>'required',
            'genre'=>'required',

        ]);
        $imageName='';
        if($request->poster){
            $imageName = time().'.'. $request->poster->extension();
            $request->poster->move(public_path('uploads'), $imageName);
            $movie->poster=$imageName;
        }
        $movie->title=$request->title;
        $movie->genre=$request->title;
        $movie->release_year=$request->release_year;
        $movie->update();
        return redirect()->route('movies.index')->with('status','movies has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie=Movie::findOrFail($id);
        $movie->delete();
        return redirect()->route('movies.index')->with('status','movie has been deleted successfully');

    }
}
