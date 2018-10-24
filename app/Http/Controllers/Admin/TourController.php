<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TourController extends Controller
{
    /**
     * @function index
     */
    public function index() {
        $this->getList('Tour', 'category');
    }

    /**
     * @function getInfo
     * @params id
     */
    public function getInfo($id) {
        $this->getDetail('Tour', $id, 'category');
    }

    public function processForm(Request $resquest, $id = null) {
        $data = $resquest->all();
        $dataValidate = [
            'name' => 'required',
            'description' => 'required',
            'date' => 'required',
            'price' => 'required|numeric',
            'number_guest' => 'required|numeric',
            'category_id' => 'required|numeric'
        ];
        if($id) {
            $dataValidate['status'] = 'required|numeric';
            $this->validate($resquest,$dataValidate);
            $data['id'] = $id;
            $data['updated_at'] = Carbon::now();
        } else {
            $this->validate($resquest,$dataValidate);
            $data['status'] = 1;
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();
        }
        $this->saveForm('Tour', $data);
    }

    /**
     * @function: deleteCategory
     * @params: id
     */
    public function deleteTour($id) {
        $this->delete('Tour', $id);
    }

}
