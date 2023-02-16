<div>
    <div class="row mb-5">
        <div class="col-md-12">
            <form wire:submit.prevent="save">
                <div class="form-group mb-2">
                    <input type="file" class="form-control-file" wire:model="contactFile">
                </div>

                <div class="form-group mb-2">
                    <label>Title</label>
                    <select class="form-control" wire:model="title">
                        <option value="title">Title</option>
                        <option value="first_name">First Name</option>
                        <option value="last_name">Last Name</option>
                        <option value="contact_number">Mobile Number</option>
                        <option value="company_name">Company Name</option>
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label>First Name</label>
                    <select class="form-control" wire:model="first_name">
                        <option value="title">Title</option>
                        <option value="first_name">First Name</option>
                        <option value="last_name">Last Name</option>
                        <option value="contact_number">Mobile Number</option>
                        <option value="company_name">Company Name</option>
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label>Last Name</label>
                    <select class="form-control" wire:model="last_name">
                        <option value="title">Title</option>
                        <option value="first_name">First Name</option>
                        <option value="last_name">Last Name</option>
                        <option value="contact_number">Mobile Number</option>
                        <option value="company_name">Company Name</option>
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label>Mobile Number</label>
                    <select class="form-control" wire:model="contact_number">
                        <option value="title">Title</option>
                        <option value="first_name">First Name</option>
                        <option value="last_name">Last Name</option>
                        <option value="contact_number">Mobile Number</option>
                        <option value="company_name">Company Name</option>
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label>Company Name</label>
                    <select class="form-control" wire:model="company_name">
                        <option value="title">Title</option>
                        <option value="first_name">First Name</option>
                        <option value="last_name">Last Name</option>
                        <option value="contact_number">Mobile Number</option>
                        <option value="company_name">Company Name</option>
                    </select>
                </div>

                <button class="btn btn-primary mb-2" type="submit">Save Contact</button>
            </form>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
            <input type="text" class="form-control" placeholder="Search" wire:model="search">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Mobile Number</th>
                                <th scope="col">Company Name</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                            <tr>
                                <th scope="row">{{ $contact->title }}</th>
                                <td>{{ $contact->first_name }}</td>
                                <td>{{ $contact->last_name }}</td>
                                <td>{{ $contact->contact_number }}</td>
                                <td>{{ $contact->company_name }}</td>
                                <td>
                                    <a href="/contact/{{ $contact->id }}/edit" type="button" class="btn btn-secondary btn-sm mr-1">Edit</a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" wire:click="delete({{ $contact->id }})">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete contact</h5>
                    <button id="closeDeleteModal" type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if (! empty($selectedContact))
                <div class="modal-body">
                    Are you sure you want to delete {{ $selectedContact->title . $selectedContact->first_name . ' ' . $selectedContact->last_name }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="destroy({{ $selectedContact->id }})">Confirm</button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>