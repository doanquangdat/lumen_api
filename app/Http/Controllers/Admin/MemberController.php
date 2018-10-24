<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Member;

class MemberController extends Controller
{
    /**
     * @function index
     */
    public function index() {
        $this->getList('Member');
    }

    /**
     * @funciton processForm
     */
    public function processForm(Request $request, $id = null) {
        
    }
}
