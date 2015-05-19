<?php namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;

trait AuthenticatesAndRegistersUsers {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * The registrar implementation.
	 *
	 * @var Registrar
	 */
	protected $registrar;

	/**
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getRegister()
	{
        $oClub = new \App\Club;
        $clubes = $oClub::all();

        return view('auth.my_register', array('clubes'=>$clubes));
		//return view('auth.register');
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	/*public function postRegister(Request $request)
	{
		$validator = $this->registrar->validator($request->all());

		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator
			);
		}

		$this->auth->login($this->registrar->create($request->all()));

		return redirect($this->redirectPath());
	}*/

    public function postRegister(Request $request)
    {
        $name       = \Input::get('username');
        $password   = \Input::get('password');
        $club       = \Input::get('club');

        $user = new \App\User;

        $dbclub = new \App\Club;
        $oClub = $dbclub::where("ID", $club)->get();

        $user->name = $name;
        $user->email = $oClub[0]['EMAIL'];
        $user->password = \Hash::make($password);
        $user->club_id  = $club;
        $user->token    = str_random(150);

        if($user->save()){

            $data = array(
                'id_club'   => $oClub[0]['ID'],
                'club'      => $oClub[0]['NOMBRE'],
                'email'     => $oClub[0]['EMAIL'],
                'username'  => $name,
                'password'  => $password,
                'token'     => $user->token
            );


            $message = "Benvenido";
            \Mail::send('emails/confirmation', $data, function($message) use ($data)
            {
                $message
                    ->to($data['email'], $data['club'])
                    ->subject("Convención 2015 AMCH - ". $data['club']);
            });
            return redirect('/')->with("message","Se ha enviado un E-Mail al director del club ".$data['club']." para que active el acceso.")
                ->with("msg",'info')
                ;
        }
    }

	/**
	 * Show the application login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogin()
	{
        $oUser = new \App\User;
        $oClub = new \App\Club;
        $clubes_ids = array();

        $users = $oUser::where('active', '=', 1)->get();

        foreach($users as $user){
            $clubes_ids[] = $user->club_id;
        }

        $clubes = $oClub::whereIn("ID", $clubes_ids)->get();

        return view('auth.my_login', array('clubes'=>$clubes));
		//return view('auth.login');
	}

	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postLogin(Request $request)
	{
		$this->validate($request, [
			'club' => 'required', 'password' => 'required',
		]);

        $oClub = new \App\Club;
        $clubes = $oClub::where("ID", $request->get('club'))->get();

        if(count($clubes) > 0){
            $credentials = array(
                'email' => $clubes[0]->EMAIL,
                'password' => $request->get('password')
            );


            /*$oUser = new \App\User;
            $user = $oUser::where('email', 'niko.afv@gmail.com')->get();
            print_r($user[0]->password);
            echo "<br/>";


            if (\Hash::check($request->get('password'), $user[0]->password))
            {
                echo "si es";
            }else{
                echo "no es";
            }
            die;*/


            //print_r( \Hash::make($request->get('password')));die;

            //$credentials = $request->only('email', 'password');
            if ($this->auth->attempt($credentials, $request->has('remember')))
            {
                $oZona = \App\Club::find($clubes[0]->ID)->zona;

                $user = \App\User::where('email', $clubes[0]->EMAIL)->get();
                \Session::put('username', $user[0]->name);
                \Session::put('Club',array(
                    'id' =>  $clubes[0]->ID,
                    'nombre' => $clubes[0]->NOMBRE,
                    'email' =>  $clubes[0]->EMAIL,
                    'zona'  =>  $oZona->NOMBRE
                ));
                return redirect()->intended($this->redirectPath());
            }
        }

		return redirect($this->loginPath())
					->withInput($request->only('email', 'remember'))
					->withErrors([
						'email' => $this->getFailedLoginMessage(),
					]);
	}

	/**
	 * Get the failed login message.
	 *
	 * @return string
	 */
	protected function getFailedLoginMessage()
	{
		return 'These credentials do not match our records.';
	}

	/**
	 * Log the user out of the application.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogout()
	{
		$this->auth->logout();

		return redirect('/');
	}

	/**
	 * Get the post register / login redirect path.
	 *
	 * @return string
	 */
	public function redirectPath()
	{
		if (property_exists($this, 'redirectPath'))
		{
			return $this->redirectPath;
		}

		return property_exists($this, 'redirectTo') ? $this->redirectTo : '/dashboard';
	}

	/**
	 * Get the path to the login route.
	 *
	 * @return string
	 */
	public function loginPath()
	{
		return property_exists($this, 'loginPath') ? $this->loginPath : '/auth/login';
	}

}
