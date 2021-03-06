<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\InternalInfo;
use DateTime;
use App\Bond;
use App\Http\Controllers\MailController as Mail;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
	public function index(){ 
		return view('auth.login');
	}

	public function logIn(Request $request){ 
		$password = md5($request->password);
		$users = User::where('CPF', $request->CPF)->where('password', $password)->get();
		$forgotPassword = $this->forgotPassword($request->CPF);
	    //print_r($forgotPassword);
	    //exit;
		if(!isset($forgotPassword)){
			if($users){
				foreach ($users as $user) {
					$request->session()->put('name', $user->name);
					$request->session()->put('id', $user->id);
					$request->session()->put('bond_id', $user->bond_id);
					return redirect()->action('FeedController@index'); 
				}
			}
			return view('auth.login', ['error' => 'Usuário ou/e Senha Inválido(s)!']);
		}else{
			return view('auth.forgotPassword',['user' => $forgotPassword]);
		}
	}

	public function logOut(Request $request){ 
		$request->session()->flush('id');
		$request->session()->flush('name');
		$request->session()->flush('bond_id');
		return redirect()->action('UserController@index');
	}

	public function registerIndex(){
		return view('user.register', ['bonds' => Bond::orderBy('id', 'desc')->get()]);
	}

	public function register(Request $request){ 
		$this->validate($request, [
			'name' => 'required',
			'CPF' => 'required|unique:users|min:11|max:11',
			'password' => 'required',
		]);

		if($request->input('CPF') &&$request->input('name') 
			&& $request->input('email') && $request->input('password') ){
			$user = new User;
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->CPF = $request->input('CPF');
		$user->register_id = $request->input('register_id');
		$user->second_register_id = $request->input('second_register_id');
		$user->password = md5($request->input('password'));
		$user->phone_number = $request->input('phone_number');
		$user->avaible_whatsapp = $request->input('avaible_whatsapp', 0);
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
		$user->bond_id = $request->input('bond_id'); 

					#$user->user_picture = $request->input('user_picture'); VERIFICAR COMO PEGAR O CAMINHO
					#PERMISSÕES
					/*$user->publics()->attach($request->input('public'));
					$user->segments()->attach($request->input('segment'));
					$user->bonds()->attach($request->input('bond'));*/
					$user->save();
					$existe = 0;
					return redirect('/')->with('sucess', 'Cadastrado com sucesso!');
				}else{
					return redirect('/register')->with('error', 'Usuário já cadastrado!');
				}
			}

			public function manage(Request $request)
			{
				$bond_name = Bond::select('name')->where('id', $request->session()->get('bond_id'))->get();
				$id = $request->session()->get('id');
				$users = User::where('id', $id)->get();
				return view('user.edit', ['users' => $users[0], 
					'bonds' => Bond::orderBy('id', 'desc')->get(),
					'bond_name' => $bond_name[0] ])
				->with('name', $request->session()->get('name'));
			}

			public function update(Request $request)
			{

				$user = User::find($request->session()->get('id'));
				$user->name = $request->input('name');
				$user->email = $request->input('email');
				$user->CPF = $request->input('CPF');
				$user->register_id = $request->input('register_id');
				$user->second_register_id = $request->input('second_register_id');
				$user->phone_number = $request->input('phone_number');
				$user->avaible_whatsapp = $request->input('avaible_whatsapp', 0);
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
				$user->bond_id = $request->input('bond_id'); 

				$user->save();
				return redirect()->action('UserController@manage')
				->with('sucess', 'Cadastro Alterado Com Sucesso! \nPara validar alterações faça o login novamente.');
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


			public function forgotPassword($cpf){
				//Se o usuário possuir a flag de atualização de senha, 
				//redirecionar para tela de inserção de nova senha
				$users = User::where('CPF', $cpf)->where('update_password', '1')->get();
				//redirect('/register')->with('error', 'Usuário já cadastrado!');
				if(isset($users[0]) && !empty($users[0])){
					return $users[0];
				}
			}

			public function newPassword(Request $request){
				$user = User::findOrFail($request->id);
				$user->password = md5($request->input('password'));
				$user->update_password = 0;
				$user->save();
				return redirect('/')->with('success', 'Senha alterada com sucesso!');
			}

			public function rememberPassword(){
				return view('auth.verifyRememberPassword');
			}

			public function verifyRememberPassword(Request $request){
				$users = User::where('CPF', $request->input('CPF'))->where('email', $request->input('email'))->get();
				if($users){
					foreach ($users as $user) {
						$user->update_password = 1;
						$user->save();
						return redirect('/')->with('success', 'Solicitação Aceita! Favor tentar novo login e redefinir sua senha');
						/*$mail = new Mail();
						$mail = $mail->rememberPassword($user->email, $user->name);
						if($mail == 1){
		        			return redirect('/remember_password')->with('success', 'Email enviado com sucesso!');
		        		}else{
		        			return redirect('/remember_password')->with('error', 'Erro ao enviar email de refinição de senha!');
		        		}*/
		        	}
		        }
		        return redirect('/remember_password')->with('error', 'CPF ou Email informados não correspondentes!');			
		    }
		}





