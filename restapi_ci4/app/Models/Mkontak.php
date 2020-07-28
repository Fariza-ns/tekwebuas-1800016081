<?php

namespace App\Models;

use CodeIgniter\Model;

class Mkontak extends Model
{
   protected $table = 'kontak';

   public function getKontak($id = false)
   {
      if ($id === false) {
         return $this->findAll();
      } else {
         return $this->getWhere(['id' => $id])->getRowArray();
      }
   }

   public function insertKontak($data)
   {
      $query = $this->db->table($this->table)->insert($data);
      if ($query) {
         return true;
      } else {
         return false;
      }
   }

   public function updateKontak($data, $id)
   {
      return $this->db->table($this->table)->update($data, ['id' => $id]);
   }

   public function deleteKontak($id)
   {
      return $this->db->table($this->table)->delete(['id' => $id]);
   }
}