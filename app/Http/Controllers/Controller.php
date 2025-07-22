/
//     public function index(): View
//     {
//         // $fcard = DB::table('familycards')
//         // ->select()
//         // ->get();

//         // ->latest();
//         // ->first();

//         // $fmember = DB::table('familycard_detail')
//         //     ->select()
//         //     ->get();
//             // ->paginate(10);

//        $fcard = DB::table('familycards as fc')
//     ->select(
//         'fc.id', // Menggunakan ID sebagai primary key
//         'fc.fc_number', 
//         'fc.address',
//         DB::raw('(SELECT full_name FROM familycard_detail 
//                 WHERE familycard_id = fc.id AND status = "Ayah" 
//                 LIMIT 1) as kepala_kk')
//     )
//     ->orderBy('fc.id', 'desc')
//     // ->get()
//     ->paginate(5);
//         // Cek apakah ada data dengan status 'Ayah'
//         // $fmember = DB::table('familycard_detail')
//         //     ->where('status', 'Ayah')
//         //     ->get();
//         $max_data = 5;
//         if (request('search')){
//             $data = DB::table('familycards')->where('task', 'like', '%' . request('search') . '%')->paginate($max_data)->withQueryString();
//         }else {
//             // $data = todo::orderByRaw('id DESC, is_done ASC')->paginate($max_data);    
//             $data = DB::table('familycards')->orderBy('id', 'desc')->paginate($max_data);    
//             $data = DB::table('familycard_detail')->orderBy('familycard_id', 'asc')->paginate($max_data);    
//         }

//     // $fmember = DB::table('familycard_detail')
//     // ->where('status', 'Ayah')
//     // ->where('familycard_id', '29 ') // Cek khusus untuk KK nomor 2
//     // ->get()

//         // return(dd($fcard, $data));
//         return view('layouts.family.index', compact('fcard', 'data'));
//     }

// }


, 'like', '%' . $search . '%'



$fcard = DB::table('familycards as fc')
        ->select(
        'fc.id', // Menggunakan ID sebagai primary key
        'fc.fc_number', 
        'fc.address',
        DB::raw('(SELECT full_name FROM familycard_detail 
                WHERE familycard_id = fc.id AND status = "Ayah" 
                LIMIT 1) as kepala_kk')
        )
        ->orderBy('fc.id', 'desc')
        ->paginate(5);