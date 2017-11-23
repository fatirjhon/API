<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct(User $user){
    	$this->user = $user;
    }

    public function index(){
    	return $this->user->all();
    }

    public function show($id){
    	$data = $this->user->where('id', $id)->get();
    	return response()->json(compact('data'), 200);
    }
}
