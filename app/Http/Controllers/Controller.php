<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Detail;
use Intervention\Image\Facades\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        return Inertia::render('Data');

    }
    public function store(Request $request){
        $userProfile = new Detail();
        $userProfile->name = $request->name;
        $userProfile->gender = $request->gender;
        $userProfile->hobbies = $request->hobbies;
        $userProfile->dob = $request->dob;
        $userProfile->city = $request->city;
        $userProfile->save();

        if ($request->hasFile('image')) {
            $image = $request->image;
            $path = 'detail_Image/' . $userProfile->id;
            $imageName = $image->getClientOriginalName();
            $image->storeAs($path, $imageName, 'public');

            $userProfile->image = $path . '/' . $imageName;
            $userProfile->save();
        }

        return 'data saved';
    }

    public function update(Request $request, Detail $detail){
        $data = $detail->toArray();
        $data['hobbies'] = explode(',', $data['hobbies']);

        return Inertia::render('Update', [
            'detail' => $data,
        ]);
    }

    public function edit(Request $request, Detail $detail) {

        $data = $request->validate([
            'name' =>'required|string|max:255',
            'dob' => 'required|string:max:255',
            'gender' => 'required|string|max:255',
            'hobbies' => 'required|string',
            'city' =>'required|string|max:255',
            'image' => 'nullable|file'
        ]);

        if (!empty($data['image'])) {
            $image = $data['image'];
            $path = 'detail_Image/' . $detail->id;
            $imageName = $image->getClientOriginalName();
            $image->storeAs($path, $imageName, 'public');

            $data['image'] = $path . '/' . $imageName;
        }

        $detail->update($data);

        return response()->json($data);
    }

    public function getData(){
        $data = Detail::all();
         return Inertia::render('AllData',[
             'allData'=>$data,

         ]);
    }

    public function singleData($id){
            $data = Detail::where('id',$id)->first();
            return response()->json($data);
    }

}

