<div>
    <form wire:submit.prevent="update">
        <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" wire:model="contact.title">
            @error('contact.title')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>First Name</label>
            <input type="text" class="form-control" wire:model="contact.first_name">
            @error('contact.first_name')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" class="form-control" wire:model="contact.last_name">
            @error('contact.last_name')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>Mobile Number</label>
            <input type="text" class="form-control" wire:model="contact.contact_number">
            @error('contact.contact_number')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>Company Name</label>
            <input type="text" class="form-control" wire:model="contact.company_name">
            @error('contact.company_name')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>
</div>