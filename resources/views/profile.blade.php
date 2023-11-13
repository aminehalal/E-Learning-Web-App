<!DOCTYPE html>
<html lang="en" id="htmlDoc">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="{{asset('img/logo_ico.png')}}">
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
                            <li class="p-1 m-1 bg-blue-900 w-20 flex justify-center border-2 rounded-lg text-white border-black hover:text-black duration-700"><a href="/profile/{{auth()->user()->username}}">{{ auth()->user()->username }}</a></li>
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

        <div class="font-kanit grid md:grid-cols-2 grid-cols-1">
            <div>
                <img src="{{ asset('img/student.jpg') }}" class="w-full h-full">
            </div>
            <div class="flex flex-col justify-center p-9 items-center">
                <div class="p-4">
                    <label for="name">Full Name : </label>
                    <span class="text-blue-900 font-bold dark:text-slate-400">{{$user->fullname}}</span>
                </div>
                <div class="p-4">
                    <label for="username">Username : </label>
                    <span class="text-blue-900 font-bold dark:text-slate-400">{{$user->username}}</span>
                </div>
                <div class="p-4">
                    <label for="email">Email : </label>
                    <span class="text-blue-900 font-bold dark:text-slate-400">{{$user->email}}</span>
                </div>
                <div class="p-2">
                    <label for="birthday">Birthday : </label>
                    <span class="text-blue-900 font-bold dark:text-slate-400">{{$user->birthday}}</span>
                </div>
                
                <div class="p-2">
                    <label for="genre">Genere : </label>
                    <span class="text-blue-900 font-bold dark:text-slate-400 capitalize">{{$user->genre}}</span>
                </div>
                <div class="p-4">
                    <label for="adress">Adress : </label>
                    <span class="text-blue-900 font-bold dark:text-slate-400">{{$user->adress}}</span>
                </div>

                
                @auth
                @if (auth()->check() && auth()->user()->id == $user->id)
                @php
                    $teacherDemande = \App\Models\TeacherDemande::where('teacherId' , $user->id)->latest()->first();
                @endphp
                @if ($teacherDemande)
                    @if ($teacherDemande->etat == 'Not Yet')
                            <div class="p-4">
                                <h5 class="p-2 m-1 text-blue-900 border-2 border-blue-900 rounded-lg dark:text-white dark:border-white">The application to become a teacher is currently being processed.</a>
                            </div>
                    @elseif ($teacherDemande->etat == 'Done')
                    
                        @if(auth()->check() && auth()->user()->role == '1' && auth()->user()->id == $user->id)
                            <div class="p-4">
                                <a href="/teacher" class="p-2 m-1 text-blue-900 border-2 border-blue-900 rounded-lg dark:text-white dark:border-white">Teacher's Space</a>
                            </div>
                        @else
                            <div class="p-4">
                                <a href="/profile/{{$user->username}}/becomeTeacher" class="p-2 m-1 text-blue-900 border-2 border-blue-900 rounded-lg dark:text-white dark:border-white">Become a teacher</a>
                            </div>                
                        @endif
                    @endif
                @else
                            <div class="p-4">
                                <a href="/profile/{{$user->username}}/becomeTeacher" class="p-2 m-1 text-blue-900 border-2 border-blue-900 rounded-lg dark:text-white dark:border-white">Become a teacher</a>
                            </div>
                @endif
                @endif
                @if (auth()->user()->role == '2' && auth()->user()->id == $user->id)
                <div class="p-4">
                    <a href="/admin" class="p-2 m-1 text-blue-900 border-2 border-blue-900 rounded-lg dark:text-white dark:border-white">Admin's Space</a>
                </div>
                @endif
                @endauth


                @auth
                @if(auth()->user()->id == $user->id)
                <div class="p-2">
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="p-2 m-1 text-white border-2 border-blue-900 bg-blue-900 rounded-lg dark:text-white dark:border-white">Log Out</button>
                    </form>
                </div>  
                @endif  
                @endauth
                
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
        </script>
    
</body>
</html>