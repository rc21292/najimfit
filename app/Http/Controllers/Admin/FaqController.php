<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use View;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use Session;
use Illuminate\Support\Facades\Input;

class FaqController extends Controller
{
    protected $faq;
    public function __construct(Faq $faq)
    {
        $this->faq = $faq;
    }
    
    public function index(){
        if (!empty($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $faqs = Faq::where('title', 'like', '%' . $keyword . '%')->get();
        } else {
            $faqs =Faq::latest('id')->get();
        }
        return view('backend.admin.faqs.index',compact('faqs'))->with('no', 1);
    }

    public function create()
    {
        return view('backend.admin.faqs.create')->with('no', 1);
    }

public function store(Request $request){
    $this->validate(
        $request,
        [
            'question' => 'required',
            'answer' => 'required',
        ]
    );
    $this->faq->saveFaq($request);
    Session::flash('success', 'Faq Saved');
    return Redirect::to('dashboard/faqs');
}

public function edit($id){
    if (!empty($id)) {
        $faqs = $this->faq::where('id', $id)->first();
        if (!empty($faqs)) {
            return view('backend.admin.faqs.edit',compact('faqs'));
        }
    }
}


public function update(Request $request, $id){
    $this->validate(
        $request,
        [
            'question' => 'required',
            'answer' => 'required',
        ]
    );
    $this->faq->updateFaq($request, $id);
    Session::flash('success', 'FAQ Updated');
    return Redirect::to('dashboard/faqs');
}

public function destroy($id){
    if (!empty($id)) {
        $this->faq::where('id', $id)->delete();
    }
    Session::flash('success', 'FAQ deleted');
    return Redirect::to('dashboard/faqs');
}

}
