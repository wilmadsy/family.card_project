<?php

namespace App\Http\Controllers;
use App\Http\Controllers\familymembercontroller;
use Illuminate\Http\Request;


class familycontroller extends Controller
{
    public function delete(string $id)
    {
        dd($id);
        // DB::table('familycard_detail')
        // ->where('id', $id)
        // ->delete();

        return redirect("/kk/edit/{$id}")->with('success', ' berhasil menghapus');

    }


}
