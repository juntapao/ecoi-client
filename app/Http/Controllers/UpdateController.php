<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Area;
use App\Branch;
use App\Insuran_price;
use App\Menu;
use App\Region;
use App\Setting;
use App\User;
use App\UserRole;

class UpdateController extends Controller
{
    /**
     * Sync data from the sever.
     *
     * @param  string  $type
     * @return boolean
     */
    public static function sync($type)
    {
        try {
            $terminal_signature = CommonController::getTerminalSignature();

            // GET UPDATED AT
            switch($type) {
                case 'settings': {
                    $last_record = Setting::whereNotIn('name', ['terminal_signature'])
                        ->orderBy('updated_at', 'desc')    
                        ->first();
                    break;
                }
                case 'menus': {
                    $last_record = Menu::orderBy('updated_at', 'desc')->first();
                    break;
                }
                case 'roles': {
                    $last_record = UserRole::orderBy('updated_at', 'desc')->first();
                    break;
                }
                case 'users': {
                    $last_record = User::orderBy('updated_at', 'desc')->first();
                    break;
                }
                case 'regions': {
                    $last_record = Region::orderBy('updated_at', 'desc')->first();
                    break;
                }
                case 'areas': {
                    $last_record = Area::orderBy('updated_at', 'desc')->first();
                    break;
                }
                case 'branches': {
                    $last_record = Branch::orderBy('updated_at', 'desc')->first();
                    break;
                }
                case 'prices': {
                    $last_record = Insuran_price::orderBy('updated_at', 'desc')->first();
                    break;
                }
                case 'clean_up': {
                    $last_record = Insuran_price::orderBy('updated_at', 'desc')->first();
                    break;
                }
            }
    
            if($last_record) {
                $update_date = $last_record->updated_at->format('Y-m-d');

                // GET ALL IDS
                switch($type) {
                    case 'menus': {
                        $all_ids = Menu::where('updated_at', '<', $update_date)->pluck('id')->toArray();
                        break;
                    }
                    case 'roles': {
                        $all_ids = UserRole::where('updated_at', '<', $update_date)->pluck('id')->toArray();
                        break;
                    }
                    case 'users': {
                        $all_ids = User::where('updated_at', '<', $update_date)->pluck('id')->toArray();
                        break;
                    }
                    case 'regions': {
                        $all_ids = Region::where('updated_at', '<', $update_date)->pluck('id')->toArray();
                        break;
                    }
                    case 'areas': {
                        $all_ids = Area::where('updated_at', '<', $update_date)->pluck('id')->toArray();
                        break;
                    }
                    case 'branches': {
                        $all_ids = Branch::where('updated_at', '<', $update_date)->pluck('id')->toArray();
                        break;
                    }
                    case 'prices': {
                        $all_ids = Insuran_price::where('updated_at', '<', $update_date)->pluck('id')->toArray();
                        break;
                    }
                    default: {
                        $all_ids = [];
                    }
                }
            } else {
                $update_date = '0000-00-00';
                $all_ids = [];
            }

            $body = [
                'type' => $type,
                'terminal_signature' => $terminal_signature,
                'update_date' => $update_date,
                'ids' => $all_ids,
            ];

            $server_data = CommonController::curl(env('ECOI_SERVER_URL').'/api/sync', 'json', $body);

            // if($type == 'users') {
            //     // dd($body, array_slice($server_data->data, 100), $server_data->data);
            //     dd($body, $server_data);
            // }

            if(!empty($server_data->data)) {
                foreach($server_data->data as $data) {
                    switch($type) {
                        case 'settings': {
                            Setting::updateOrCreate([
                                'name' => $data->name,
                                'value' => $data->value,
                                'deleted_at' => $data->deleted_at,
                                'user_created' => $data->user_created,
                                'user_modified' => $data->user_modified,
                                'created_at' => $data->created_at,
                                'updated_at' => $data->updated_at,
                            ], [
                                'name' => $data->name,
                                'value' => $data->value,
                                'deleted_at' => $data->deleted_at,
                                'user_created' => $data->user_created,
                                'user_modified' => $data->user_modified,
                                'created_at' => $data->created_at,
                                'updated_at' => $data->updated_at,
                            ]);
                            break;
                        }
                        case 'menus': {
                            if(Str::contains($data->link, '/create')) {
                                $data->link = Str::replaceLast('/create', '', $data->link);
                            }
                            Menu::updateOrCreate(['id' => $data->id], (array)$data);
                            break;
                        }
                        case 'roles': {
                            UserRole::updateOrCreate(['id' => $data->id], (array)$data);
                            break;
                        }
                        case 'users': {
                            // $data->password = bcrypt($data->username);
                            User::updateOrCreate(['id' => $data->id], (array)$data);
                            break;
                        }
                        case 'regions': {
                            Region::updateOrCreate(['id' => $data->id], (array)$data);
                            break;
                        }
                        case 'areas': {
                            Area::updateOrCreate(['id' => $data->id], (array)$data);
                            break;
                        }
                        case 'branches': {
                            Branch::updateOrCreate(['id' => $data->id], (array)$data);
                            break;
                        }
                        case 'prices': {
                            Insuran_price::updateOrCreate(['id' => $data->id], (array)$data);
                            break;
                        }
                    }
                }
            }
        } catch(\Exception $exception) {
            session(['error' => $exception->getMessage()]);
            return false;
        }

        return true;
    }
}
