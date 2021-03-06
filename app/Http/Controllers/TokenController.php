<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\TokenFormRequest;

class TokenController extends Controller
{	
	public function register(TokenFormRequest $request){
        echo "aaa";
        $email = $request->input('email');
        $name = $request->name;
        $pass = Hash::make($request->input('password'));
        return User::create([
            "name"      => $name,
            'email'     => $email,
            'password'  => $pass
        ]);
    }
    public function gerarToken(Request $request)
    {
        $usuario = User::where('email', $request->email)->first();
        
        if (is_null($usuario)
            || !Hash::check($request->password, $usuario->password)
        ) {
            return response()->json('Invalid User or Password', 401);
        }
        $token = JWT::encode(
            ['email' => $request->email],
            env('JWT_KEY')
        );
        
        return [
            'access_token' => $token
        ];
    }
}