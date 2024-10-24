<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Contacts;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_new_contact()
    {
        $contact = Contacts::factory()->create([
            'name' => 'John Doe',
            'mobile_number' => '1234567890',
        ]);

        $this->assertDatabaseHas('contacts', [
            'name' => 'John Doe',
        ]);
    }
}
