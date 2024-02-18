<div>
<div class="font-kanit p-5">
    <div class="px-16 sm:px-44 md:px-64">                
        <form method="GET">   
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input wire:model.live="search" type="search" name="q" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for a course" required>
                <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-900  hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>
    </div>
</div>

<div class="p-6 font-kanit">
    <div>
        <div class="flex justify-center items-center">
            <h1 class="text-3xl font-bold p-2 mt-5">All Courses</h1>
        </div>
        @if ($numOfCourses >= 1)
        <div class="grid md:grid-cols-4 grid-cols-2 p-7">
            @foreach ($courses as $course)
            <div wire:key="course-{{$course->id}}" class="flex flex-col p-2 border-blue-900 m-2 hover:shadow-2xl duration-700 justify-center items-center border-2 rounded-md course-view">
                <img src="{{asset('img/imgCourses/'.$course->image)}}" class="rounded-md">
                @php
                    $userId = $course->teacherId ;
                    $user = \App\Models\User::find($userId);
                @endphp
                <a href="/profile/{{$user->username}}" wire:navigate class="font-bold text-blue-900">{{$user->username}}</a>
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
                        <a href="/courses?tag={{$tag}}" wire:navigate class="p-1 mx-1 bg-blue-800 text-white rounded-lg">{{$tag}}</a>                                    
                        @endforeach
                    </div>
                    <span class="flex justify-center items-center">
                        <img src="img/star.png" class="h-4">
                        <span>{{$course->rating}}</span>
                    </span>
                </div>
                <a href="/course/{{$course->id}}" wire:navigate class="p-2 bg-blue-900 rounded-xl text-white">Enroll Now</a>
            </div>    
            @endforeach
        </div>
        @else
        <div class="flex justify-center items-center">
            <h1 class="no-course">There are no courses found.</h1>
        </div>
        @endif

    </div>
</div>
</div>