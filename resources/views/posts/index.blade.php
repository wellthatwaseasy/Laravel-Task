@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            @auth
                <form action="{{ route('posts') }}" method="post" class="mb-4">
                    @csrf
                    <div class="mb-4">
                        <label for="body" class="sr-only">Body</label>
                        <textarea name="body" id="body" cols="30" rows="4"
                            class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror"
                            placeholder="Post Something!"></textarea>
                        @error('body')
                            <div class="text-red-500 mt-2 text-sm">{{$message}} </div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-meduim">Post</button>
                    </div>
                </form>
            @endauth
            @if($posts->count())
                @foreach($posts as $post)
                    <div class="mb4 bg-blue-50">
                        <a href="" class="font-bold mr-8">{{$post->user->name}}</a>
                        <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }} </span>
                    </div>
                    <p class="bg-blue-50">{{$post->body}}</p>
                    @auth
                        @if($post->ownedBy(auth()->user()))
                            <div>
                                <form action="{{route('posts.destroy',$post)}}" method="post" class="mr-4">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-red-500">Delete this post</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                    <div class="flex items-center">
                        @auth
                            @if(!$post->likedBy(auth()->user()))
                                <form action="{{route('posts.likes',$post)}}" method="post" class="mr-4">
                                    @csrf
                                    <button type="submit" class="text-blue-500">Like</button>
                                </form>
                            @else
                                <form action="{{route('posts.likes',$post)}}" method="post" class="mr-4">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-blue-500">Unlike</button>
                                </form>
                            @endif

                        @endauth
                        <span class="">{{$post->likes->count()}} {{Str::plural('like', $post->likes->count())}} </span>
                    </div>
                @endforeach
                {{$posts->links()}}
            @else
                There are no posts
            @endif
        </div>
    </div>
@endsection
