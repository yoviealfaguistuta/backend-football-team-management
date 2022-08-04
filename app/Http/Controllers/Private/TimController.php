<?php

namespace App\Http\Controllers\Private;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tim;
use Illuminate\Support\Facades\Validator;

class TimController extends Controller
{
    // Link to "Tim" models
    public function __construct() {
        $this->Tim = new Tim;
    }

    public function list()
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'Tim_list';

        // Eksekusi query dari Tim "list" models
        $data = $this->Tim->go_list();

        // Cek jika terdapat data pada hasil query
        if ($data->total() > 0) {
            return $this->sendSuccessResponse($data, $__type);
        }
        return $this->sendFailedResponse('Data tidak ditemukan', $__type);
    }

    public function create(Request $request)
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'Tim_create';

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
        
        // Eksekusi query dari Tim "create" models
        $data = $this->Tim->go_create($request);

        // Cek jika query berhasil dilakukan
        if ($data) {
            return $this->sendSuccessResponse($data, $__type);
        }
        return $this->sendFailedResponse('err', $__type);
    }

    public function update(Request $request, $id)
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'Tim_update';

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
        if (Tim::where('id', $id)->exists()) {

            // Eksekusi query dari Tim "create" models
            $data = $this->Tim->go_update($request, $id);

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
        $__type = 'Tim_delete';

        // Cek jika id yang dikirim bukan bilangan bulat
        if (!is_numeric($id)) {
            return $this->sendValidationFailedResponse('ID harus bilangan bulat', $__type);
        }

        // Cek jika data dengan id yang dikirim terdapat pada tabel
        if (Tim::where('id', $id)->exists()) {

            // Eksekusi query dari Tim "create" models
            $data = $this->Tim->go_delete($id);

            // Cek jika query berhasil dilakukan
            if ($data) {
                return $this->sendSuccessResponse($data, $__type);
            }
            return $this->sendFailedResponse($data, $__type);
        }
        return $this->sendFailedResponse('Data tidak ditemukan', $__type);
    }
}
