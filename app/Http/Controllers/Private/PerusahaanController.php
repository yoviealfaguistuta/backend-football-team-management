<?php

namespace App\Http\Controllers\Private;
use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PerusahaanController extends Controller
{
    // Link to "Perusahaan" models
    public function __construct() {
        $this->perusahaan = new Perusahaan;
    }

    public function list()
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'perusahaan_list';

        // Eksekusi query dari Perusahaan "list" models
        $data = $this->perusahaan->go_list();

        // Cek jika terdapat data pada hasil query
        if ($data->total() > 0) {
            return $this->sendSuccessResponse($data, $__type);
        }
        return $this->sendFailedResponse('Data tidak ditemukan', $__type);
    }

    public function create(Request $request)
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'perusahaan_create';

        // Cek apakah bentuk data yang dikirim telah sesuai
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'min:6', 'string'],
        ]);

        // Jika data yang dikirim tidak sesuai, maka kembalikan code 422 
        if ($validator->fails()) {
            return $this->sendValidationFailedResponse(
                $validator->messages(), 
                $__type
            );
        }
        
        // Eksekusi query dari Perusahaan "create" models
        $data = $this->perusahaan->go_create($request);

        // Cek jika query berhasil dilakukan
        if ($data) {
            return $this->sendSuccessResponse($data, $__type);
        }
        return $this->sendFailedResponse('err', $__type);
    }

    public function update(Request $request, $id)
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'perusahaan_update';

        // Cek apakah bentuk data yang dikirim telah sesuai
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'min:6', 'string'],
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

        // Cek jika data dengan id yang dikirim terdapat pada tabel
        if (Perusahaan::where('id', $id)->exists()) {

            // Eksekusi query dari Perusahaan "create" models
            $data = $this->perusahaan->go_update($request, $id);

            // Cek jika query berhasil dilakukan
            if ($data) {
                return $this->sendSuccessResponse($data, $__type);
            }
            return $this->sendFailedResponse($data, $__type);
        }
        return $this->sendFailedResponse('Data tidak ditemukan', $__type);
    }

    public function delete($id)
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'perusahaan_delete';

        // Cek jika id yang dikirim bukan bilangan bulat
        if (!is_numeric($id)) {
            return $this->sendValidationFailedResponse('ID harus bilangan bulat', $__type);
        }

        // Cek jika data dengan id yang dikirim terdapat pada tabel
        if (Perusahaan::where('id', $id)->exists()) {

            // Eksekusi query dari Perusahaan "create" models
            $data = $this->perusahaan->go_delete($id);

            // Cek jika query berhasil dilakukan
            if ($data) {
                return $this->sendSuccessResponse($data, $__type);
            }
            return $this->sendFailedResponse($data, $__type);
        }
        return $this->sendFailedResponse('Data tidak ditemukan', $__type);
    }
}
