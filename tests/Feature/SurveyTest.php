<?php

namespace Tests\Feature;

use App\Survey;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SurveyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @param App\User
     */
    protected $user;

    /**
     * Visit the survey page.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        if (is_null($this->user)) {
          $this->user = factory(User::class)->create();
        }

        \Auth::login($this->user);
    }

    /**
     * Visit the survey page.
     *
     * @return void
     */
    public function testSurveyPage()
    {
        $response = $this->get('/surveys/create');

        $response->assertSuccessful()->assertViewIs('survey');
    }

    /**
     * Submit a survey.
     *
     * @return void
     */
    public function testSurveySubmission()
    {
        $requestParams = [
            'question1' => 1,
            'question2' => 5,
            'question2' => 9,
            'question4' => 13,
        ];

        $response = $this->post('/surveys', $requestParams);

        $response->assertRedirect('/surveys');

        $this->assertDatabaseHas('surveys', [
            'user_id' => $this->user->id
        ]);
    }

    /**
     * Visit the results page as a new user without a completed survey.
     *
     * @return void
     */
    public function testSurveyResultsPageAsANewUser()
    {
        $response = $this->get('/surveys');

        $response->assertRedirect('/surveys/create');
    }

    /**
     * Visit the results page as a user with a completed survey.
     *
     * @return void
     */
    public function testSurveyResultsPage()
    {
        $this->user->surveys()->save(factory(Survey::class)->make());

        $response = $this->get('/surveys');

        $response->assertSuccessful()->assertViewIs('dashboard');
    }
}
