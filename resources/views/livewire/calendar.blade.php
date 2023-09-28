<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="#">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
            <li class="breadcrumb-item active" aria-current="page">Calendar</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Calendar</h1>
            <p class="mb-0">Dozens of reusable components built to provide buttons, alerts, popovers, and more.</p>
        </div>
        <div>
            <a href="https://themesberg.com/docs/volt-bootstrap-5-dashboard/plugins/calendar/" class="btn btn-outline-gray-600 d-inline-flex align-items-center">
                <svg class="icon icon-xs me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                Calendar Docs
            </a>
        </div>
    </div>
</div>

<div class="card border-0 shadow">
    <div id="calendar" class="p-4"></div>
</div>


<!-- Add event modal -->
<div class="modal fade" id="modal-new-event" tabindex="-1" role="dialog" aria-labelledby="modal-new-event" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="addNewEventForm" class="modal-content">
            <div class="modal-body">
                <div class="mb-4">
                    <label for="eventTitle">Event title</label>
                    <input type="text" class="form-control" id="eventTitle" required>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="mb-4">
                            <label for="dateStart">Select start date</label>
                            <div class="input-group">
                            <span class="input-group-text">
                                <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                            </span>
                                <input data-datepicker="" class="form-control" id="dateStart" type="text" placeholder="dd/mm/yyyy" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="mb-2">
                            <label for="dateEnd">Select end date</label>
                            <div class="input-group">
                            <span class="input-group-text">
                                <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                            </span>
                                <input data-datepicker="" class="form-control" id="dateEnd" type="text" placeholder="dd/mm/yyyy" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-gray-800" id="addNewEvent">Add new event</button>
                <button type="button" class="btn btn-gray-300 ms-auto" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit event modal -->
<div class="modal fade" id="modal-edit-event" tabindex="-1" role="dialog" aria-labelledby="modal-edit-event" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="editEventForm" class="modal-content">
            <div class="modal-body">
                <div class="mb-4">
                    <label for="eventTitleEdit">Event title</label>
                    <input type="text" class="form-control" id="eventTitleEdit" required>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="">
                            <label for="dateStartEdit">Select start date</label>
                            <div class="input-group">
                            <span class="input-group-text">
                                <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                            </span>
                                <input data-datepicker="" class="form-control" id="dateStartEdit" type="text" placeholder="dd/mm/yyyy" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="mb-2">
                            <label for="dateEndEdit">Select end date</label>
                            <div class="input-group">
                            <span class="input-group-text">
                                <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                            </span>
                                <input data-datepicker="" class="form-control" id="dateEndEdit" type="text" placeholder="dd/mm/yyyy" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-gray-800 me-2" id="editEvent">Update event</button>
                <button type="submit" class="btn btn-danger" id="deleteEvent">Delete event</button>
                <button type="button" class="btn btn-link text-gray ms-auto" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
