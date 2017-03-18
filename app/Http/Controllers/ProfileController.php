<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Image;
use File;
use Validator;

class ProfileController extends Controller
{
    public $sns_list = ['bitbucket', 'github', 'linkedin', 'youtube',
                        'vimeo', 'facebook', 'instagram', 'twitter',
                        'pinterest', 'dropbox', 'tumblr', 'google',
                        'foursquare', 'flickr', 'reddit', 'vk',
                        'soundcloud', 'openid'];

    public function snsUpdate(Request $request){
        $me = Auth::user();
        if($request->mode == 'add'){
            $me->settings()->update('SNS.'.$request->snsName, $request->snsLink);
            return response()->json([
                'result' => 'success'
            ]);
        } else {
            $me->settings()->delete('SNS.'.$request->snsName);
            return response()->json([
                'result' => 'success'
            ]);
        }
    }

    public function settingsUpdate(Request $request){
        $me = Auth::user();
        $settingsIn =json_decode($request->input('settings'), true);
        foreach ($settingsIn as $key => $value) {
            $me->settings()->update($key, $value);
        }
        $me->aboutme = $request->aboutme;
        $me->save();
        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * [passwordUpdate description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function passwordUpdate(Request $request) {
        $me = Auth::user();
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed'
        ]);
        if ($validator->fails()) {
            return response()->json(['result' => 'fail', 'errors' => $validator->messages()], 200);
        }
        $me->password = bcrypt($request->password);
        $me->save();
        return response()->json([
            'result' => 'success'
        ]);
    }

    /**
     * [basicUpdate description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function basicUpdate(Request $request){
        $me = Auth::user();
        if($me->name == $request->name && $me->email == $request->email){
            return response()->json([
                'result' => 'none'
            ]);
        } else {
            $valid = [];
            if($me->name != $request->name){
              $valid['name'] = 'required|max:255|unique:users';
              $me->name = $request->name;
              $me->slug = str_slug($request->name);
            }
            if($me->email != $request->email){
              $valid['email'] = 'required|email|max:255|unique:users';
              $me->email = $request->email;
            }

            $validator = Validator::make($request->all(), $valid);

            if ($validator->fails()) {
                return response()->json(['result' => 'fail', 'errors' => $validator->messages()], 200);
            }

            $me->save();
            return response()->json([
                'result' => 'success'
            ]);
        }
    }

    public function avatarUpload(Request $request){
        if ($request->hasFile('croppedImage'))
        {
            //return ini_get('upload_max_filesize').'- '.File::size('croppedImage');
            $me = Auth::user();
            $image = $request->file('croppedImage');
            #PATH
            $path='users/'.$me->id.'/avatar/';
            $mime = explode('/', $image->getClientMimeType() );
            $ext = strtolower( end($mime)); //$image->getClientOriginalExtension();
            $filename=$path.time();
            $fullname = $filename.'.'.$ext;
            // store for local
            //$fullname = public_path('images/'.$filename);
            //Image::make($image)->resize(150, 150)->save($fullname);
            // for s3
            Storage::disk('s3')->deleteDirectory($path);
            $img_n = Image::make($image)->resize(150, 150)->encode($ext);
            $img_m = Image::make($image)->resize(50, 50)->encode($ext);
            $img_s = Image::make($image)->resize(25, 25)->encode($ext);
            $path = Storage::disk('s3')->put( $fullname, (string) $img_n );
            Storage::disk('s3')->put( $filename.'_m.'.$ext, (string) $img_m );
            Storage::disk('s3')->put( $filename.'_s.'.$ext, (string) $img_s );
            // DB update image path
            $url = Storage::disk('s3')->url($fullname);
            $me->avatar = $url;
            $me->save();
            return response()->json([
                'result' => 'success',
                'name' => $fullname,
                'imagePath' => $url
            ]);

        }
        else{
            return response()->json([
                'result' => 'fail',
                'message' => 'Check your image size.'
            ]);
         }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->show(Auth::user());
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //return $user;
        $loginUser = Auth::user();
        if($loginUser->name == $user->name)
          $owner = true;
        else
          $owner = false;
        // Nation name find
        $path = public_path();
        $string = file_get_contents($path."/plugins/countries-master/dist/countries.json");
        $nations = collect(json_decode($string, true));
        $nation = $nations->where('cca2', $loginUser->settings()->get('nation'))->first();

        return view('admin.profile.profile')->with(['user' => $user,
                                                    'owner' => $owner,
                                                'nation' => $nation['name']['common']]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
      //return Auth::user();//$user;
      //dd(Auth::user()->settings()->get('sns'));
      return view('admin.profile.edit')->with(['user' => Auth::user(),
                                                'sns_list' => $this->sns_list]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
