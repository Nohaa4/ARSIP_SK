<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramModel extends Model
{
    protected $table = 'tbl_program';
    protected $primaryKey = 'id_program';

    protected $allowedFields = [
        'nama_program',
        'keterangan',
        'status'
    ];

    protected $useTimestamps = true;
}