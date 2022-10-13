<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $db = db_connect();
        $data['mahasiswa'] = $db->table('tb_mahasiswa')->get()->getResult();
        return view('welcome_message', $data);
    }

    public function save()
    {
        $db = db_connect();

        $nobp = $this->request->getPost('nobp');

        $cekNobp = $db->table('tb_mahasiswa')->where('nobp', $nobp)->get()->getNumRows();

        if($cekNobp > 0){
            echo "<script>
                    alert('Nobp Sudah Ada');
                    window.location='/';
                  </script>";
        }else{
            $data = [
                'nobp' => $this->request->getPost('nobp'),
                'nama' => $this->request->getPost('nama'),
                'alamat' => $this->request->getPost('alamat'),
            ];
        }

        $simpan = $db->table('tb_mahasiswa')->insert($data);

        if($simpan == true){
            echo "<script>
                    alert('Data Berhasil Disimpan');
                    window.location='/';
                  </script>";
        }else{
            echo "<script>
                    alert('Data Gagal Disimpan');
                    window.location='/';
                  </script>";
        }
    }
}
