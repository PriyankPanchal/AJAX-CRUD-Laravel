<?php

namespace App\Http\Controllers;

use App\DataTables\StudentsDataTable;
use App\Http\Requests\CreateStudentsRequest;
use App\Http\Requests\UpdateStudentsRequest;
use App\Repositories\StudentsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Yajra\DataTables\DataTables;

class StudentsController extends Controller
{
    /** @var  StudentsRepository */
    private $studentsRepository;
    private $data1;

    public function __construct(StudentsRepository $studentsRepo, StudentsDataTable $data)
    {
        session_start();
        $this->middleware('auth');
        $this->data1 = $data;
        $this->studentsRepository = $studentsRepo;
    }

    /**
     * Display a listing of the Students.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $students = $this->studentsRepository->all();

        if ($request->ajax()) {
            return Datatables::of($this->data1->all($request))->make(true);
        }
        return view('students.index');
        /*return view('students.index')
            ->with('students', $students);*/
    }

    /**
     * Show the form for creating a new Students.
     *
     * @return Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created Students in storage.
     *
     * @param CreateStudentsRequest $request
     *
     * @return Response
     */
    public function store(CreateStudentsRequest $request)
    {
        $input = $request->all();

        if ($input['profile_image'] != null) {
            $image = $input['profile_image'];
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/profile_image');
            $image->move($destinationPath, $name);
            $input['profile_image'] = $name;
        }
        $students = $this->studentsRepository->create($input);

        Flash::success('Students saved successfully.');

        return redirect(route('students.index'));
    }

    /**
     * Display the specified Students.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $students = $this->studentsRepository->find($id);

        if (empty($students)) {
            Flash::error('Students not found');

            return redirect(route('students.index'));
        }

        return view('students.show')->with('students', $students);
    }

    /**
     * Show the form for editing the specified Students.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $students = $this->studentsRepository->find($id);
        if (empty($students)) {
            Flash::error('Students not found');

            return redirect(route('students.index'));
        }
        return response::json(array('data' => ['students' => $students]));
//        return view('students.edit')->with('students', $students);
    }

    /**
     * Update the specified Students in storage.
     *
     * @param int $id
     * @param UpdateStudentsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStudentsRequest $request)
    {
        $input = $request->all();
        $students = $this->studentsRepository->find($id);

        if (empty($students)) {
            Flash::error('Students not found');

            return redirect(route('students.index'));
        }

        if ($input['profile_image'] != null) {
            $image = $input['profile_image'];
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/profile_image');
            $image->move($destinationPath, $name);
            $input['profile_image'] = $name;
        }

        $students = $this->studentsRepository->update($input, $id);

        Flash::success('Students updated successfully.');

        return redirect(route('students.index'));
    }

    /**
     * Remove the specified Students from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $students = $this->studentsRepository->find($id);

        if (empty($students)) {
            Flash::error('Students not found');

            return redirect(route('students.index'));
        }

        $this->studentsRepository->delete($id);

        Flash::success('Students deleted successfully.');

        return redirect(route('students.index'));
    }
}
