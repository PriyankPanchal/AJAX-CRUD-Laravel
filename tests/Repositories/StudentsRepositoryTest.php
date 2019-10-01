<?php namespace Tests\Repositories;

use App\Models\Students;
use App\Repositories\StudentsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StudentsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StudentsRepository
     */
    protected $studentsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->studentsRepo = \App::make(StudentsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_students()
    {
        $students = factory(Students::class)->make()->toArray();

        $createdStudents = $this->studentsRepo->create($students);

        $createdStudents = $createdStudents->toArray();
        $this->assertArrayHasKey('id', $createdStudents);
        $this->assertNotNull($createdStudents['id'], 'Created Students must have id specified');
        $this->assertNotNull(Students::find($createdStudents['id']), 'Students with given id must be in DB');
        $this->assertModelData($students, $createdStudents);
    }

    /**
     * @test read
     */
    public function test_read_students()
    {
        $students = factory(Students::class)->create();

        $dbStudents = $this->studentsRepo->find($students->id);

        $dbStudents = $dbStudents->toArray();
        $this->assertModelData($students->toArray(), $dbStudents);
    }

    /**
     * @test update
     */
    public function test_update_students()
    {
        $students = factory(Students::class)->create();
        $fakeStudents = factory(Students::class)->make()->toArray();

        $updatedStudents = $this->studentsRepo->update($fakeStudents, $students->id);

        $this->assertModelData($fakeStudents, $updatedStudents->toArray());
        $dbStudents = $this->studentsRepo->find($students->id);
        $this->assertModelData($fakeStudents, $dbStudents->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_students()
    {
        $students = factory(Students::class)->create();

        $resp = $this->studentsRepo->delete($students->id);

        $this->assertTrue($resp);
        $this->assertNull(Students::find($students->id), 'Students should not exist in DB');
    }
}
