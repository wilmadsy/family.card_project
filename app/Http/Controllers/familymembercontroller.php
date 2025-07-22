<?php

namespace App\Http\Controllers;

use App\Models\familycard;
use App\Models\familymember;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class familymembercontroller extends Controller
{
    public function index(Request $request)
    {
        $no_kk = $request->no_kk;
        $fcard = DB::table('familycards as fc')
        // ->where('fc.fc_number', 'LIKE', '%'.$no_kk.'%')
        ->select(
        'fc.id', // Menggunakan ID sebagai primary key
        'fc.fc_number', 
        'fc.address',
        DB::raw('(SELECT full_name FROM familycard_detail 
                WHERE familycard_id = fc.id AND status = "Ayah" 
                LIMIT 1) as kepala_kk')
        )
        ->where('fc.fc_number', 'LIKE', '%'.$no_kk.'%')
        ->orderBy('fc.id', 'desc')
        ->paginate(5);
        // 
        // );
        
        // return (dd($no_kk, $fcard));
        return view('layouts.family.index', compact('no_kk', 'fcard'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fcard = DB::table('familycards')->select()->get();
        // return dd('fcard');
        return view('layouts.family.create', compact('fcard'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'fc_number' => $request->input('fc_number'),
            'address' => $request->input('address'),
            'rt_rw' => $request->input('rt_rw'),
            'ward' => $request->input('ward'),
            'districk' => $request->input('districk'),
            'regency' => $request->input('regency'),
            'region' => $request->input('region'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('familycards')->insert($data);

        return redirect('/kk/home')->with('success', 'KK Baru Berhasil Ditambahkan!');
    }

    // UNTUK ANGGGOTA KK
    public function create_m(string $id)
    {
        try {
            // $fcard = DB::table('familycards', 'fc')
            //     ->join('familycard_detail as fcd', 'fc.id', '=', 'fcd.familycard_id')
            //     ->get();
            // // return (dd($fcard));
            // return view('layouts.family.show', ['fcard' => $fcard]); 
            $fcard = DB::table('familycards')
                ->where('id', $id)
                ->first();
            // $fcard = DB::table('familycards')->select('id', 'fc_number')->get();


            $fmember = DB::table('familycard_detail')
                ->where('familycard_id', $id)
                ->first();
            // return (dd( $fmember,$fcard));
            return view('layouts.family.create2', compact('fcard', 'fmember'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // STORE ANGGOTA KELUARGA
    public function store_m(Request $request)
    {
        $data = [
            'familycard_id' => $request->input('familycard_id'),
            'full_name' => $request->input('full_name'),
            'pin' => $request->input('pin'),  
            'gender' => $request->input('gender'),
            'place_of_birth' => $request->input('place_of_birth'),
            'date_of_birth' => $request->input('date_of_birth'),
            'education' => $request->input('education'),
            'employment' => $request->input('employment'),
            'status' => $request->input('status'),
            'created_at' => now(),
            'updated_at' => now()
        ];

        DB::table('familycard_detail')->insert($data);


        return redirect('/kk/home')->with('success', 'Anggota KK Berhasil Ditambahkan!');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // $fcard = DB::table('familycards', 'fc')
            //     ->join('familycard_detail as fcd', 'fc.id', '=', 'fcd.familycard_id')
            //     ->get();
            // // return (dd($fcard));
            // return view('layouts.family.show', ['fcard' => $fcard]); 

            $fcard = DB::table('familycards')->where('id', $id)->first();
            // $fcard = DB::table('familycards')
            //     ->where('id', 'fc_number')
            //     ->first();

            // $fmember = DB::table('familycard_detail')->where('id',$id)->first();


            $fmember = DB::table('familycard_detail')
                ->where('familycard_id', '=', $fcard->id)
                ->paginate(10);
            // ->first();
            // return (dd($fcard,$fmember));
            // dd($fmember->first());
            return view('layouts.family.show', compact('fcard', 'fmember'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function pdf($id)
    {
        $mpdf = new \Mpdf\Mpdf();
        $fcard = DB::table('familycards')->where('id', $id)->first();
        $fmember = DB::table('familycard_detail')
            ->where('familycard_id', '=', $fcard->id)
            ->paginate(10);
        $mpdf->WriteHTML(view('layouts.family.show', compact('fcard', 'fmember')));
        $mpdf->Output();
    }

    public function dowmload_pdf($id)
    {
        $mpdf = new \Mpdf\Mpdf();
        $fcard = DB::table('familycards')->where('id', $id)->first();
        $fmember = DB::table('familycard_detail')
            ->where('familycard_id', '=', $fcard->id)
            ->paginate(10);
        $mpdf->WriteHTML(view('layouts.family.show', compact('fcard', 'fmember')));
        $mpdf->Output('download-pdf-KK.pdf', 'D');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fcard = DB::table('familycards')
            ->where('id', $id)
            ->first();

        $fmember = DB::table('familycard_detail')
            ->where('familycard_id', '=', $id)
            ->paginate(10);
        // return dd($fcard,$fmember);
        return view('layouts.family.edit', compact('fcard', 'fmember'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validatedData = $request->validate([
            'fc_number' => 'required',
            'address' => 'required',
            'rt_rw' => 'required',
            'ward' => 'required',
            'districk' => 'required',
            'regency' => 'required',
            'region' => 'required',
        ]);

        DB::table('familycards')
            ->where('id', $id)
            ->update([
                'fc_number' => $validatedData['fc_number'],
                'address' => $request->input('address'),
                'rt_rw' => $request->input('rt_rw'),
                'ward' => $request->input('ward'),
                'districk' => $request->input('districk'),
                'regency' => $request->input('regency'),
                'region' => $request->input('region'),
                'updated_at' => now()
            ]);

        return redirect("/kk/show/{$id}")->with('success', 'Data KK Berhasil Diubah');
    }

    public function edit_m(string $id)
    {
        //    $user = DB::select('SELECT * FROM familycards WHERE id = ?', [$id]);
        //    $user = DB::table('familycards')->where('id', (int)$id)->first();
        // $knownId = DB::table('familycards')->where('id')->first();
        $fmember = DB::table('familycard_detail')->where('id', $id)->first();

        $fcard = DB::table('familycards')
            ->where('id', $fmember->familycard_id)
            ->first();
        // dd($fcard); // Harus mengembalikan data
        // return dd($fcard);
        return view('layouts.family.edit2', compact('fcard', 'fmember'));
    }

    public function update_m(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'familycard_id' => 'required',
            'full_name' => 'required',
            'pin' => 'required',
            'gender' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'education' => 'required',
            'employment' => 'required',
            'status' => 'required',
        ]);

        DB::table('familycard_detail')
            ->where('id', $id)
            ->update([
                'familycard_id' => $validatedData['familycard_id'],
                'full_name' => $validatedData['full_name'],
                'pin' => $validatedData['pin'],
                'gender' => $validatedData['gender'],
                'place_of_birth' => $validatedData['place_of_birth'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'education' => $validatedData['education'],
                'employment' => $validatedData['employment'],
                'status' => $validatedData['status'],
            ]);


        return redirect("/kk/home")->with('success', 'Anggota KK berhasil diubah');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        DB::table('familycards')->where('id', $id)->delete();

        return redirect('/kk/home')->with('success', ' berhasil menghapus Data KK');
    }

    public function delete(string $id)
    {
        // dd($id);
        DB::table('familycard_detail')
            ->where('id', $id)
            ->delete();

        return redirect("/kk/home")->with('success', ' berhasil menghapus Anggota KK');
    }
}
