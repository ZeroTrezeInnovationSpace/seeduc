<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\InternalInfo;
use DateTime;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
	public function index(){ 
		return view('auth.login');
	}

	public function logIn(Request $request){ 
		$password = md5($request->password);
		$users = User::where('CPF', $request->CPF)->where('password', $password)->get();
		
		if($users){
			foreach ($users as $user) {
				$request->session()->put('name', $user->name);
				$request->session()->put('id', $user->id);
				return redirect()->action('FeedController@index'); 
			}
		}
		return view('auth.login', ['error' => 'Usuário ou/e Senha Inválido(s)!']);
	}

	public function logOut(Request $request){ 
		$request->session()->flush('id');
		$request->session()->flush('name');
		return redirect()->action('UserController@index');
	}

	public function registerIndex(){
		return view('user.register');
	}

	public function register(Request $request){ 

		$this->validate($request, [
			'name' => 'required',
			'CPF' => 'required|unique:users|max:255.teste',
			'password' => 'required',
		]);

		$users = User::all(); 
		$existe = 0;

		foreach ($users as $user){
			if ($request->input('CPF') == $user->CPF) 
				$existe++;	
		}

		if($existe == 0 && $request->input('CPF') &&$request->input('name') 
			&& $request->input('email') && $request->input('password') ){
			$user = new User;
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->CPF = $request->input('CPF');
		$user->register_id = $request->input('register_id');
		$user->second_register_id = $request->input('second_register_id');
		$user->password = md5($request->input('password'));
		$user->phone_number = $request->input('phone_number');
		$user->avaible_whatsapp = $request->input('avaible_whatsapp');
		$user->linkedin = $request->input('linkedin');
		$user->facebook = $request->input('facebook');
		$user->twitter = $request->input('twitter');
		$user->postal_code = $request->input('postal_code');
		$user->full_adress = $request->input('full_adress');
		$user->adress_number = $request->input('adress_number');
		$user->adress_complement = $request->input('adress_complement');
		$user->city = $request->input('city');
		$user->state = $request->input('state');
		$user->district = $request->input('district');

					#$user->user_picture = $request->input('user_picture'); VERIFICAR COMO PEGAR O CAMINHO
					#PERMISSÕES
					/*$user->publics()->attach($request->input('public'));
					$user->segments()->attach($request->input('segment'));
					$user->bonds()->attach($request->input('bond'));*/
					$user->save();
					$existe = 0;
					return redirect('/');
				}else{
					if($existe != 0)
						return print_r('eror');
				}
			}

			public function verifyCPF(){
				$CPF = $_GET['CPF'];
				$users = InternalInfo::where('CPF', $CPF)->get();
				
				if(isset($users[0]->name) && !empty($users[0]->name))
					return 1;
				else
					return 0;
			}

			public function events($id){
				$users = User::where('id', $id)->get();
				return view('user.events', ['users' => $users]);
			}
		}



