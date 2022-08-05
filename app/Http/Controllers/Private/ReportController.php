<?php

namespace App\Http\Controllers\Private;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HasilPertandingan;
use App\Models\JadwalPertandingan;
use App\Models\Pemain;
use App\Models\Report;
use App\Models\Tim;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    // Link to "HasilPertandingan" models
    public function __construct() {
        $this->report = new Report;
        $this->hasil_pertandingan = new HasilPertandingan;
        $this->tim = new Tim;
        $this->jadwal_pertandingan = new JadwalPertandingan;
        $this->pemain = new Pemain;
    }

    public function report($id_jadwal_pertandingan)
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'report';

        // Cek jika terdapat jadwal_pertandingan dengan ID yang diberikan
        $jadwal_pertandingan = $this->jadwal_pertandingan->go_exists($id_jadwal_pertandingan);
        if (!$jadwal_pertandingan) {
            return $this->sendFailedResponse('Jadwal pertandingan tidak ditemukan', $__type);
        }

        // Eksekusi query dari HasilPertandingan "list" models
        $data = $this->report->go_report($id_jadwal_pertandingan);

        // Cek jika terdapat data pada hasil query
        if ($data) {
            return $this->sendSuccessResponse($data, $__type);
        }
        return $this->sendFailedResponse('Data tidak ditemukan', $__type);
    }
}
