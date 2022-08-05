<?php

namespace App\Http\Controllers\Private;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPertandingan;
use App\Models\Perusahaan;
use App\Models\Tim;
use Illuminate\Support\Facades\Validator;

class JadwalPertandinganController extends Controller
{
    // Link to "JadwalPertandingan" models
    public function __construct() {
        $this->jadwal_pertandingan = new JadwalPertandingan;
        $this->tim = new Tim;
    }

    public function list()
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'jadwal_pertandingan_list';

        // Eksekusi query dari JadwalPertandingan "list" models
        $data = $this->jadwal_pertandingan->go_list();

        // Cek jika terdapat data pada hasil query
        if ($data->total() > 0) {
            return $this->sendSuccessResponse($data, $__type);
        }
        return $this->sendFailedResponse('Data tidak ditemukan', $__type);
    }

    public function create(Request $request)
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'jadwal_pertandingan_create';

        // Cek apakah bentuk data yang dikirim telah sesuai
        $validator = Validator::make($request->all(), [
            'id_tim_tuan_rumah' => ['required', 'min:1', 'numeric'],
            'id_tim_tamu' => ['required', 'min:1', 'numeric'],
            'tanggal' => ['required', 'date'],
            'waktu' => ['required', 'string'],
        ]);

        // Jika data yang dikirim tidak sesuai, maka kembalikan code 422 
        if ($validator->fails()) {
            return $this->sendValidationFailedResponse(
                $validator->messages(), 
                $__type
            );
        }

        // Cek jika tim tuan rumah dan tamu sama
        if ($request->id_tim_tuan_rumah == $request->id_tim_tamu) {
            return $this->sendFailedResponse('Tim tuan rumah dan tamu harus berbeda', $__type);
        }

        // Cek jika terdapat tim dengan ID yang diberikan
        $tim_tuan_rumah = $this->tim->go_exists($request->id_tim_tuan_rumah);
        if (!$tim_tuan_rumah) {
            return $this->sendFailedResponse('Tim tuan rumah tidak ditemukan', $__type);
        }
        
        // Cek jika terdapat tim dengan ID yang diberikan
        $tim_tamu = $this->tim->go_exists($request->id_tim_tamu);
        if (!$tim_tamu) {
            return $this->sendFailedResponse('Tim tamu tidak ditemukan', $__type);
        }

        // Eksekusi query dari JadwalPertandingan "create" models
        $data = $this->jadwal_pertandingan->go_create($request);

        // Cek jika query berhasil dilakukan
        if ($data) {
            return $this->sendSuccessResponse($data, $__type);
        }
        return $this->sendFailedResponse($data, $__type);
    }

    public function update(Request $request, $id)
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'jadwal_pertandingan_update';

        // Cek apakah bentuk data yang dikirim telah sesuai
        $validator = Validator::make($request->all(), [
            'id_tim_tuan_rumah' => ['required', 'min:1', 'numeric'],
            'id_tim_tamu' => ['required', 'min:1', 'numeric'],
            'tanggal' => ['required', 'date'],
            'waktu' => ['required', 'string'],
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

        // Cek jika tim tuan rumah dan tamu sama
        if ($request->id_tim_tuan_rumah == $request->id_tim_tamu) {
            return $this->sendFailedResponse('Tim tuan rumah dan tamu harus berbeda', $__type);
        }

        // Cek jika terdapat tim dengan ID yang diberikan
        $tim_tuan_rumah = $this->tim->go_exists($request->id_tim_tuan_rumah);
        if (!$tim_tuan_rumah) {
            return $this->sendFailedResponse('Tim tuan rumah tidak ditemukan', $__type);
        }
        
        // Cek jika terdapat tim dengan ID yang diberikan
        $tim_tamu = $this->tim->go_exists($request->id_tim_tamu);
        if (!$tim_tamu) {
            return $this->sendFailedResponse('Tim tamu tidak ditemukan', $__type);
        }

        // Cek jika terdapat jadwal_pertandingan dengan ID yang diberikan
        $jadwal_pertandingan = $this->jadwal_pertandingan->go_exists($id);
        if (!$jadwal_pertandingan) {
            return $this->sendFailedResponse('Jadwal pertandingan tidak ditemukan', $__type);
        }

        // Eksekusi query dari JadwalPertandingan "go_update" models
        $data = $this->jadwal_pertandingan->go_update($request, $id);

        // Cek jika query berhasil dilakukan
        if ($data) {
            return $this->sendSuccessResponse($data, $__type);
        }
        return $this->sendFailedResponse($data, $__type);
    }

    public function delete($id)
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'jadwal_pertandingan_delete';

        // Cek jika id yang dikirim bukan bilangan bulat
        if (!is_numeric($id)) {
            return $this->sendValidationFailedResponse('ID harus bilangan bulat', $__type);
        }

        // Cek jika data dengan id yang dikirim terdapat pada tabel
        if (JadwalPertandingan::where('id', $id)->exists()) {

            // Eksekusi query dari JadwalPertandingan "create" models
            $data = $this->jadwal_pertandingan->go_delete($id);

            // Cek jika query berhasil dilakukan
            if ($data) {
                return $this->sendSuccessResponse($data, $__type);
            }
            return $this->sendFailedResponse($data, $__type);
        }
        return $this->sendFailedResponse('Data tidak ditemukan', $__type);
    }
}
