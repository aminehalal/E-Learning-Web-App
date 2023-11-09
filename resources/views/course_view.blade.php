<!DOCTYPE html>
<html lang="en" id="htmlDoc">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/course_view.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="{{asset('img/logo_ico.png')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@500&family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        #menu-list:checked + #nav-list {
            display: block;
        }
    </style>
    <title>MIT Learning</title>
</head>
    <body class="bg-blue-100 dark:bg-slate-800 dark:text-white">
        <header class="dark:bg-blue-900 bg-white dark:text-white sticky top-0 drop-shadow-xl p-5 sm:p-0">
            <nav class="font-kanit ">
                <div class="flex justify-between items-center mx-1">
                    <a href="/" class="flex justify-center items-center">
                        <img src="{{asset('img/logo_e_learning.png')}}" class="h-10 ml-3">
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
        <div class="flex flex-col justify-center items-center">
            <h2 class="font bold p-2 border-2 border-blue-900 dark:text-slate-400 dark:border-slate-400 rounded-lg text-blue-900">{{$course->name}}</h2>
            @php
                $userId = $course->teacherId ;
                $user = \App\Models\User::find($userId);
            @endphp
            <a href="/profile/{{$user->username}}" class="font-bold text-blue-900 p-2 m-2 dark:text-slate-400">{{$user->username}}</a>
        
   
        </div>
        <div class="flex justify-center items-center">
            <img src="{{asset('img/imgCourses/'.$course->image)}}" class="m-5 md:w-96 sm:w-64 w-48 border-2 border-blue-900 rounded-md">
        </div>
        <div class="bg-slate-100 dark:bg-slate-800 p-4 px-7 shadow-lg m-5 flex flex-col w-48 sm:w-64 md:w-96 justify-center items-center border-2 border-blue-900 rounded-xl ">
            <div class="flex flex-col justify-center items-center py-5">
            <h5 class="font-bold text-blue-900 dark:text-slate-400">Description</h5>
            <p class="p-2">{{$course->description}}</p>
            </div>
                @php
                    $word = $course->video;
                    $words = explode(',' , $word);
                    $num = count($words);
                    $alltags = $course->tags ;
                    $tags = explode(',' , $alltags);
                @endphp
            <div class="flex flex-col justify-center items-center py-5">
                <h5 class="font-bold text-blue-900 dark:text-slate-400">Courses</h5>
                <span class="p-2">{{$num}} Course</span>
            </div>

            <div class="py-5 justify-center items-center flex flex-col">
                <h5 class="font-bold text-blue-900 dark:text-slate-400">Category</h5>
                <a href="#" class="hover:font-bold hover:text-blue-900 duration-700">{{$course->category}}</a>
            </div>
            
            <div class="py-5 justify-center items-center flex flex-col">
                <h5 class="font-bold text-blue-900 dark:text-slate-400">Tags</h5>
                <div class="flex justify-center items-center">
                    @foreach ($tags as $tag)
                    <a href="#" class="px-2 border-2 border-blue-900 rounded-lg mx-2 hover:font-bold hover:text-blue-900 duration-700 ">{{$tag}}</a>                        
                    @endforeach
                </div>
            </div>

            <div class="py-5 justify-center items-center flex flex-col">
                <h5 class="font-bold  text-blue-900 dark:text-slate-400">Rating</h5>
                <div class="flex justify-center items-center">
                    <img src="{{asset('img/star.png')}}" class="h-4 px-1">
                    <span class="hover:font-bold hover:text-blue-900 duration-700">{{$course->rating}}</span>
                </div>
            </div>
        </div>
        <a href="#" class="p-2 m-2 border-2 border-blue-900 rounded-lg text-blue-900 hover:bg-slate-100 duration-700 hover:shadow-xl hover:font-bold ">Go to course</a>
        <div class="bg-slate-100 dark:bg-slate-800 p-4 px-7 shadow-lg m-5 flex flex-col w-48 sm:w-64 md:w-96 justify-center items-center border-2 border-blue-900 rounded-xl ">
            <h5 class="font-bold text-blue-900 dark:text-slate-400">Comments</h5>
            <div class="flex flex-col justify-center items-center">
                <span class="py-2"><span class="text-blue-900 font-bold">aminehalal</span> : <span></span>The comment is here bla bla bla (<span class="text-blue-900">22:55:44</span>)</span>
                <span class="py-2"><span class="text-blue-900 font-bold">aminehalal</span> : <span></span>The comment is here bla bla bla (<span class="text-blue-900">22:55:44</span>)</span>
            </div>
        </div>

       </div>
        <div>
            <footer class="flex justify-between items-center px-6 font-kanit">
                <div class="flex justify-center items-center">
                    <a href="/" class="flex justify-center items-center m-5">
                        <img src="{{asset('img/logo_e_learning.png')}}" class="h-8">
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
        </script>
    
</body>
</html>