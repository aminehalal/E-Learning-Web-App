<!DOCTYPE html>
<html lang="en" id="htmlDoc">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/classe.css')}}">
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


            <div class="font-kanit">
                @if (auth()->user()->id == $class->teacherId)
                    
                <div class="p-3 shadow-md flex flex-col justify-center items-center">
                    <div class="flex">
                        <input type="text" readonly value="{{$class->code}}">
                        <label class="px-2 text-blue-900 duration-700 hover:font-bold">Class Code</label>
                    </div>
                    <form action="/class/createVideoChat" method="post" class="p-2 m-3 ">
                        @csrf
                        <input type="hidden" name="userId" value="{{auth()->user()->id}}">
                        <input type="hidden" name="classId" value="{{$class->id}}">
                        <input type="hidden" name="type" value="live">
                        <input type="text" name="post" placeholder="Write the name of the room">
                        <button type="submit" class="px-2 text-blue-900 duration-700 hover:font-bold">Create a video chat</button>
                    </form>
                </div>
                @endif
                <div class="grid grid-cols-5">
                    <div class ="col-span-1 p-6">
                        <div class="flex flex-col justify-center items-center">
                            <h2 class="font-bold text-blue-900">Teacher</h2>
                            @php
                                $teacher = \App\Models\User::find($class->teacherId);
                            @endphp
                            <a href="/profile/{{$teacher->username}}">{{$teacher->username}}</a>
                        </div>
                        <div class="flex flex-col justify-center items-center">
                            <h2 class ="font-bold text-blue-900">students</h2>
                            @php
                                $studentsIds = $class->students ;
                                $studentsIds = explode(',' , $studentsIds);
                            @endphp
                            <div class="flex flex-col">
                                @foreach ($studentsIds as $sId)
                                    @php
                                        $user = \App\Models\User::find($sId);
                                    @endphp
                                <a href="/profile/{{$user->username}}">{{$user->username}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-span-4 p-6 m-4 flex flex-col justify-center items-center">
                        <div>
                            <form action="/class/post" method="POST" class="flex flex-col">
                                @csrf
                                <input type="hidden" name="userId" value="{{auth()->user()->id}}">
                                <input type="hidden" name="classId" value="{{$class->id}}">
                                <input type="hidden" name="type" value="post">
                                <input type="text" name="post" class="border-2 border-blue-900 p-2">
                                <button type="submit" class="text-blue-900 m-2 text-lg hover:font-bold duration-700">Post</button>
                            </form>

                        </div>

                        <h1 class="text-blue-900 font-bold text-3xl p-2 m-1">Posts</h1>
                            @foreach ($posts as $post)
                                
                            <div class="border rounded-md flex flex-col justify-center items-center w-full border-blue-900 p-2 m-2">
                                <span class="text-sm text-slate-500">{{$post->created_at}}</span>
                                <div class= "flex justify-start items-start">
                                    @php
                                        $user = \App\Models\User::find($post->userId);
                                    @endphp
                                    <a href="/profile/{{$user->username}}" class="p-1 font-bold text-blue-900">
                                        {{$user->username}} : 
                                    </a>
                                    @if ($post->type == 'post')
                                    <span class="p-1">{{$post->post}}</span>
                                    @else
                                    <a href="{{$post->post}}" target=”_blank” class="p-1 text-red-700 text-lg animate-bounce">Live Now!</a>
                                    @endif
                                </div>
                            </div>
                            @endforeach


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