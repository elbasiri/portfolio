@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('users messages') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    
                    @foreach ($comments as $comment)
                    <br>
                        <div style="display: flex; justify-content: space-between"> 
                            {{ $comment->user }}: {{ $comment->text }}
                        @if (Auth::check() && $comment->user == Auth::user()->name)  
                        
                            <a href="/delete/{{ $comment->id }}" style="background-color: red; padding:0.5rem; border-radius: 5px; color: white; text-decoration: none;">delete</a>
                        
                         @endif
                         <div>
                            <form action="/comments/{{ $comment->id }}/like" method="POST">
                                @csrf
                                <input type="hidden" name="liked" value='1'>
                                <button type="submit">Like</button>
                            </form>
                            </div> 
                         <div>
                             <button class="btn btn-sm btn-success like-btn" data-comment-id="{{ $comment->id }}" data-like="true">{{ $comment->likes()->where('liked', true)->count() }}</button>
                        
                        </div>
                    </div>
                         <br>
                         @endforeach
                        </div>
                    </div>
        </div>
        <div class="col-md-4">
            <div>
                <h3>Add Comment</h3>
                <form method="POST" action="{{ route('comment.store') }}">
                    @csrf
                    <div>
                        <label for="comment">Comment:</label>
                        <textarea name="comment" id="comment" rows="4" cols="30"></textarea>
                    </div>
                    <button type="submit">Add Comment</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
