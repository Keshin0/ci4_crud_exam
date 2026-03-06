<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * RecordModel
 * 
 * Handles all database operations for the records table.
 * Uses SOFT DELETE: Records are never permanently deleted, only marked with deleted_at timestamp.
 * This allows for data recovery and audit trails.
 */
class RecordModel extends Model
{
    protected $table            = 'records';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    // SOFT DELETE CONFIGURATION
    // When delete() is called, instead of removing the record, this sets the deleted_at timestamp
    // The model will automatically exclude soft-deleted records from queries
    protected $useSoftDeletes   = true;
    
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'description', 'status', 'user_id'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';  // Field used for soft deletes

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
