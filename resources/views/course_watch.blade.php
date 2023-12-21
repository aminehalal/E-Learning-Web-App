<!DOCTYPE html>
<html lang="en" id="htmlDoc">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/course_watch.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="{{ asset('img/logo_ico.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@500&family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        #menu-list:checked + #nav-list {
            display: block;
        }
    </style>
    <title>MIT Learning</title>
</head>
    <body class="bg-blue-100 dark:bg-slate-800 dark:text-white">
        <header class="nav-bar dark:bg-blue-900 bg-white dark:text-white sticky top-0 drop-shadow-xl p-5 sm:p-0">
            <nav class="font-kanit ">
                <div class="flex justify-between items-center mx-1">
                    <a href="/" class="flex justify-center items-center">
                        <img src="{{ asset('img/logo_e_learning.png') }}" class="h-10 ml-3">
                    </a>
                    <label for="menu-list" class="cursor-pointer sm:hidden mr-6">
                        <svg viewBox="0 0 100 80" width="35" height="40">
                            <rect width="100" height="20" rx="10"></rect>
                            <rect y="30" width="100" height="20" rx="10"></rect>
                            <rect y="60" width="100" height="20" rx="10"></rect>
                        </svg>
                    </label>
                    <input type="checkbox" class="hidden" id="menu-list">
                    <div id="nav-list" class=" m-5 absolute  top-16 right-0 hidden sm:static sm:flex">
                        <ul class="flex flex-col  sm:flex-row justify-center items-center">
                            <li class="p-1 m-1 border-2 w-20 flex justify-center border-black rounded-md sm:border-0 hover:border-blue-900 duration-700"><a class="hover:text-blue-900 hover:font-bold duration-600 hover:dark:text-black" href="/courses">Courses</a></li>
                            <li class="p-1 m-1 border-2 w-20 flex justify-center border-black rounded-md sm:border-0 hover:border-blue-900 duration-700"><a class="hover:text-blue-900 hover:font-bold duration-600 hover:dark:text-black" href="/about">About</a></li>
                            <li class="p-1 m-1 border-2 w-20 flex justify-center border-black rounded-md sm:border-0 hover:border-blue-900 duration-700"><a class="hover:text-blue-900 hover:font-bold duration-600 hover:dark:text-black" href="/contact">Contact</a></li>
                            @auth
                            <li class="p-1 m-1 bg-blue-900 w-20 flex justify-center border-2 rounded-lg text-white border-black hover:text-black duration-700"><a href="/profile/{{auth()->user()->username }}">{{ auth()->user()->username }}</a></li>
                            @else    
                            <li class="p-1 m-1 bg-blue-900 w-20 flex justify-center border-2 rounded-lg text-white border-black hover:text-black duration-700"><a href="/login">Login</a></li>
                            @endauth
                        </ul>
                        <div id="darkModeSwitcher" class="p-1 m-1 border-2 cursor-pointer flex border-black w-20 rounded-full">
                            <svg class="h-8 border-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"> <g> <path fill="none" d="M0 0h24v24H0z"/> <path fill-rule="nonzero" d="M10 7a7 7 0 0 0 12 4.9v.1c0 5.523-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2h.1A6.979 6.979 0 0 0 10 7zm-6 5a8 8 0 0 0 15.062 3.762A9 9 0 0 1 8.238 4.938 7.999 7.999 0 0 0 4 12z"/> </g> </svg>
                            <span class="text-xs font-kanit font-bold">Dark Mode</span>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

       <div class="flex flex-col justify-center items-center p-6 font-kanit">
            <div class="flex justify-center items-center">
                <a href="/course/{{$course->id}}" class="font bold p-2 border-2 border-blue-900 dark:text-slate-400 dark:border-slate-400 rounded-lg text-blue-900">{{$course->name}}</a>            
            </div>
            <div class="flex flex-col justify-center items-center">
                @php
                    $userId = auth()->user()->id ;
                    $courseId = $course->id ;
                    $courseEtat = \App\Models\CourseEtat::where('studentId' , $userId)->where('courseId',$courseId)->first();
                @endphp
                <h2 class="font bold p-4 dark:text-slate-400  rounded-lg text-blue-900">{{$courseEtat->etat}}</h2>            
            </div>
            @php
                $videos = explode(',' , $course->video);
            @endphp
            @if(count($videos) > 1)
            <div class="flex flex-col flex-row-vd justify-center items-center">
                <div class="flex">
                    <video id="video-active" src="{{ asset('video/videoCourses/'.$videos[0]) }}" class="video-plays" controls></video>
                </div>
                <div>
                    <h1 class="p-3 text-2xl font-bold flex justify-center items-center">All videos</h1>
                    <div class="flex flex-row flex-col-vd justify-center h-videos items-center">
                        <h1 class="p-3 text-xl hidden md:block">All</h1>
                        @foreach ($videos as $key => $video)
                            <div class="flex justify-center items-center w-28">
                                <video
                                    id="video-att-{{ $key }}"
                                    src="{{ asset('video/videoCourses/'.$video) }}"
                                    class="active video-att  border-2 border-blue-900 rounded-md"
                                    onclick="changeMainVideo('{{ asset('video/videoCourses/'.$video) }}')"
                                ></video>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @else
            <div class="flex justify-center items-center">
                <div class="flex">
                    <video id="video-active" src="{{ asset('video/videoCourses/'.$videos[0]) }}" class="video-plays" controls></video>
                </div> 
            </div>
            @endif
            <div class="p-6">
                <form action="/course/{{$course->id}}/markWatched" method="POST">
                    @csrf
                    <button class="p-3 rounded-lg duration-700 hover:bg-slate-100 hover:font-bold m-1 my-5 border-2 border-blue-900 text-blue-900 ">Mark as finished</button>
                </form>
            </div>

            <div class="p-5">
                <form action="/course/{{$course->id}}/rate" method="post" class="flex flex-col justify-center items-center">
                    <h3 class="p-2 m-2 text-2xl font-bold text-blue-900">My Rating</h3>
                    @csrf
                    <select name="rating" class="w-12">
                        <option value="5">5</option>
                        <option value="4.5">4.5</option>
                        <option value="4">4</option>
                        <option value="3.5">3.5</option>
                        <option value="3">3</option>
                        <option value="2.5">2.5</option>
                        <option value="2">2</option>
                        <option value="1.5">1.5</option>
                        <option value="1">1</option>
                    </select>
                    <button class="text-blue-900 hover:font-bold duration-500 rate-button" type="submit">Rate</button>
                </form>
            </div>

            
            <div class="p-5">
                <form action="/course/{{$course->id}}/comment" method="post" class="flex flex-col justify-center items-center">
                    <h3 class="p-2 m-2 text-blue-900 text-2xl font-bold">My Comment</h3>
                    @csrf
                    <input type="text" name="comment" class="border-2 border-blue-900 rounded-lg">
                    <button class="text-blue-900 hover:font-bold duration-500 rate-button" type="submit">Post</button>
                </form>
            </div>
        </div>





         <div>
            <footer class="flex justify-between items-center px-6 font-kanit">
                <div class="flex justify-center items-center">
                    <a href="/" class="flex justify-center items-center m-5">
                        <img src="{{ asset('img/logo_e_learning.png') }}" class="h-8">
                    </a>
                </div>
                <div>
                    <p>All Copyrights Reserved to <a href="https://github.com/aminehalal/">Amine Halal</a> &copy;2023</p>
                </div>
            </footer>
        </div>
    
        <script>
            const htmlDoc = document.getElementById('htmlDoc');
            document.getElementById('darkModeSwitcher').addEventListener('click' , function(){
                htmlDoc.classList.toggle('dark');
            })

            function changeMainVideo(videoSrc) {
                var mainVideo = document.getElementById('video-active');
                mainVideo.src = videoSrc;
                mainVideo.load(); // Load the new video source
                mainVideo.play(); // Start playing the new video
            }
        </script>
    
</body>
</html>