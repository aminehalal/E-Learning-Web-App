<!DOCTYPE html>
<html lang="en" id="htmlDoc">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/add_course.css')}}">
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

        <div class="font-kanit flex flex-col justify-center items-center p-9 form-add">
            <form action="/teacher/store" method="POST" class="flex flex-col justify-center items-center border-2 border-blue-900 dark:border-white m-2 p-5 rounded-xl border-dashed" enctype="multipart/form-data">
                @csrf
            <div class="flex flex-col justify-center items-center">
                <label for="name" class="title p-2">Name</label>
                <input type="text" name="name">
            </div>
            @error('username')
            <span class="text-red-700 text-xs">{{$message}}</span>
            @enderror
            <input type="hidden" name="teacherId" value="{{auth()->user()->id}}">
            <div class="flex flex-col justify-center items-center">
                <label for="description" class="p-2 title">Description</label>
                <textarea name="description" cols="" rows="2"></textarea>
            </div>
            @error('description')
            <span class="text-red-700 text-xs">{{$message}}</span>
            @enderror
            <div class="flex flex-col justify-center items-center">
                <label for="category" class="p-2 title">Category</label>
                <select name="category">
                    <option value="Web/Mobile Develempent">Web/Mobile Development</option>
                    <option value="Design">Design</option>
                    <option value="Programming">Programming</option>
                    <option value="Networking">Networking</option>
                </select>
            </div>
            @error('category')
            <span class="text-red-700 text-xs">{{$message}}</span>
            @enderror
            <div class="flex flex-col justify-center items-center">
                <label for="tags" class="p-2 title">Tags</label>
                <input type="text" name="tags">
            </div>
            @error('tags')
            <span class="text-red-700 text-xs">{{$message}}</span>
            @enderror
            <div class="flex flex-col justify-center items-center">
                <label for="image" class="p-2 title">Image</label>
                <label for="input-image" class="label-input flex justify-center items-center" id="file-label">
                    <img src="{{asset('img/upload-logo.png')}}" class="logo-upload">
                    Select The Image</label>
                <input type="file" class="input-file" id="input-image" name="image" accept="image/*" onchange="updateFileName()">
            </div>
            @error('image')
            <span class="text-red-700 text-xs">{{$message}}</span>
            @enderror
            <div class="flex flex-col justify-center items-center">
                <label for="video[]" class="p-2 title">Videos</label>
                <label for="input-video" class="label-input flex justify-center items-center" id="file-label-video">
                    <img src="{{asset('img/upload-logo.png')}}" class="logo-upload">
                    Select The Videos</label>
                <input type="file"  name="video[]" class="input-file" multiple accept="video/*" id="input-video" onchange="updateFileNameVideo()">
            </div>
            @error('video')
            <span class="text-red-700 text-xs">{{$message}}</span>
            @enderror
            <button type="submit" class="text-blue-900 p-2 m-2 border-2 dark:text-white dark:border-white border-blue-900 rounded-lg hover:bg-white duration-700">Add the Course</button>
        </form>
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

            function updateFileName() {
                const input = document.getElementById('input-image');
                const label = document.getElementById('file-label');
                
                if (input.files.length > 0) {
                label.innerText = input.files[0].name;
                label.classList.add('done-upload');
                } else {
                label.innerText = 'Select The Image';
                label.classList.remove('done-upload');
                }
            }
            function updateFileNameVideo() {
                const input = document.getElementById('input-video');
                const label = document.getElementById('file-label-video');
                
                if (input.files.length > 0) {
                label.innerText = input.files[0].name;
                label.classList.add('done-upload');
                } else {
                label.innerText = 'Select The Videos';
                label.classList.remove('done-upload');
                }
            }
        </script>
    
</body>
</html>