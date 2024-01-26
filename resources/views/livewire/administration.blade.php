<div>
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                Administration
            </div>
            <hr>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                        type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Hospital
                        Details</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Insuarence
                        Companies</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane"
                        type="button" role="tab" aria-controls="contact-tab-pane"
                        aria-selected="false">Contact</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane"
                        type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false"
                        disabled>Disabled</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                    tabindex="0">

                    <div class="row mt-2">
                        <div class="col-auto">
                            <form>
                                <div>
                                    <label for="name">Hospital Name:</label>
                                    <input type="text" class="form-control" placeholder="Hospital">
                                </div>
                                <div>
                                    <label for="name">Address/Telephone:</label>
                                    <textarea name="" id="" cols="30" rows="4" class="form-control">
                        </textarea>
                                </div>
                                <div>
                                    <label for="">Residence/Location</label>
                                    <input type="text" class="form-control" placeholder="KAPSABET">
                                </div>
                                <hr>
                                <div>
                                    <button class="btn btn-sm btn-primary">SAVE DETAILS</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="0">
                    <?php $title=$this->modalTitle;?>
                    <div class="mt-3">
                        <button class="btn btn-sm btn-success text-white" data-bs-toggle="modal"
                            data-bs-target="#addInsuarance">Add Insuarance</button>
                            <button class="btn btn-sm btn-secondary" onClick="window.location.reload();">Refresh</button>
                    </div>
                    <hr>
                    <div class="mt-2">
                        <div class="table-responsive mt-3">
                            <table class="table table-secondary table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Code:</th>
                                        <th>Name:</th>
                                        <th>Contact Person</th>
                                        <th>Phone:</th>
                                        <th>Action:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($InsuaranceList as $item)
                                        <tr>
                                            <td>{{ $loop->index +1 }}</td>
                                            <td>{{$item->code}}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->contact_name }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary" wire:click="editInsurer({{$item->id}})" data-bs-toggle="modal"
                                                data-bs-target="#addInsuarance">Edit</button>
                                                <button class="btn btn-sm btn-danger" wire:confirm="Delete Insurer?" wire:click="deleteInsure({{$item->id}})">Remove</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab"
                        tabindex="0">
                        ...</div>
                    <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab"
                        tabindex="0">
                        ...</div>
                </div>
            </div>
        </div>
    </div>
    <!--Add Insuarance Model-->
    <div wire:ignore.self class="modal fade" id="addInsuarance" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="addInsuaranceLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addInsuaranceLabel">{{$title}} Insuarance</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="saveInsuarance">
                        <div>
                            <input type="text" class="form-control" placeholder="Insuarance Code"
                                wire:model="insuaranceCode">
                            <p style="color:red">
                                @error('insuaranceCode')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="mt-2">
                            <input type="text" class="form-control" placeholder="Company Name"
                                wire:model="insuaranceCompanyName">
                            <p style="color:red">
                                @error('insuaranceCompanyName')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="mt-2">
                            <input type="text" class="form-control" placeholder="Contact Person Name"
                                wire:model="insuaranceContactPerson">
                            <p style="color:red">
                                @error('insuaranceContactPerson')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="mt-2">
                            <input type="text" class="form-control" placeholder="Phone"
                                wire:model="insuarancePhone">
                            <p style="color:red">
                                @error('insuarancePhone')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="card-footer mt-3">

                            <button class="btn btn-primary">{{$title}} Insuarance</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
