<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Contacts;
use App\Models\Tags;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactFilterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_filters_contacts_by_included_tags()
    {
        $tag = Tags::factory()->create(['name' => 'VIP']);
        $contact = Contacts::factory()->create();
        $contact->tags()->attach($tag->id);

        $contacts = Contacts::whereHas('tags', function ($query) use ($tag) {
            $query->where('tags.id', $tag->id);
        })->get();

        $this->assertCount(1, $contacts);
        $this->assertTrue($contacts->first()->is($contact));
    }
}
