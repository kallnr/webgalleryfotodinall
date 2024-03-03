<?php

namespace App\Http\Controllers;

use App\Models\foto;
use App\Models\User;
use App\Models\album;
use App\Models\folowers;
use App\Models\likefoto;
use App\Models\komenfoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    //proses register
    public function register(Request $request)
    {
        $messages = [
            'username' => 'Username sudah terdaftar',
            'email' => 'Email sudah terdaftar'
        ];
        //validasi
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',
            'email' => 'required|unique:users,email',
        ]);
        //simpan
        $dataStore = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
        ];
        User::create($dataStore);
        return redirect('/register')->with('success', 'Data berhasil disimpan');
    }
    //log in
    public function ceklogin(Request $request)
    {
        //validate
        $request->validate([
            'email' => ['required', 'email'],
            'password'  => ['required'],
        ]);
        //proses log in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect('/explore');
        }
        throw ValidationException::withMessages([
            'email' => 'Email Anda Salah',
            'password' => 'Password Anda Salah',
        ]);
    }
    //logout
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/');
    }
    //edit pw
    public function update_password(Request $request)
    {
        $user = User::find(auth()->user()->id);


        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password lama tidak sesuai']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect('profil')->with('success', 'Password Berhasil Diubah!');
    }



    //upload foto
    public function upload_foto(Request $request)
    {
        $namafile   = pathinfo($request->file, PATHINFO_FILENAME);
        $extensi    = $request->file->getClientOriginalExtension();
        $namafoto   = 'postingan' . time() . '.' . $extensi;
        $request->file->move('postingan', $namafoto);
        //simpan
        $datasimpan = [
            'users_id' => auth()->User()->id,
            'judul_foto' => $request->judul_foto,
            'deksripsi_foto' => $request->deksripsi_foto,
            'lokasi_file'   => $namafoto,
            'album_id' => $request->album,

        ];
        foto::create($datasimpan);
        return redirect('/explore');
    }
    //getDataExplore
    // public function getdata(Request $request){
    //     $cari =$request->cari;
    //     if($request->cari  !== 'null'){
    //         $explore = foto::with(['likefoto','album','users'])->withCount(['likefoto','komenfoto'])->where('judul_foto','likefoto','%'.$request->cari. '%')->orderBy('created_at','desc')->paginate();
    //     }else{
    //         $explore = foto::with(['likefoto','album','users'])->withCount(['likefoto','komenfoto'])->orderBy('created_at','desc')->paginate();
    //     }
    //     $explore = foto::with(['likefoto','album','users'])->withCount(['likefoto','komenfoto'])->orderBy('created_at','desc')->paginate();
    //     return response()->json([
    //         'data' => $explore,
    //         'statuscode' => 200,
    //         'idUser'    => auth()->user()->id
    //     ]);
    // }
    public function getdata(Request $request)
    {
        $cari = $request->cari;
        if ($cari !== 'null') {
            $explore = foto::with(['likefoto', 'album', 'users'])
                ->withCount(['likefoto', 'komenfoto'])
                ->where('judul_foto', 'like', '%' . $cari . '%')
                ->orderBy('created_at', 'desc')
                ->paginate();
        } else {
            $explore = foto::with(['likefoto', 'album', 'users'])
                ->withCount(['likefoto', 'komenfoto'])
                ->orderBy('created_at', 'desc')
                ->paginate();
        }
        return response()->json([
            'data' => $explore,
            'statuscode' => 200,
            'idUser'    => auth()->user()->id
        ]);
    }


    //likefoto
    public function likesfoto(Request $request)
    {
        try {
            $request->validate([
                'idfoto' => 'required'
            ]);
            $existingLike = likefoto::where('foto_id', $request->idfoto)->where('users_id', auth()->user()->id)->first();
            if (!$existingLike) {
                $dataSimpan = [
                    'foto_id'   => $request->idfoto,
                    'users_id'   => auth()->user()->id
                ];
                likefoto::create($dataSimpan);
            } else {
                likefoto::where('foto_id', $request->idfoto)->where('users_id', auth()->user()->id)->delete();
            }

            return response()->json('Data berhasil di simpan ', 200);
        } catch (\Throwable $th) {
            return response()->json('Something want wrong', 500,);
        }
    }
    //explore
    public function explore()
    {
        return view('user.explore');
    }
    //tambah album
    public function tambahalbum(Request $request)
    {
        //simpan
        $tambahalbum = [
            'users_id' => auth()->user()->id,
            'Nama_Album' => $request->Nama_Album,
            'deskripsi' => $request->deskripsi,
        ];
        album::create($tambahalbum);
        return redirect('/upload');
    }
    //getDataPostingansemua
    public function getdatapostingan(Request $request)
    {
        $postinganuserid = auth()->user()->id;
        $explore = foto::with(['likefoto', 'album', 'users'])->withCount(['likefoto', 'komenfoto'])->whereHas('users', function ($query) use ($postinganuserid) {
            $query->where('users_id', $postinganuserid);
        })->orderBy('created_at', 'desc')->get()->paginate(4);
        return response()->json([
            'data' => $explore,
            'statuscode' => 200,
            'idUser'    => auth()->user()->id
        ]);
    }
    //getDataAlbum
    public function getdataalbum(Request $request)
    {
        $postinganuserid = auth()->user()->id;
        $explore = foto::with(['likefoto', 'album', 'users'])->withCount(['likefoto', 'komenfoto'])->whereHas('users', function ($query) use ($postinganuserid) {
            $query->where('users_id', $postinganuserid);
        })->where('album_id', '!=', null)->paginate();
        return response()->json([
            'data' => $explore,
            'statuscode' => 200,
            'idUser'    => auth()->user()->id
        ]);
    }

    // tampilkan album sesuai user
    public function showalbum(string $id)
    {
        $data = [
            'dataalbum' => foto::with('album')->where('album_id', $id)->get()
        ];
        return view('user.showalbum', $data);
    }

    //profil
    public function profil()
    {
        $data = [
            'dataprofile'   => User::where('id', auth()->user()->id)->first(),
            'unggahan' =>  foto::with('users')->where('users_id', auth()->user()->id)->latest()->get(),
            'dataalbum' => album::where('users_id',auth()->user()->id)->get()
        ];
        return view('user.profil', $data);
    }
    public function editprofil()
    {
        $data = [
            'dataprofile'   => User::where('id', auth()->user()->id)->first()
        ];
        return view('user.editprofil', $data);
    }
    //updatedataprofile
    public function updatedataprofile(Request $request)
    {
        $dataupdate = [
            'username' => $request->username,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telephone'  => $request->no_telephone,
            'alamat'    => $request->alamat,
            'bio'   => $request->bio,
        ];
        ////proses update
        User::where('id', auth()->user()->id)->update($dataupdate);
        return redirect('/profil');
    }
    //fotoprofil
    public function fotoprofil(Request $request)
    {
        $namafile   = pathinfo($request->file, PATHINFO_FILENAME);
        $extensi    = $request->file->getClientOriginalExtension();
        $namafoto   = 'profile' . time() . '.' . $extensi;
        $request->file->move('pic', $namafoto);
        //data
        $dataupdate = [
            'foto_profil'  => $namafoto,
        ];
        //proses update
        User::where('id', auth()->user()->id)->update($dataupdate);
        return redirect('/profil');
    }
    //upload
    public function upload()
    {
        $data_album =album::where('users_id',auth()->user()->id)->get();
        return view('user.upload', compact('data_album'));
    }


    //explore detail
    public function explore_detail(string $id)
    {
        $data = [
            'keotherpin' => foto::with(['users'])->where('id', $id)->first()
        ];
        return view('user.explore-detail',$data);
    }
    //Exploredatadetail
    public function getdatadetail(Request $request, $id)
    {
        $dataDetailFoto     = foto::with(['users', 'album'])->where('id', $id)->firstOrFail();
        $dataJumlahPengikut = DB::table('folowers')->selectRaw('count(id_following) as jmlfolow')->where('id_following', $dataDetailFoto->users->id)->first();
        $dataFollow         = folowers::where('id_following', $dataDetailFoto->users->id)->where('users_id', auth()->user()->id)->first();
        return response()->json([
            'dataDetailFoto'    => $dataDetailFoto,
            'dataJumlahFollow'  => $dataJumlahPengikut,
            'dataUser'          => auth()->user()->id,
            'dataFollow'        => $dataFollow,
        ], 200);
    }
    //datakomentar
    public function ambildatakomentar(Request $request, $id)
    {
        $ambilkomentar = komenfoto::with('users')->where('foto_id', $id)->orderBy('created_at', 'desc')->get();
        return response()->json([
            'data'  => $ambilkomentar,
        ], 200);
    }
    //kirimkomentar
    public function kirimkomentar(Request $request)
    {
        try {
            $request->validate([
                'idfoto'   => 'required',
                'isi_komentar'  => 'required',
            ]);
            $dataStoreKomentar = [
                'users_id'  => auth()->user()->id,
                'foto_id'   => $request->idfoto,
                'isi_komentar'  => $request->isi_komentar,
            ];
            komenfoto::create($dataStoreKomentar);
            return response()->json([
                'data'      => 'Data berhasil di simpan',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json('Data komentar  gagal di simpann', 500);
        }
    }
    //explore edit password&username
    public function edit_password_username()
    {

        return view('user.changepassword');
    }
    //explore profil public
    // public function profil_public($id)
    // {
    //     $user = User::find($id);
    //     return view('user.profil-public', [
    //         'username' => $user->username,
    //         'foto_profil' => $user->foto_profil,
    //         'bio'   => $user->bio,
    //         'user_id'   => $id
    //     ]);
    // }


    //getDataPublic
    public function getdatapublic(Request $request, $id)
    {
        $publicuserid = auth()->user()->id;
        $explore = foto::with(['likefoto', 'album', 'users'])->withCount(['likefoto', 'komenfoto'])->where('users_id', $id)->paginate(4);
        return response()->json([
            'data' => $explore,
            'statuscode' => 200,
            'idUser'    => auth()->user()->id
        ]);
    }

    public function otherpin(string $id){
        $data = [
            'dataprofile' => User::where('id', $id)->first(),
            'datapic' => foto::with('users')->where('users_id', $id)->latest()->get()
        ];
        return view('user.profile_other',$data);
    }






    //follow
    // public function ikuti(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'idfollow' => 'required',
    //         ]);
    //         $existingFollow = folowers::where('users_id', auth()->user()->id)->where('id_following', $request->idfollow)->first();
    //         if (!$existingFollow) {
    //             $dataSimpan = [
    //                 'users_id'      => auth()->user()->id,
    //                 'id_following'  => $request->idfollow,
    //             ];
    //             folowers::create($dataSimpan);
    //         } else {
    //             folowers::where('users_id', auth()->user()->id)->where('id_following', $request->idfollow)->delete();
    //         }
    //         return response()->json('Data berhasil di eksekusi', 200);
    //     } catch (\Throwable $th) {
    //         return response()->json('Something went wrong', 500);
    //     }
    // }

    //ambil data profil pulik

    // public function getdataprofilother(Request $request)
    // {
    //     // $dataUser               = User::where('id', $id)->firstOrFail();

    //     $index                  = foto::with(['user'])->where('user_id', $request->userId)->paginate();
    //     $role                   = User::where('role', 'user');
    //     return response()->json([
    //         // 'datauser'                 => $dataUser,

    //         'data'                     => $index,
    //         'statuscode'               => 200,
    //         'userId'                   => auth()->user()->id
    //     ]);
    // }
}
