<div class="row" 
>
    <div class="col-4">
        <div class="card my-4">
            <div class="card-header">
                <h5 class="mb-0">Tags</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <h6>Included Tags</h6>
                    <div class="row" style="max-height:300px; overflow: scroll">
                        <ul class="list-group mb-2" >
                            @foreach ($includedTagsList as $tag)
                                <li class="list-group-item d-flex justify-content-between align-items-center" wire:click="toggleIncludedTag({{ $tag->id }})">
                                    {{ $tag->name }}
                                    @if (in_array($tag->id, $includedTags))
                                        <span class="p-1">
                                            <i class="fa fa-check text-success" style="font-size: 12px"></i>
                                        </span>
                                    @endif
                                    
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <h6>Excluded Tags</h6>
                    <div class="row" style="max-height:300px; overflow: scroll">
                        <ul class="list-group mb-2" >
                            @foreach ($excludedTagsList as $tag)
                                <li class="list-group-item d-flex justify-content-between align-items-center" wire:click="toggleExcludedTag({{ $tag->id }})">
                                    {{ $tag->name }}
                                    @if (in_array($tag->id, $excludedTags))
                                        <span class="p-1" >
                                            <i class="fa fa-check text-success" style="font-size: 12px"></i>
                                        </span>
                                    @endif
                                    
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card my-4">
        <div class="card-header">
                <h5 class="mb-0">All Contacts({{ $totalContacts }}) </h5>
                <div class="input-group input-group-outline my-3">
                    <input type="text" 
                        class="form-control w-50" 
                        placeholder="Search Contacts..." 
                       wire:model.live.debounce.500ms="searchQuery">
                </div>
                
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0" style="max-height: 600px; overflow:auto;"
                x-data="{ loading: false }"
     x-init="
        $el.addEventListener('scroll', () => {
            if ($el.scrollTop + $el.clientHeight >= $el.scrollHeight && !loading) {
                loading = true;
                Livewire.dispatch('loadMore');
            }
        });

        Livewire.hook('message.processed', () => {
            loading = false; // Reset loading after processing
        });
     ">
                    <table class="table align-items-center justify-content-center mb-0" >
    
                        <tbody>
                            @foreach ($filteredContacts as $letter => $group)
                                <tr>
                                    <td colspan="3" class="text-uppercase text-primary fw-bold">{{ $letter }}</td>
                                </tr>
                                @foreach ($group as $contact)
                                    <tr colspan="3">
                                        <td class="align-middle">
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ $contact->image ?? $defaultImage }}" 
                                                        class="avatar avatar-sm me-3 border-radius-lg" 
                                                        alt="{{ $contact->name }}">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $contact->name }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $contact->mobile_number }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            
                                            <div class="d-flex flex-wrap ">
                                                @foreach ($contact->tags as $tag)
                                                    <span class="badge bg-success text-white m-1" style="max-height: fit-content;">
                                                        {{ $tag->name }}
                                                        <button class="btn btn-sm btn-link text-white ms-1 mb-1 p-0 m-0" 
                                                                wire:click="removeTag({{ $contact->id }}, {{ $tag->id }})">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0" 
                                                    wire:click="setSelectedContact({{ $contact->id }})" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#addTagModal">
                                                <i class="fa fa-plus-circle text-xs text-success fs-2" aria-hidden="true"></i>
                                            </button>
                                            
                                        </td>
                                    </tr>
                                    
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    @if ($hasMorePagesCheck)
                        <div class="text-center mt-3">
                            <button class="btn btn-primary" wire:click="loadMore">Load More</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addTagModal" tabindex="-1" aria-labelledby="addTagModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTagModalLabel">Assign Tags</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Select Tags:</h6>
                    <div class="input-group input-group-outline my-3">
                        <select class="form-select" multiple="multiple" wire:model.defer="selectedTags">
                            @foreach ($allTags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click="assignTags" data-bs-dismiss="modal">Assign Tags</button>
                </div>
            </div>
        </div>
    </div>
    
</div>

<!-- <script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('scrollPosition', false);

        window.addEventListener('scroll', () => {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight && 
                !Alpine.store('scrollPosition') && 
                @js($hasMorePagesCheck)) {
                console.log(@js($hasMorePagesCheck))
                Alpine.store('scrollPosition', true);
                Livewire.dispatch('loadMore');
            }
        });

        Livewire.hook('message.processed', () => {
            Alpine.store('scrollPosition', false);
        });
    });
     x-data x-init="
        $watch('$store.scrollPosition', value => {
            if (value) {
                Livewire.dispatch('loadMore');
                $store.scrollPosition = false; // Reset the scroll state after loading
            }
        });

        Livewire.hook('message.processed', () => {
            loading = false; // Reset loading after Livewire finishes
        });
     "
</script> -->