<?php

namespace App\Controllers;

use App\Models\Mkontak;
use CodeIgniter\RESTful\ResourceController;

class Kontak extends ResourceController
{
   protected $format = 'json';
   protected $modelName = 'use App\Models\Mkontak';

   public function __construct()
   {
      $this->mkontak = new Mkontak();
   }

   public function index()
   {
      $mkontak = $this->mkontak->getKontak();

      foreach ($mkontak as $row) {
         $mkontak_all[] = [
            'id' => intval($row['id']),
            'judul' => $row['judul'],
            'deskripsi' => $row['deskripsi'],
            'jadwal_selesai' => $row['jadwal_selesai'],
         ];
      }

      return $this->respond($mkontak_all, 200);
   }

   public function create()
   {
      $nama = $this->request->getPost('nama');
      $alamat = $this->request->getPost('alamat');
      $nomor_hp = $this->request->getPost('nomor_hp');

      $data = [
         'nama' => $nama,
         'alamat' => $alamat,
         'nomor_hp' => $nomor_hp
      ];

      $simpan = $this->mkontak->insertKontak($data);

      if ($simpan == true) {
         $output = [
            'status' => 200,
            'message' => 'Berhasil menyimpan data',
            'data' => ''
         ];
         return $this->respond($output, 200);
      } else {
         $output = [
            'status' => 400,
            'message' => 'Gagal menyimpan data',
            'data' => ''
         ];
         return $this->respond($output, 400);
      }
   }

   public function show($id = null)
   {
      $mkontak = $this->mkontak->getKontak($id);

      if (!empty($mkontak)) {
         $output = [
            'id' => intval($mkontak['id']),
            'nama' => $mkontak['nama'],
            'alamat' => $mkontak['alamat'],
            'nomor_hp' => $mkontak['nomor_hp'],
         ];

         return $this->respond($output, 200);
      } else {
         $output = [
            'status' => 400,
            'message' => 'Data tidak ditemukan',
            'data' => ''
         ];

         return $this->respond($output, 400);
      }
   }

   public function edit($id = null)
   {
      $mkontak = $this->mkontak->getKontak($id);

      if (!empty($mkontak)) {
         $output = [
            'id' => intval($mkontak['id']),
            'nama' => $mkontak['nama'],
            'alamat' => $mkontak['alamat'],
            'nomor_hp' => $mkontak['nomor_hp'],
         ];

         return $this->respond($output, 200);
      } else {
         $output = [
            'status' => 400,
            'message' => 'Data tidak ditemukan',
            'data' => ''
         ];
         return $this->respond($output, 400);
      }
   }

   public function update($id = null)
   {
      // menangkap data dari method PUT, DELETE
      $data = $this->request->getRawInput();

      // cek data berdasarkan id
      $mkontak = $this->mkontak->getKontak($id);

      //cek todo
      if (!empty($mkontak)) {
         // update data
         $updateKontak = $this->mkontak->updateKontak($data, $id);

         $output = [
            'status' => true,
            'data' => '',
            'message' => 'sukses melakukan update'
         ];

         return $this->respond($output, 200);
      } else {
         $output = [
            'status' => false,
            'data' => '',
            'message' => 'gagal melakukan update'
         ];

         return $this->respond($output, 400);
      }
   }

   public function delete($id = null)
   {
    $data = $this->request->getRawInput();

    // cek data berdasarkan id
        $mkontak = $this->mkontak->getKontak($id);
      //cek todo
      if (!empty($mkontak)) {
         // delete data
         $deleteKontak = $this->mkontak->deleteKontak($id);

         $output = [
            'status' => true,
            'data' => '',
            'message' => 'sukses hapus data'
         ];
         return $this->respond($output, 200);
      } else {
         $output = [
            'status' => false,
            'data' => '',
            'message' => 'gagal hapus data'
         ];
         return $this->respond($output, 400);
      }
   }
}