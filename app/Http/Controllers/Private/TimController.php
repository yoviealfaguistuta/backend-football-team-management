<?php

namespace App\Http\Controllers\Private;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tim;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Validator;

class TimController extends Controller
{
    // Link to "Tim" models
    public function __construct() {
        $this->tim = new Tim;
        $this->perusahaan = new Perusahaan;
    }

    public function list()
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'tim_list';

        // Eksekusi query dari Tim "list" models
        $data = $this->tim->go_list();

        // Cek jika terdapat data pada hasil query
        if ($data->total() > 0) {
            return $this->sendSuccessResponse($data, $__type);
        }
        return $this->sendFailedResponse('Data tidak ditemukan', $__type);
    }

    public function create(Request $request)
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'tim_create';

        // Cek apakah bentuk data yang dikirim telah sesuai
        $validator = Validator::make($request->all(), [
            'id_perusahaan' => ['required', 'min:1', 'numeric'],
            'nama' => ['required', 'min:6', 'string'],
            'logo' => ['required', 'mimes:jpeg,jpg,png', 'max:10000'],
            'tahun_berdiri' => ['required', 'integer', 'min:1500', 'max:'.(date('Y')+1), 'digits:4'],
            'alamat_markas_tim' => ['required', 'min:6', 'string'],
            'kota_markas_tim' => ['required', 'min:6', 'max:100', 'string'],
        ]);

        // Jika data yang dikirim tidak sesuai, maka kembalikan code 422 
        if ($validator->fails()) {
            return $this->sendValidationFailedResponse(
                $validator->messages(), 
                $__type
            );
        }

        // Cek jika terdapat perusahaan dengan ID yang diberikan
        $perusahaan = $this->perusahaan->go_exists($request->id_perusahaan);
        if (!$perusahaan) {
            return $this->sendFailedResponse('Perusahaan tidak ditemukan', $__type);
        }

        // Menyimpan gambar kedalam folder public dan mengambil nama file
        $request->logo = $this->uploadFile($request->logo, 'data');

        // Eksekusi query dari Tim "create" models
        $data = $this->tim->go_create($request);

        // Cek jika query berhasil dilakukan
        if ($data) {
            return $this->sendSuccessResponse($data, $__type);
        }
        return $this->sendFailedResponse($data, $__type);
    }

    public function update(Request $request, $id)
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'tim_update';

        // Cek apakah bentuk data yang dikirim telah sesuai
        $validator = Validator::make($request->all(), [
            'id_perusahaan' => ['required', 'min:1', 'numeric'],
            'nama' => ['required', 'min:6', 'string'],
            'logo' => ['required', 'mimes:jpeg,jpg,png', 'max:10000'],
            'tahun_berdiri' => ['required', 'integer', 'min:1500', 'max:'.(date('Y')+1), 'digits:4'],
            'alamat_markas_tim' => ['required', 'min:6', 'string'],
            'kota_markas_tim' => ['required', 'min:6', 'max:100', 'string'],
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
        $perusahaan = $this->perusahaan->go_exists($request->id_perusahaan);
        if (!$perusahaan) {
            return $this->sendFailedResponse('Perusahaan tidak ditemukan', $__type);
        }

        // Cek jika terdapat tim dengan ID yang diberikan
        $tim = $this->tim->go_exists($id);
        if (!$tim) {
            return $this->sendFailedResponse('Tim tidak ditemukan', $__type);
        }

        if ($request->hasFile('logo')) {
            // Menyimpan gambar kedalam folder public dan mengambil nama file
            $request->logo = $this->uploadFile($request->logo, 'data');

            // Eksekusi query dari Tim "go_get_old_logo" models untuk mengambil nama logo sebelumnya
            $old_name_logo = $this->tim->go_get_old_logo($id);
            
            // Menghapus logo yang lama dari folder public
            $this->deleteFile($old_name_logo);

            // Eksekusi query dari Tim "create" models
            $this->tim->go_update_logo($id, $request->logo);
        }

        // Eksekusi query dari Tim "go_update" models
        $data = $this->tim->go_update($request, $id);

        // Cek jika query berhasil dilakukan
        if ($data) {
            return $this->sendSuccessResponse($data, $__type);
        }
        return $this->sendFailedResponse($data, $__type);
    }

    public function delete($id)
    {
        // Mengirim nama fungsi untuk memudahkan dalam men debug
        $__type = 'tim_delete';

        // Cek jika id yang dikirim bukan bilangan bulat
        if (!is_numeric($id)) {
            return $this->sendValidationFailedResponse('ID harus bilangan bulat', $__type);
        }

        // Cek jika data dengan id yang dikirim terdapat pada tabel
        if (Tim::where('id', $id)->exists()) {

            // Eksekusi query dari Tim "create" models
            $data = $this->tim->go_delete($id);

            // Cek jika query berhasil dilakukan
            if ($data) {
                return $this->sendSuccessResponse($data, $__type);
            }
            return $this->sendFailedResponse($data, $__type);
        }
        return $this->sendFailedResponse('Data tidak ditemukan', $__type);
    }
}
