<?php

namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocController extends Controller
{
    public function index()
    {
        return view('doc.getting-started');
    }

    public function studi_kasus()
    {
        return view('doc.api.studi-kasus');
    }

    public function authentication()
    {
        return view('doc.api.authentication');
    }

    public function perusahaan()
    {
        return view('doc.api.perusahaan');
    }

    public function tim()
    {
        return view('doc.api.tim');
    }

    public function pemain()
    {
        return view('doc.api.pemain');
    }

    public function jadwal_pertandingan()
    {
        return view('doc.api.jadwal-pertandingan');
    }

    public function hasil_pertandingan()
    {
        return view('doc.api.hasil-pertandingan');
    }

    public function report()
    {
        return view('doc.api.report');
    }
}
