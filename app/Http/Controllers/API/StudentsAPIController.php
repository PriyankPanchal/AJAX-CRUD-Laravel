<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStudentsAPIRequest;
use App\Http\Requests\API\UpdateStudentsAPIRequest;
use App\Models\Students;
use App\Repositories\StudentsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class StudentsController
 * @package App\Http\Controllers\API
 */

class StudentsAPIController extends AppBaseController
{
    /** @var  StudentsRepository */
    private $studentsRepository;

    public function __construct(StudentsRepository $studentsRepo)
    {
        $this->studentsRepository = $studentsRepo;
    }

    /**
     * Display a listing of the Students.
     * GET|HEAD /students
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $students = $this->studentsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($students->toArray(), 'Students retrieved successfully');
    }

    /**
     * Store a newly created Students in storage.
     * POST /students
     *
     * @param CreateStudentsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateStudentsAPIRequest $request)
    {
        $input = $request->all();

        $students = $this->studentsRepository->create($input);

        return $this->sendResponse($students->toArray(), 'Students saved successfully');
    }

    /**
     * Display the specified Students.
     * GET|HEAD /students/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Students $students */
        $students = $this->studentsRepository->find($id);

        if (empty($students)) {
            return $this->sendError('Students not found');
        }

        return $this->sendResponse($students->toArray(), 'Students retrieved successfully');
    }

    /**
     * Update the specified Students in storage.
     * PUT/PATCH /students/{id}
     *
     * @param int $id
     * @param UpdateStudentsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStudentsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Students $students */
        $students = $this->studentsRepository->find($id);

        if (empty($students)) {
            return $this->sendError('Students not found');
        }

        $students = $this->studentsRepository->update($input, $id);

        return $this->sendResponse($students->toArray(), 'Students updated successfully');
    }

    /**
     * Remove the specified Students from storage.
     * DELETE /students/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Students $students */
        $students = $this->studentsRepository->find($id);

        if (empty($students)) {
            return $this->sendError('Students not found');
        }

        $students->delete();

        return $this->sendResponse($id, 'Students deleted successfully');
    }
}
