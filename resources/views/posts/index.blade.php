@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-{{theme('bg')}}-50 p-6 rounded-lg">
            @auth
                <form action="{{ route('posts') }}" method="post" class="mb-4">
                    @csrf
                    <div class="mb-4">
                        <label for="body" class="sr-only">Body</label>
                        <textarea name="body" id="body" cols="30" rows="4"
                            class="bg-{{theme('bg')}}-100 border-2 w-full p-4 rounded-lg @error('body') border-{{theme('error')}}-500 @enderror"
                            placeholder="Post Something!"></textarea>
                        @error('body')
                            <div class="text-{{theme('error')}}-500 mt-2 text-sm">{{$message}} </div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="bg-{{theme('bg')}}-500 text-white px-4 py-2 rounded font-meduim">Post</button>
                    </div>
                </form>
            @endauth
            @if($posts->count())
            <div class="m bg-{{theme('bg')}}-50"">
                @foreach($posts as $post)
                    <div class="m-1 p-1  bg-{{theme('bg')}}-100 rounded-lg ">
                        <div class="mb4">
                            <a href="" class="font-bold mr-8">{{$post->user->name}}</a>
                            <span class="text-{{theme('text')}}-600 text-sm">{{ $post->created_at->diffForHumans() }} </span>
                        </div>
                        <div>{{$post->body}}</div>
                        <div class="text-xs">
                            @auth
                                @if($post->ownedBy(auth()->user()))
                                    <div>
                                        <form action="{{route('posts.destroy',$post)}}" method="post"
                                        onsubmit ='return confirm("Are you sure you want to delete this post?")' class="mr-4">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="text-{{theme('error')}}-500">Delete this post</button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                            <div class="flex items-center">
                                @auth
                                    @if(!$post->likedBy(auth()->user()))
                                        <form action="{{route('posts.likes',$post)}}" method="post" class="mr-4">
                                            @csrf
                                            <button type="submit" class="text-{{theme('text')}}-500">Like</button>
                                        </form>
                                    @else
                                        <form action="{{route('posts.likes',$post)}}" method="post" class="mr-4">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="text-{{theme('text')}}-500">Unlike</button>
                                        </form>
                                    @endif
                                @endauth
                                <span class="">{{$post->likes->count()}} {{Str::plural('like', $post->likes->count())}} </span>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{$posts->links()}}
            </div>
            @else
                There are no posts
            @endif
        </div>
    </div>
@endsection
