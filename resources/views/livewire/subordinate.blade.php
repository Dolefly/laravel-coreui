<div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Subordinate Staff</h5>
            <hr>
            <div class="row mt-2 justify-content-between">

                <div class="col-auto">
                    <input type="search" class="form-control" wire:model.live="subSearch" placeholder="Search Staff member">
                </div>
                
                <div class="col-auto" style="margin-left: auto;">
                    <a class="btn btn-dark btn-sm text-light" role="button" style="margin-right: -15px;">Export</a>
                </div>
                <div class="col-auto ml-auto">

                    <a class="btn btn-success btn-sm text-light" role="button" data-bs-toggle="modal" data-bs-target="#addsub">Add Staff</a>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-secondary table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Staff No:</th>
                            <th scope="col">Name:</th>
                            <th scope="col">Position:</th>
                            <th scope="col">Phone:</th>
                            <th scope="col">Action:</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subs as $sub)
                        <tr class="">
                            <td scope="row">{{$sub->employeeid}}</td>
                            <td scope="row">{{$sub->name}}</td>
                            <td>{{$sub->position}}</td>
                            <td>{{$sub->phone}}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updatesub" wire:click="edit({{$sub->id}})">Edit</button>
                                <a class="btn btn-danger btn-sm " role="button" wire:click="delete({{$sub->id}})" wire:confirm="Delete {{$sub->name}}?">Remove</a>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$subs->links()}}
        </div>
    </div>
    <!--Modals here-->
    <!--Add sub-->
    <div wire:ignore.self class="modal fade" id="addsub" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addsubLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addsubLabel">New Staff Member</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php $staffNo = $this->subStaffNumber; ?>
                    <form wire:submit="save">
                        <div class="form-group">
                            <input type="text" class="form-control" id="staffNo" wire:model="subStaffNumber" readonly>
                            <p style="color:red">@error('subStaffNumber') {{ $message }} @enderror</p>
                        </div>

                        <div class="form-group mt-2">
                            <input type="text" class="form-control" id="name" placeholder="Name" wire:model="subName">
                            <p style="color:red">@error('subName') {{ $message }} @enderror</p>
                        </div>
                        <div class="form-group mt-2">
                            <input type="text" class="form-control" id="idNumber" placeholder="ID Number" wire:model="subIdNumber">
                            <p style="color:red">@error('subIdNumber') {{ $message }} @enderror</p>
                        </div>
                        <div class="form-group mt-2">
                            <input type="tel" class="form-control" id="phone" placeholder="Phone Number" wire:model="subPhone">
                            <p style="color:red">@error('subPhone') {{ $message }} @enderror</p>
                        </div>
                        <div class="form-group mt-2">
                            <input type="text" class="form-control" id="position" placeholder="Position i.e CO or Gyno" wire:model="subPosition">
                            <p style="color:red">@error('subPosition') {{ $message }} @enderror</p>
                        </div>

                        <hr>
                        <div class="mt-3 float-end">
                            <button class="btn btn-primary btn-sm "> Save sub </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--Update sub-->
    <div wire:ignore.self class="modal fade" id="updatesub" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updatesubLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updatesubLabel">Update Staff</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form wire:submit="updatesub">
                        <div class="form-group">
                            <label for="staffno">Staff No:</label>
                            <input type="text" class="form-control" wire:model="subStaffNumber" readonly>
                            <p style="color:red">@error('subStaffNumber') {{ $message }} @enderror</p>
                        </div>

                        <div class="form-group mt-2">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" placeholder="Name" wire:model="subName">
                            <p style="color:red">@error('subName') {{ $message }} @enderror</p>
                        </div>
                        <div class="form-group mt-2">
                            <label for="idnumber">ID Number:</label>
                            <input type="text" class="form-control" placeholder="ID Number" wire:model="subIdNumber">
                            <p style="color:red">@error('subIdNumber') {{ $message }} @enderror</p>
                        </div>
                        <div class="form-group mt-2">
                            <label for="phone">Phone Number:</label>
                            <input type="tel" class="form-control" placeholder="Phone Number" wire:model="subPhone">
                            <p style="color:red">@error('subPhone') {{ $message }} @enderror</p>
                        </div>
                        <div class="form-group mt-2">
                            <label for="position">Position:</label>
                            <input type="text" class="form-control" placeholder="Position i.e CO or Gyno" wire:model="subPosition">
                            <p style="color:red">@error('subPosition') {{ $message }} @enderror</p>
                        </div>

                        <hr>
                        <div class="mt-3 float-end">
                            <button class="btn btn-primary btn-sm "> Update sub </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        var staffNo = <?php echo json_encode($staffNo); ?>;
        $(subument).ready(function() {
            
            // Attach a function to the modal's show event
            $('#addsub').on('show.bs.modal', function() {
                // Reset elements here
                //$('#staffNo').val($staffNo);
                $('#name').val('');
                $('#idNumber').val('');
                $('#phone').val('');
                $('#position').val('');

                $('#staffNo').val(staffNo);
                
            });
        });
    </script>

</div>