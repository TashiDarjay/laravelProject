@extends('movies.layout')
@section('content')
<div class="wrapperdiv">
    <div class="formcontainer">
        <div class="row">
            <div class="col-lg-12 margin-th">
                <div class="pull-left">
                    <h2>Edit Movie BEST</h2>
                </div>
            </div>
        </div>
        @if($errors->any())
        <div class="alert alert-danger">
            <strong>Opps! there is a problen with input</strong>
            <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route( 'movies.update',$movie->id )}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-control">Title</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" id="title" class="form-control" value="{{$movie->title}}">
                    </div>
                </div>
                <!-- 2nd input row -->
                <br>
                <div class="form-group row">
                    <label for="genre" class="col-sm-2 col-form-control">Genre</label>
                    <div class="col-sm-10">
                        <select name="genre" id="genre">
                            <option value="">Select Genre</option>
                            @if( $genres)
                                @foreach($genres as $genre)
                                    @if($genre==$movie->genre)
                                    <option value="{{ $genre }}" selected >{{ $genre }}</option>
                                    @else
                                    <option value="{{ $genre }}">{{ $genre }}</option>
                                    @endif 
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <br>

                <div class="form-group row">
                    <label for="release_year" class="col-sm-2 col-form-control">Release Year</label>
                    <div class="col-sm-10">
                        <input type="release_year" name="release_year" id="title" class="form-control" value="{{$movie->release_year}}">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label for="poster" class="col-sm-2 col-form-control">Poster</label>
                    <div class="col-sm-10">
                        <input type="file" name="poster" id="poster" class="form-control-file">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-2"></div>

                    <div class="col-sm-10">
                        <button type="submit" name="submit" id="submit" class="btn btn-primary">SUBMIT</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    
</div>

@endsection