<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Schedule;
use App\Models\Tutor;
use Illuminate\Http\Request;

class TutorApiController extends Controller
{
    public function getAllTutor()
    {
        $tutor = Tutor::all();

        return response()->json(['tutor'=>$tutor]);
    }

    public function viewInfoTutor(string $id)
    {
        $tutor = Tutor::where('id',$id)->get();

        return response()->json(['tutor'=>$tutor]);
    }

    public function makeAppoiment(Request $request)
    {
        $data = $request->json()->all();

        $id_tutor = $data['id_tutor'];
        $id_blog = $data['id_blog'];
        $id_member = $data['id_member'];
        $active = $data['active'];
        $day = $data['day'];
        $hour = $data['hour'];
        $location = $data['location'];

        $schedule = Schedule::create([
            'id_tutor' => $id_tutor,
            'id_blog' => $id_blog,
            'id_member' => $id_member,
            'active' => $active,
            'day' => $day,
            'hour' => $hour,
            'location' => $location
        ]);
        if($schedule){
            $blog = Blog::findOrFail($id_blog);
            $blog->active = 1;
            $blog->save();
            return response()->json(['status'=>'Đặt lịch hẹn thành công']);
        }
    }
}
