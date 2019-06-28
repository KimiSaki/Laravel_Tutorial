<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WorkControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    // public function testExample()
    // {
    //     $this->assertTrue(true);
    // }

    /**
     * test code for index method.
     *
     * @return void
     */
    public function testIndex(){
        $this->visit('/works')
            ->see('作品一覧');
    }

    public function testCreate(){
        $this->visit('/works')
            ->click('作品を投稿')
            ->seePageIs('/works/create')
            ->see('作品名')
            ->click('戻る')
            ->seePageIs('/works');

    }

    public function testEdit(){
        
    }

}
