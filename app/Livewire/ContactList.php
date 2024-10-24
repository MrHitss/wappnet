<?php

namespace App\Livewire;

use App\Models\Contacts;
use App\Models\Tags;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class ContactList extends Component
{
    public $includedTags = [];
    public $excludedTags = [];
    public $searchQuery = '';
    public $perPage = 10;
    public $hasMorePagesCheck = true;
    public $selectedContactId;
    public $selectedTags = [];
    public $allTags;
    public $defaultImage;

    public function mount()
    {
        $this->allTags = Tags::all(); 
        $this->defaultImage = "https://via.placeholder.com/50";
    }

    public function toggleIncludedTag($tagId)
    {
        if (in_array($tagId, $this->includedTags)) {
            $this->includedTags = array_diff($this->includedTags, [$tagId]);
        } else {
            $this->includedTags[] = $tagId;
            $this->excludedTags = array_diff($this->excludedTags, [$tagId]); // Remove from excluded if added to included
        }
    }

    public function toggleExcludedTag($tagId)
    {
        if (in_array($tagId, $this->excludedTags)) {
            $this->excludedTags = array_diff($this->excludedTags, [$tagId]);
        } else {
            $this->excludedTags[] = $tagId;
            $this->includedTags = array_diff($this->includedTags, [$tagId]); // Remove from included if added to excluded
        }
    }

    public function setSelectedContact($contactId)
    {
        $this->selectedContactId = $contactId;
    }

    public function assignTags()
    {
        $contact = Contacts::find($this->selectedContactId);
        $contact->tags()->sync($this->selectedTags);
    }

    #[On('loadMore')]
    public function loadMore()
    {
        if ($this->hasMorePagesCheck) {
            $this->perPage += 10;
        }
    }

    public function render()
    {
        $paginatedContacts = Contacts::with('tags')
            ->when($this->includedTags, function ($query) {
                $query->whereHas('tags', fn($q) => $q->whereIn('tags.id', $this->includedTags));
            })
            ->when($this->excludedTags, function ($query) {
                $query->whereDoesntHave('tags', fn($q) => $q->whereIn('tags.id', $this->excludedTags));
            })
            ->when($this->searchQuery, function ($query) {
                $query->where('name', 'like', '%' . $this->searchQuery . '%')
                      ->orWhere('mobile_number', 'like', '%' . $this->searchQuery . '%');
            })
            ->orderBy('name')
            ->paginate($this->perPage); 

        $this->hasMorePagesCheck = $paginatedContacts->hasMorePages() ?? false;

        $filteredContacts = $paginatedContacts->getCollection()
            ->groupBy(fn($contact) => strtoupper(substr($contact->name, 0, 1)));

        return view('livewire.contact-list', [
            'filteredContacts' => $filteredContacts,
            'totalContacts' => Contacts::count(),
            'includedTagsList' => $this->allTags,
            'excludedTagsList' => $this->allTags,
        ]);
    }
    public function removeTag($contactId, $tagId)
    {
        $contact = Contacts::find($contactId);
        $contact->tags()->detach($tagId);
    }

}
