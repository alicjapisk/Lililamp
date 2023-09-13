<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $myUser = User::all();
        return view('users.list',['users'=>$myUser]);
    }
    public function search(Request $request) {
        $is_admin = $request->input('is_admin');
        $users = User::where('is_admin', $is_admin)->get();
        return view('users.list', ['users' => $users]);
        }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $myUser=User::find($id);
        if($myUser == null){
            $error_message = "User id=".$id." not find";
            return view('users.message',['message'=>$error_message,'type_of_message'=>'Error']);
        }
        if ($myUser->count()>0)
        return view('users.show',['users'=>$myUser]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $myUser = User::find($id);
        if ($myUser == null){
            $error_message = "User id=".$id." not find";
            return view('users.message',['message'=>$error_message,'type_of_message'=>'Error']);
        }
        if($myUser->count()>0)
        return view('users.',['users'=>$myUser]);
    }
    public function editClient($id)
    {
        $myUser = User::find($id);
        if ($myUser == null){
            $error_message = "User id=".$id." not find";
            return view('users.message',['message'=>$error_message,'type_of_message'=>'Error']);
        }
        if($myUser->count()>0)
        return view('users.editClient',['users'=>$myUser]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $validated=$request->validate([
            'id'=>'required|integer|gt:0',
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'login'=>'required',
           ]);
            if($validated){
                $users=User::find($id);
                if($users != null){
                    $users->id = $request->id;
                    $users->first_name = $request->first_name;
                    $users->last_name = $request->last_name;
                    $users->email = $request->email;
                    $users->login = $request->login;
                    $users->address = $request->address;
                    $users->zip_code = $request->zip_code;
                    if($request->input('is_admin') == 1){
                        $users->is_admin = true;
                    }
                    else{
                        $users->is_admin = false;
                    }
                    $users->save();
                        return redirect('/users/list');
                    } 
            }
                else{
                    $error_message = "User id=".$id." not find";
                    return view('users.message',['message'=>$error_message,'type_of_message'=>'Error']);
                }
            
    }

    public function updateClient(Request $request, $id)
    {
        $validated=$request->validate([
            'id'=>'required|integer|gt:0',
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'login'=>'required',
           ]);
            if($validated){
                $users=User::find($id);
                if($users != null){
                    $users->id = $request->id;
                    $users->first_name = $request->first_name;
                    $users->last_name = $request->last_name;
                    $users->email = $request->email;
                    $users->login = $request->login;
                    $users->address = $request->address;
                    $users->zip_code = $request->zip_code;
                    $users->save();
                        return redirect('/users/profile');
                    } 
            }
                else{
                    $error_message = "User id=".$id." not find";
                    return view('users.message',['message'=>$error_message,'type_of_message'=>'Error']);
                }
            
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $user = User::find($id);
    $orders = Orders::where('id_user', $user->id)->get();
    if (count($orders) > 0) {
        return redirect()->back()->with('error', "Błąd: nie można usunąć klienta ponieważ ma on zamówienia");
    }   
    else if($user != null){
        $user->delete();
            return redirect('/users/list');
    }   
    else{
        return redirect()->back()->with('error', "Błąd: nie ma takiego użytkownika");
    }
    }
    public function getCurrentUserData()
    {
        $userId = Auth::id();
        $userData = User::where('id', $userId)->first();
        return view('users.profile', ['userData' => $userData]);
    }
}
