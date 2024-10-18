<?php

namespace App\Models;

use CodeIgniter\Model;

class RiderModel extends Model
{
    protected $table = 'rider';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['first_name', 'last_name', 'country', 'date_of_birth', 'weight', 'height', 'link', 'place_link', 'in_results'];
}