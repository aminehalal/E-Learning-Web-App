<!DOCTYPE html>
<html lang="en" id="htmlDoc">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset ('css/courses.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/logo_ico.png">

    <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@500&family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        #menu-list:checked + #nav-list {
            display: block;
        }
    </style>
    <title>MIT Learning</title>
    @livewireStyles
</head>
    <body class="bg-blue-100 dark:bg-slate-800 dark:text-white">
        <header class="nav-bar-courses dark:bg-blue-900 bg-white dark:text-white sticky top-0 drop-shadow-xl p-5 sm:p-0">
            <nav class="font-kanit ">
                <div class="flex justify-between items-center mx-1">
                    <a href="/" class="flex justify-center items-center">
                        <img src="img/logo_e_learning.png" class="h-10 ml-3">
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

        @livewire('course-search')

        {{-- <div class="font-kanit p-5">
            <div class="px-16 sm:px-44 md:px-64">                
                <form method="GET">   
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="search" name="q" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for a course" required>
                        <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-900  hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="p-8 font-kanit">
            <div>
                <div class="flex justify-center items-center">
                    <h1 class="text-3xl font-bold p-2 mt-5">All Courses</h1>
                </div>
                @if ($numOfCourses >= 1)
                <div class="grid md:grid-cols-4 grid-cols-2 p-7">
                    @foreach ($courses as $course)
                    <div class="flex flex-col p-2 border-blue-900 m-2 hover:shadow-2xl duration-700 justify-center items-center border-2 rounded-md course-view">
                        <img src="{{asset('img/imgCourses/'.$course->image)}}" class="rounded-md">
                        @php
                            $userId = $course->teacherId ;
                            $user = \App\Models\User::find($userId);
                        @endphp
                        <a href="/profile/{{$user->username}}" class="font-bold text-blue-900">{{$user->username}}</a>
                        <h3>{{$course->name}}</h3>
                        <div class="flex flex-col justify-center items-center">
                            @php
                                $word = $course->video;
                                $words = explode(',' , $word);
                                $num = count($words);
                                $alltags = $course->tags ;
                                $tags = explode(',' , $alltags);
                            @endphp
                            <span>{{$num}} Lessions</span>
                            <a href="#" class="text-blue-900 font-bold">{{$course->category}}</a>
                            <div class="flex justify-center items-center">
                                @foreach ($tags as $tag)
                                <a href="/courses?tag={{$tag}}" class="p-1 mx-1 bg-blue-800 text-white rounded-lg">{{$tag}}</a>                                    
                                @endforeach
                            </div>
                            <span class="flex justify-center items-center">
                                <img src="img/star.png" class="h-4">
                                <span>{{$course->rating}}</span>
                            </span>
                        </div>
                        <a href="/course/{{$course->id}}" class="p-2 bg-blue-900 rounded-xl text-white">Enroll Now</a>
                    </div>    
                    @endforeach
                </div>
                @else
                <div class="flex justify-center items-center">
                    <h1 class="no-course">There are no courses found.</h1>
                </div>
                @endif

            </div>
        </div> --}}

        <div>
            <footer class="flex justify-between items-center px-6 font-kanit">
                <div class="flex justify-center items-center">
                    <a href="/" class="flex justify-center items-center m-5">
                        <img src="img/logo_e_learning.png" class="h-8">
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
    @livewireScripts
</body>
</html>