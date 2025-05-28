<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['name1','name2','gender','email', 'tel1','tel2','tel3', 'address','building','contact','content']);
        return view('confirm', compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        if ($request->input('action') === 'fix') {
            return redirect()->route('contact.index')->withInput(); 
            // 値を持って戻る
        }

    // 送信用データを組み立て
        $contactData = [
        'name' => $request->input('name1') . ' ' . $request->input('name2'),
        'gender' => $request->input('gender'),
        'email' => $request->input('email'),
        'tel' => $request->input('tel1') . $request->input('tel2') . $request->input('tel3'),
        'address' => $request->input('address'),
        'building' => $request->input('building'),
        'contact' => $request->input('contact'),
        'content' => $request->input('content'),
    ];
        // 送信用データ作成（nameを結合）
        // $contactData = $request->only([
        // 'gender', 'email', 'tel', 'address', 'building', 'contact', 'content'
        // ]);
        
        // $contactData['name'] = $request->input('name1') . ' ' . $request->input('name2');

            Contact::create($contactData);
        
            return view('thanks');
    }

    }


