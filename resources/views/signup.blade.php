<!DOCTYPE html>
<html lang="en" id="htmlDoc">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/signup.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="img/logo_ico.png">
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
                            <li class="p-1 m-1 bg-blue-900 w-20 flex justify-center border-2 rounded-lg text-white border-black hover:text-black duration-700"><a href="/login">Login</a></li>
                        </ul>
                        <div id="darkModeSwitcher" class="p-1 m-1 border-2 cursor-pointer flex border-black w-20 rounded-full">
                            <svg class="h-8 border-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"> <g> <path fill="none" d="M0 0h24v24H0z"/> <path fill-rule="nonzero" d="M10 7a7 7 0 0 0 12 4.9v.1c0 5.523-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2h.1A6.979 6.979 0 0 0 10 7zm-6 5a8 8 0 0 0 15.062 3.762A9 9 0 0 1 8.238 4.938 7.999 7.999 0 0 0 4 12z"/> </g> </svg>
                            <span class="text-xs font-kanit font-bold">Dark Mode</span>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div class="grid md:grid-cols-2 grid-cols-1">
            <div class="">
                <img src="img/e-learning-featured.jpg" class="h-full">
            </div>
            <div class="flex flex-col justify-center items-center m-6 border-2 border-blue-900 rounded-lg font-bold">
            <form action="/store" method="POST" class="flex flex-col justify-center items-center">
                @csrf
                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col m-1 justify-center items-center">
                        <label for="username" class="">Username</label>
                        <input type="text" name="username" value="{{old('username')}}" class="focus:drop-shadow-2xl duration-700 focus:p-1 border-2 rounded-xl">
                    </div>
                    <div class="flex flex-col m-1 justify-center items-center">
                        <label for="fullname">Full Name</label>
                        <input type="text" name="fullname" value="{{old('fullname')}}" class="focus:drop-shadow-2xl duration-700 focus:p-1 border-2 rounded-xl">
                    </div>
                </div>
                @error('username')
                <span class="text-red-700 text-xs">{{$message}}</span>
                @enderror
                @error('fullname')
                <span class="text-red-700 text-xs">{{$message}}</span>
                @enderror
                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col m-1 justify-center items-center">
                        <label for="genre">Genre</label>
                        <select name="genre" class="focus:drop-shadow-2xl duration-700 focus:p-1 border-2 rounded-xl">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="flex flex-col m-1 justify-center items-center">
                        <label for="birthday">Birthday</label>
                        <input type="date" name="birthday" value="{{old('birthday')}}" class="focus:drop-shadow-2xl duration-700 focus:p-1 border-2 rounded-xl">
                    </div>
                </div>
                @error('genre')
                <span class="text-red-700 text-xs">{{$message}}</span>
                @enderror
                @error('birthday')
                <span class="text-red-700 text-xs">{{$message}}</span>
                @enderror
                <div class="flex flex-col justify-center items-center">
                    <label for="adress">Adress</label>
                    <input type="text" name="adress" value="{{old('adress')}}" class="focus:drop-shadow-2xl duration-700 focus:p-1 border-2 rounded-xl">
                </div>
                @error('adress')
                <span class="text-red-700 text-xs">{{$message}}</span>
                @enderror
                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col m-1 justify-center items-center"> 
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{old('email')}}" class="focus:drop-shadow-2xl duration-700 focus:p-1 border-2 rounded-xl">
                    </div>
                    <div class="flex flex-col m-1 justify-center items-center">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="focus:drop-shadow-2xl duration-700 focus:p-1 border-2 rounded-xl">
                    </div>
                </div>
                @error('email')
                <span class="text-red-700 text-xs">{{$message}}</span>
                @enderror
                @error('password')
                <span class="text-red-700 text-xs">{{$message}}</span>
                @enderror

                <div class="my-2">
                    <button type="submit" class="border-2 rounded-xl p-1 duration-700 hover:drop-shadow-2xl hover:bg-white border-blue-900 text-blue-900">Sign Up</button>
                </div>
                <div>
                    <span class="font-normal text-sm">Already I have an account !<a href="/login" class="mx-1 font-bold text-blue-900 hover:drop-shadow-2xl">Log In</a></span>
                </div>
            </div>
        </form>

        </div>

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
    
</body>
</html>