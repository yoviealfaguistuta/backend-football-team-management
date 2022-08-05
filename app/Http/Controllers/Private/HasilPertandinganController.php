<?php

namespace App\Http\Controllers\Private;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HasilPertandingan;
use App\Models\JadwalPertandingan;
use App\Models\Pemain;
use App\Models\Tim;
use Illuminate\Support\Facades\Validator;

class HasilPertandinganController extends Controller
{
    // Link to "HasilPertandingan" models
    public function __construct() {
        $this->hasil_pertandingan = new HasilPertandingan;
        $this->tim = new Tim;
        $this->jadwal_pertandingan = new JadwalPertandingan;
        $this->pemain = new Pemain;
    }

    public function list()
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'hasil_pertandingan_list';

        // Eksekusi query dari HasilPertandingan "list" models
        $data = $this->hasil_pertandingan->go_list();

        // Cek jika terdapat data pada hasil query
        if ($data->total() > 0) {
            return $this->sendSuccessResponse($data, $__type);
        }
        return $this->sendFailedResponse('Data tidak ditemukan', $__type);
    }

    public function create(Request $request)
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'hasil_pertandingan_create';

        // Cek apakah bentuk data yang dikirim telah sesuai
        $validator = Validator::make($request->all(), [
            'id_jadwal_pertandingan' => ['required', 'min:1', 'numeric'],
            'id_pemain' => ['required', 'min:1', 'numeric'],
            'tipe' => ['required', 'min:1', 'numeric'],
            'waktu' => ['required', 'date_format:H:i'],
        ]);

        // Jika data yang dikirim tidak sesuai, maka kembalikan code 422 
        if ($validator->fails()) {
            return $this->sendValidationFailedResponse(
                $validator->messages(), 
                $__type
            );
        }

        // Cek jika terdapat jadwal pertandingan dengan ID yang diberikan
        $jadwal_pertandingan = $this->jadwal_pertandingan->go_exists($request->id_jadwal_pertandingan);
        if (!$jadwal_pertandingan) {
            return $this->sendValidationFailedResponse('Jadwal pertandingan tidak ditemukan', $__type);
        }

        // Cek tanggal jadwal pertandingan dengan tanggal saat data ingin dibuat 
        $cek_waktu_pertandingan = $this->jadwal_pertandingan->go_check_match_date($request->id_jadwal_pertandingan);
        if ($cek_waktu_pertandingan != 'valid') {
            return $this->sendValidationFailedResponse($cek_waktu_pertandingan, $__type);
        }

        // Cek waktu di jadwal pertandingan dengan waktu yang dikirimkan 
        $cek_waktu_pertandingan = $this->jadwal_pertandingan->go_check_match_time($request->id_jadwal_pertandingan, $request->waktu);
        if ($cek_waktu_pertandingan != 'valid') {
            return $this->sendValidationFailedResponse($cek_waktu_pertandingan, $__type);
        }

        // Cek jika terdapat tim dengan ID yang diberikan
        $pemain = $this->pemain->go_exists($request->id_pemain);
        if (!$pemain) {
            return $this->sendFailedResponse('Pemain tidak ditemukan', $__type);
        }

         // Cek pemain berada di Tim Tuan Rumah atau Tamu dalam pertandingan
        $tim_pemain = $this->hasil_pertandingan->go_check_player($request->id_jadwal_pertandingan, $request->id_pemain);
        if (!$tim_pemain) {
            return $this->sendFailedResponse('Pemain tidak berada di Tim Tuan Rumah ataupun Tim Tamu pada pertandingan ini', $__type);
        }

        // Eksekusi query dari HasilPertandingan "create" models
        $data = $this->hasil_pertandingan->go_create($request);

        // Cek jika query berhasil dilakukan
        if ($data) {
            return $this->sendSuccessResponse($data, $__type);
        }
        return $this->sendFailedResponse($data, $__type);
    }

    public function update(Request $request, $id)
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'hasil_pertandingan_update';

        // Cek apakah bentuk data yang dikirim telah sesuai
        $validator = Validator::make($request->all(), [
            'id_jadwal_pertandingan' => ['required', 'min:1', 'numeric'],
            'id_pemain' => ['required', 'min:1', 'numeric'],
            'tipe' => ['required', 'min:1', 'numeric'],
            'waktu' => ['required', 'date_format:H:i'],
        ]);

        // Jika data yang dikirim tidak sesuai, maka kembalikan code 422 
        if ($validator->fails()) {
            return $this->sendValidationFailedResponse(
                $validator->messages(), 
                $__type
            );
        }
        
        // Cek jika id yang dikirim bukan bilangan bulat
        if (!is_numeric($id)) {
            return $this->sendValidationFailedResponse('ID harus bilangan bulat', $__type);
        }

        // Cek jika terdapat tim dengan ID yang diberikan
        $jadwal_pertandingan = $this->jadwal_pertandingan->go_exists($request->id_jadwal_pertandingan);
        if (!$jadwal_pertandingan) {
            return $this->sendFailedResponse('Jadwal pertandingan tidak ditemukan', $__type);
        }
        
        // Cek jika terdapat tim dengan ID yang diberikan
        $pemain = $this->pemain->go_exists($request->id_pemain);
        if (!$pemain) {
            return $this->sendFailedResponse('Pemain tidak ditemukan', $__type);
        }

        // Cek waktu di jadwal pertandingan dengan waktu yang dikirimkan 
        $cek_waktu_pertandingan = $this->jadwal_pertandingan->go_check_match_time($request->id_jadwal_pertandingan, $request->waktu);
        if ($cek_waktu_pertandingan != 'valid') {
            return $this->sendValidationFailedResponse($cek_waktu_pertandingan, $__type);
        }

        // Cek jika terdapat hasil_pertandingan dengan ID yang diberikan
        $hasil_pertandingan = $this->hasil_pertandingan->go_exists($id);
        if (!$hasil_pertandingan) {
            return $this->sendFailedResponse('Jadwal pertandingan tidak ditemukan', $__type);
        }

        // Cek pemain berada di Tim Tuan Rumah atau Tamu dalam pertandingan
        $tim_pemain = $this->hasil_pertandingan->go_check_player($request->id_jadwal_pertandingan, $request->id_pemain);
        if (!$tim_pemain) {
            return $this->sendFailedResponse('Pemain tidak berada di Tim Tuan Rumah ataupun Tim Tamu pada pertandingan ini', $__type);
        }

        // Eksekusi query dari HasilPertandingan "go_update" models
        $data = $this->hasil_pertandingan->go_update($request, $id);

        // Cek jika query berhasil dilakukan
        if ($data) {
            return $this->sendSuccessResponse($data, $__type);
        }
        return $this->sendFailedResponse($data, $__type);
    }

    public function delete($id)
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'hasil_pertandingan_delete';

        // Cek jika id yang dikirim bukan bilangan bulat
        if (!is_numeric($id)) {
            return $this->sendValidationFailedResponse('ID harus bilangan bulat', $__type);
        }

        // Cek jika data dengan id yang dikirim terdapat pada tabel
        if (HasilPertandingan::where('id', $id)->exists()) {

            // Eksekusi query dari HasilPertandingan "create" models
            $data = $this->hasil_pertandingan->go_delete($id);

            // Cek jika query berhasil dilakukan
            if ($data) {
                return $this->sendSuccessResponse($data, $__type);
            }
            return $this->sendFailedResponse($data, $__type);
        }
        return $this->sendFailedResponse('Data tidak ditemukan', $__type);
    }
}
