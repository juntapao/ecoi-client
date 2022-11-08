<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CommonController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\User;
use App\Menu;
use App\UserRole;
use App\Setting;
use App\Insuran_price;
use DB;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        if(Auth::attempt([
            'username' => $request->username,
            'password' => $request->password
        ])) {

            $roleId = auth()->user()->role_id;
            $branchName = auth()->user()->branch->branch_name;
            $userRoleAccess = UserRole::find($roleId)->access;
            $terminalSignature = Setting::where('name', 'terminal_signature')->first()->value;
            $terminalId = Setting::where('name', 'terminal_id')->first()->value;
            $systemSettings = Setting::whereIn('name', ['family_protect_plus', 'kp_protect', 'family_protect', 'pawners_protect', 'pinoy_protect_plus', 'mediphone'])
                ->select(['name', 'value'])
                ->get()->toArray();
            $insurancePrices = Insuran_price::select(['id', 'coi_type', 'price'])
                ->get()->toArray();

            $userRole = explode(',', $userRoleAccess);

            $menus = Menu::all();

            $parentmenu = $menus
                ->where('status', 1)
                ->whereIn('id', Menu::select('parent')
                    ->distinct()
                    ->whereIn('name', $userRole)
                    ->pluck('parent')
                );

            $childmenu = $menus
                ->where('status', 1)
                ->whereIn('name', $userRole)
                ->where('parent','!=', 0 );
            
            session([
                'parentmenu' => $parentmenu,
                'childmenu' => $childmenu,
                'userRole' => $userRole,
                'branchName' => $branchName,
                'terminalId' => $terminalId,
                'terminalSignature' => $terminalSignature,
                'systemSettings' => $systemSettings,
                'insurancePrices' => $insurancePrices,
            ]);

            // dd($parentmenu);

            return redirect()->route('dashboard');
        } else {
            session(['error' => 'Invalid Username or Password']);
            return redirect('/');
        }
    }

    public function showLoginForm()
    {
        $terminal_info = Setting::where('name', 'terminal_signature')
            ->first();

        if($terminal_info) {
            
            $current_version = Setting::where('name', 'current_version')
                ->first();

            if($current_version) {
                self::update_user();
                return view('auth.login')
                    ->with(compact('terminal_info'));
            } else {
                session(['initial-process' => true]);
                return redirect()->route('setup.index');
            }

        } else {
            session(['initial-process' => true]);
            return view('input-terminal');
        }
    }

    public function setTerminal(Request $request)
    {
        $request->validate([
            'signature' => 'required|size:50',
        ]);

        try {
            $local_signature = Str::random(50);

            $body = [
                'terminal_signature' => $request->signature,
                'local_signature' => $local_signature,
            ];
    
            $server_data = CommonController::curl(config('app.ecoi_server_url').'/api/new-terminal', 'get', $body);

            if($server_data && $server_data != '404') {
                
                Setting::insert([
                    [
                        'name' => 'terminal_signature',
                        'value' => $request->signature,
                        'user_created' => 1,
                        'user_modified' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ], [
                        'name' => 'local_signature',
                        'value' => $local_signature,
                        'user_created' => 1,
                        'user_modified' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]
                ]);

                if(isset($server_data->status_code)) {
                    if($server_data->status_code == '401') {
                        Setting::truncate();
                        session(['error' => $server_data->status_message]);
                        return view('input-terminal');
                    } else {
                        Setting::insert([
                            [
                                'name' => 'terminal_id',
                                'value' => $server_data->data->id,
                                'user_created' => 1,
                                'user_modified' => 1,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]
                        ]);

                        session(['success' => $server_data->status_message]);
                        return redirect()->route('setup.index');
                    }
                }
            } else {
                Setting::truncate();
                session(['error' => 'Server could not be contacted']);
                return view('input-terminal');
            }

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return view('input-terminal');
        }

        session(['update-process' => collect([
            ['name' => 'settings', 'status' => 'pending'],
            ['name' => 'menus', 'status' => 'pending'],
            ['name' => 'roles', 'status' => 'pending'],
            ['name' => 'users', 'status' => 'pending'],
            ['name' => 'regions', 'status' => 'pending'],
            ['name' => 'areas', 'status' => 'pending'],
            ['name' => 'branches', 'status' => 'pending'],
            ['name' => 'prices', 'status' => 'pending'],
        ])
    ]);
        return view('initial-setup');
    }

    public static function update_user()
    {
        $terminal_signature = CommonController::getTerminalSignature();
        $update_date = User::orderBy('updated_at', 'desc')->first()->updated_at->format('Y-m-d');
        $all_ids = User::where('updated_at', '<', $update_date)->pluck('id')->toArray();

        $body = [
            'type' => 'update_users',
            'terminal_signature' => $terminal_signature,
            'update_date' => $update_date,
            'ids' => $all_ids,
        ];

        $server_data = CommonController::curl(config('app.ecoi_server_url').'/api/sync', 'json', $body);

        if(!empty($server_data->data)) {
            foreach($server_data->data as $data) {
                User::updateOrCreate(['id' => $data->id], (array)$data);
            }
        }
    }
}
