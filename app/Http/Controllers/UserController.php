<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Validator;
use App\Models\User;


class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'users' => User::orderBy('created_at', 'desc')->paginate(20)
        ]);
    }


    public function updateTodoById(Request $request)
    {
        try {
            $user = User::where('id', $request->id)->first();
            $user->authority_level  = $request->authority_level;
            $user->update();
            session()->flash('flash_sucess', 'データの更新が完了しました');
        } catch (\Throwable $e) {
            session()->flash('flash_error',  'データ更新に失敗しました');
        }
        return redirect('useredit');
    }

    public function destroy(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->delete();
        session()->flash('flash_sucess', 'データの削除が完了しました');
        return redirect('useredit');
    }
}
