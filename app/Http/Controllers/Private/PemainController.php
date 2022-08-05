<?php

namespace App\Http\Controllers\Private;
use App\Http\Controllers\Controller;
use App\Models\Pemain;
use App\Models\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PemainController extends Controller
{
    // Link to "Pemain" models
    public function __construct() {
        $this->pemain = new Pemain();
        $this->tim = new Tim();
    }

    public function list()
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'pemain_list';

        // Eksekusi query dari Pemain "list" models
        $data = $this->pemain->go_list();

        // Cek jika terdapat data pada hasil query
        if ($data->total() > 0) {
            return $this->sendSuccessResponse($data, $__type);
        }
        return $this->sendFailedResponse('Data tidak ditemukan', $__type);
    }

    public function create(Request $request)
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'pemain_create';

        // Cek apakah bentuk data yang dikirim telah sesuai
        $validator = Validator::make($request->all(), [
            'id_tim' => ['required', 'min:1', 'numeric'],
            'nama' => ['required', 'min:6', 'string'],
            'tinggi_badan' => ['required', 'min:1', 'numeric'],
            'berat_badan' => ['required', 'min:1', 'numeric'],
            'posisi_pemain' => ['required', 'min:1', 'max:4', 'numeric'],
            'nomor_punggung' => ['required', 'min:1', 'max:1000', 'numeric'],
        ]);

        // Jika data yang dikirim tidak sesuai, maka kembalikan code 422 
        if ($validator->fails()) {
            return $this->sendValidationFailedResponse(
                $validator->messages(), 
                $__type
            );
        }

        // Cek jika terdapat tim dengan ID yang diberikan
        $tim = $this->tim->go_exists($request->id_tim);
        if (!$tim) {
            return $this->sendFailedResponse('Tim tidak ditemukan', $__type);
        }

        // Cek jika terdapat pemain dengan nomor punggung yang sama dalam 1 tim
        $nomor_punggung = $this->pemain->go_nomor_punggung_exists($request->id_tim, $request->nomor_punggung);
        if ($nomor_punggung) {
            return $this->sendFailedResponse('Nomor punggung '. $request->nomor_punggung .' sudah digunakan', $__type);
        }

        // Eksekusi query dari Pemain "create" models
        $data = $this->pemain->go_create($request);

        // Cek jika query berhasil dilakukan
        if ($data) {
            return $this->sendSuccessResponse($data, $__type);
        }
        return $this->sendFailedResponse($data, $__type);
    }

    public function update(Request $request, $id)
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'pemain_update';

        // Cek apakah bentuk data yang dikirim telah sesuai
        $validator = Validator::make($request->all(), [
            'id_tim' => ['required', 'min:1', 'numeric'],
            'nama' => ['required', 'min:6', 'string'],
            'tinggi_badan' => ['required', 'min:1', 'numeric'],
            'berat_badan' => ['required', 'min:1', 'numeric'],
            'posisi_pemain' => ['required', 'min:1', 'max:4', 'numeric'],
            'nomor_punggung' => ['required', 'min:1', 'max:1000', 'numeric'],
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

        // Cek jika terdapat perusahaan dengan ID yang diberikan
        $tim = $this->tim->go_exists($request->id_tim);
        if (!$tim) {
            return $this->sendFailedResponse('Tim tidak ditemukan', $__type);
        }

        // Cek jika terdapat pemain dengan ID yang diberikan
        $pemain = $this->pemain->go_exists($id);
        if (!$pemain) {
            return $this->sendFailedResponse('Pemain tidak ditemukan', $__type);
        }

        $pemain = $this->pemain->go_detail($id);

        // Cek jika terdapat pemain dengan nomor punggung yang sama dalam 1 tim
        $nomor_punggung = $this->pemain->go_nomor_punggung_exists($request->id_tim, $request->nomor_punggung, $pemain->nomor_punggung, $request->id);
        if ($nomor_punggung) {
            return $this->sendFailedResponse('Nomor punggung '. $request->nomor_punggung .' sudah digunakan' , $__type);
        }

        // Eksekusi query dari Pemain "go_update" models
        $data = $this->pemain->go_update($request, $id);

        // Cek jika query berhasil dilakukan
        if ($data) {
            return $this->sendSuccessResponse($data, $__type);
        }
        return $this->sendFailedResponse($data, $__type);
    }

    public function delete($id)
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'pemain_delete';

        // Cek jika id yang dikirim bukan bilangan bulat
        if (!is_numeric($id)) {
            return $this->sendValidationFailedResponse('ID harus bilangan bulat', $__type);
        }

        // Cek jika data dengan id yang dikirim terdapat pada tabel
        if (Pemain::where('id', $id)->exists()) {

            // Eksekusi query dari Pemain "create" models
            $data = $this->pemain->go_delete($id);

            // Cek jika query berhasil dilakukan
            if ($data) {
                return $this->sendSuccessResponse($data, $__type);
            }
            return $this->sendFailedResponse($data, $__type);
        }
        return $this->sendFailedResponse('Data tidak ditemukan', $__type);
    }
}
