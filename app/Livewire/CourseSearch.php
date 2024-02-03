<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;

class CourseSearch extends Component
{
        public $search;

        public function render()
        {
            $q = request('q');
            $tag = request('tag');

            if(!$q && !$tag){
                $courses = Course::where('name', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', 'desc')
                ->get();
            
                
                $numOfCourses = count($courses);
            }
            else {
                $courses = Course::where('name' , 'like' , '%'.$q.'%')->where('tags' , 'like' , '%'.$tag.'%')->get();
                $numOfCourses = count($courses);
            }

        
            return view('livewire.course-search', [
                'courses' => $courses,
                'numOfCourses' => $numOfCourses,
            ]);
        }    
}
