@extends('movies.layout')
@section('content')

@if($message=Session::get('status'))
<div class="alert alert-success text-center">{{$message}}</div>
@endif
<h1>Movies</h1>
<table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Title</th>
      <th scope="col">Genre</th>
      <th scope="col">release_year</th>
      <th scope="col"></th>
    </tr>
  </thead>
  @if($movies)
  <tbody>
    @foreach($movies as $movie)
    <tr>
    <td class="align-middle"><img src="{{ asset('uploads/'.$movie->poster) }}" class="img-thumnail"></td>
      <td class="align-middle">{{ $movie->title}}</td>
      <td class="align-middle">{{ $movie->genre}}</td>
      <td class="align-middle">{{ $movie->release_year}}</td>
      <td class="align-middle">
        <form action="{{ route('movies.destroy',$movie->id )}}" method="post">
        <a href="{{ route('movies.show',$movie->id )}}" class="btn btn-info">Show</a>
        <a href="{{ route('movies.edit',$movie->id )}}" class="btn btn-primary">Edit</a>
        @csrf
        @method('DELETE')
        <button type="submit"class="btn btn-danger"onClick="return confirm('Are you sure want to delete ')">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
  @endif
</table>
<div class="d-flex">
    <div class="mx-auto">
        <!-- pagination -->
        {!!$movies->links()!!} 
    </div>
  </div>

@endsection