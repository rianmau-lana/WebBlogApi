<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CustomAuthController extends Controller
{
    const API_BASE = 'https://blog-api.stmik-amikbandung.ac.id/api/v2/blog/_table/';
    const API_KEY = 'ef9187e17dce5e8a5da6a5d16ba760b75cadd53d19601a16713e5b7c4f683e1b';
    private $apiClient;

    public function __construct()
    {
        $this->apiClient = new Client([
            'base_uri' => self::API_BASE,
            'headers' => [
                'X-DreamFactory-API-Key' => self::API_KEY
            ]
        ]);
    }
    
    public function index() {
        return view('auth.login'); 
    }

    public function customlogin(Request $request) {
        if($request->isMethod('post')) {
            //1. Tampilkan detail data author setelah login
            $name = $request->input('name');
            $email = $request->input('email');
            $request->session()->put(['name' => $name, 'email' => $email]);

            return redirect('/home');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration() {
        return view('auth.register');
    }

    public function customRegistration(Request $request) {
        if ($request->isMethod('post')) {
            $name = $request->input('name');
            $email = $request->input('email');

            $dataModel = [
                'resource' => []
            ];

            $dataModel['resource'][] = [
                'name' => $name,
                'email' => $email,
            ];

            try {
                $reqData = $this->apiClient->post('authors', [
                    'json' => $dataModel
                ]);
                $apiResponse = json_decode($reqData->getBody())->resource;

                // dd($apiResponse);
                Cache::forget('index');

                return redirect("login");
            } catch (Exception $e) {
                abort(501);
            }
        }

        return redirect("/home")->withSuccess('You have signed-in');
    }

    public function dashboard() {
        if(Auth::check()) {
            return view('/home');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function signOut() {
        session()->forget('name');
        session()->forget('email');

        return redirect('/home');
    }
}
