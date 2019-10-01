<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Students;

class StudentsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_students()
    {
        $students = factory(Students::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/students', $students
        );

        $this->assertApiResponse($students);
    }

    /**
     * @test
     */
    public function test_read_students()
    {
        $students = factory(Students::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/students/'.$students->id
        );

        $this->assertApiResponse($students->toArray());
    }

    /**
     * @test
     */
    public function test_update_students()
    {
        $students = factory(Students::class)->create();
        $editedStudents = factory(Students::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/students/'.$students->id,
            $editedStudents
        );

        $this->assertApiResponse($editedStudents);
    }

    /**
     * @test
     */
    public function test_delete_students()
    {
        $students = factory(Students::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/students/'.$students->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/students/'.$students->id
        );

        $this->response->assertStatus(404);
    }
}
