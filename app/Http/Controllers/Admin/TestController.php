<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Test;

class TestController extends Controller
{
    /**
     * @function fileUpload
     */
    public function fileUpload(Request $request) {
        $data = $request->all();
        $validImage = ['jpg', 'jpeg', 'gif', 'png'];
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required'
        ]);
        $nameImage = '';
        if($request->hasFile('avatar')) {
            $files = $request->file('avatar');
            foreach($files as $file) {
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $validImage);
                if($check) {
                    $nameImage = $file->store('avatar');
                    $destinationPath = storage_path('public/uploads');
                    $file->move($destinationPath, $fileName);
                }
            }
        }
        $data['avatar'] = $nameImage;
        $this->saveForm('Test', $data);
    }
}
