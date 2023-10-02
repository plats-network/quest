<title>{{ env('APP_NAME', 'Plats') }} Dashboard - New Item</title>
<div>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item">
                            <a href="#">
                                <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add item</li>
                    </ol>
                </nav>
                <h2 class="h4">Add item</h2>
                <p class="mb-0">Your item creation template.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xl-8">
                <div class="card card-body shadow-sm mb-4">
                    <h2 class="h5 mb-4">Item information</h2>
                    <form wire:submit.prevent="add" action="#" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div>
                                    <label for="name">Name</label>
                                    <input wire:model="name" class="form-control "
                                           id="name" type="text" placeholder="Enter the item's name" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="category">@lang('Category') </label>
                                <select wire:model="category_id"
                                        class="form-select mb-0 " id="category"
                                        aria-label="category select example">
                                    <option selected>Choose...</option>
                                    <option value="1">Fashion</option>
                                    <option value="2">Food</option>
                                    <option value="3">Health</option>
                                    <option value="4">Home</option>
                                    <option value="5">Travel</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="excerpt">Excerpt</label>
                                    <textarea wire:model="excerpt"
                                              class="form-control " id="excerpt"
                                              type="text" placeholder="Excerpt" style="height: 142px;">
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="">Item Description</label>
                                    <div wire:ignore>
                                        <div style="height: 100px;" x-data x-ref="quill" x-init="
                                                quill = new Quill($refs.quill, {modules: {toolbar: [['bold', 'italic', 'underline', 'strike', 'link'], [{ 'header': [1, 2, 3, 4, 5, 6, false] }]],} , theme: 'snow'});
                                                quill.on('text-change', function () {
                                                    $dispatch('quill-text-change', quill.root.innerHTML);
                                                });
                                                "
                                             x-on:quill-text-change.debounce.2000ms="window.livewire.find('B8Jcw9Ql2UgNUOf5sDct').set('description', $event.detail)">

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <div wire:ignore class="">
                                        <div x-data x-init="() => {
	var choices = new Choices($refs.tags, {
		itemSelectText: '',
		removeItems: true,
	    removeItemButton: true,
	});
	choices.passedElement.element.addEventListener(
	  'change',
	  function(event) {
	  		values = getSelectValues($refs.tags);
		    window.livewire.find('B8Jcw9Ql2UgNUOf5sDct').set('tag_id', values);
	  },
	  false,
	);
	items = [];
	if(Array.isArray(items)){
		items.forEach(function(select) {
			choices.setChoiceByValue((select).toString());
		});
	}
	}
	function getSelectValues(select) {
	  var result = [];
	  var options = select && select.options;
	  var opt;
	  for (var i=0, iLen=options.length; i<iLen; i++) {
	    opt = options[i];
	    if (opt.selected) {
	      result.push(opt.value || opt.text);
	    }
	  }
	  return result;
	}
	">
                                            <select id="tags" wire-model="tag_id"
                                                    wire:change="" x-ref="tags" multiple="multiple">
                                                <option value="1">Hot</option>
                                                <option value="2">Trending</option>
                                                <option value="3">New</option>
                                            </select>
                                        </div>                                        </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="date">Date</label>
                                <div class="input-group">
                                        <span class="input-group-text">
                                            <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                    <input wire:model.lazy="date" class="form-control datepicker-input" id="datepicker"
                                           type="text" placeholder="YYYY-MM-DD" style="height: 46px;">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group mb-4">
                                <label class="form-control-label" for="input-role">Status</label>
                                <div class="input-group">
                                    <div class="custom-control custom-radio mb-3">
                                        <div>
                                            <input wire:model="status" class="form-check-input" type="radio" name="status" id="published"
                                                   value="Published">
                                            <label for="published">Published</label>
                                        </div>
                                        <div>
                                            <input wire:model="status" class="form-check-input" type="radio" name="status" id="draft"
                                                   value="Draft">
                                            <label for="draft">Draft</label>
                                        </div>
                                        <div>
                                            <input wire:model="status" class="form-check-input" type="radio" name="status" id="active"
                                                   value="Active">
                                            <label for="active">Active</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group mb-4">
                                <label class="form-control-label">Item Options</label>
                                <div class="custom-control custom-checkbox">
                                    <input wire:model="options" class="form-check-input" name="options[]"
                                           id="optionFirst" type="checkbox" value="1">
                                    <label for="optionFirst">First</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input wire:model="options" class="form-check-input" name="options[]"
                                           id="optionSecond" type="checkbox" value="2">
                                    <label for="optionSecond">Second</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input wire:model="options" class="form-check-input" name="options[]"
                                           id="optionThird" type="checkbox" value="3">
                                    <label for="optionThird">Third</label>
                                </div>
                            </div>
                            <div class="col-md-6 form-group mb-4">
                                <div class="form-check form-switch mt-3">
                                    <label class="form-check-label" for="showOnHomepage">Show on homepage</label>
                                    <input wire:model="showOnHomepage" class="form-check-input" type="checkbox"
                                           id="showOnHomepage">
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">Save All</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-xl-4">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card shadow border-0 p-0">
                            <img class="profile-cover rounded-top"
                                 src="/assets/img/profile-cover.jpg">
                            <div class="card-body pb-5">
                                <h2 class="h5 mb-4">Select item photo</h2>
                                <div class="me-3">
                                    <div class="file-field">
                                        <div class="d-flex justify-content-xl-center ms-xl-3">
                                            <div class="d-flex">
                                                    <span class="icon icon-md"><svg class="icon text-gray-500 me-2"
                                                                                    fill="currentColor" viewBox="0 0 20 20"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                  d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                                  clip-rule="evenodd"></path>
                                                        </svg>
                                                    </span>
                                                <input wire:model='upload' type="file" accept="image/*">
                                                <div class="d-md-block text-left">
                                                    <div class="fw-normal text-dark mb-1">Choose Image</div>
                                                    <div class="text-gray small">
                                                        JPG, GIF or PNG. Max size of 2MB</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            new Pikaday({ field: document.getElementById('datepicker'), format:'YYYY-MM-DD' });
        </script>
    </div>
</div>
</div>
