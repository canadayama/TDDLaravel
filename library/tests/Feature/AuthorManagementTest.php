<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase,
        WithFaker;
    /**
     * @test
     */
    public function an_author_can_be_created()
    {
        $response = $this->post('/authors', [
            'name' => $this->faker()->name,
            #'dob' => $this->faker()->date('m/d/Y'),
            'dob' => '05/14/1988'
        ]);
        $response->assertOk();

        $author = Author::all();
        print_r($author);
        
        $this->assertCount(1, $author);
        print_r($author->first()->dob);
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);
        $this->assertEquals('1988/14/05', $author->first()->dob->format('Y/d/m'));
    }
}
