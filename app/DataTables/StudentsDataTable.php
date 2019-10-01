<?php

/**
 * Created by PhpStorm.
 * User: c100-26
 * Date: 22/07/19
 * Time: 11:26 AM
 */

namespace App\DataTables;

use App\Models\Students;

class StudentsDataTable
{
    public function all($request)
    {
        return Students::get();
    }
}
