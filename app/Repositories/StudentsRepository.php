<?php

namespace App\Repositories;

use App\Models\Students;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class StudentsRepository
 * @package App\Repositories
 * @version October 1, 2019, 6:10 am UTC
 */
class StudentsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'contact_number',
        'profile_image'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Students::class;
    }
}
