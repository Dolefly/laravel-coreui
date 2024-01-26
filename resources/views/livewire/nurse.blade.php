<div>

    <div class="card">

        <div class="card-body">
            <h5 class="card-title">Nurses</h5>
            <hr>
            <div class="row mt-2 justify-content-between">

                <div class="col-auto">
                    <input type="search" class="form-control" wire:model.live="nurseSearch" placeholder="Search nurse">
                </div>
                
                <div class="col-auto" style="margin-left: auto;">
                    <a class="btn btn-dark btn-sm text-light" role="button" style="margin-right: -15px;">Export</a>
                </div>
                <div class="col-auto ml-auto">

                    <a class="btn btn-success btn-sm text-light" role="button" data-bs-toggle="modal" data-bs-target="#addnurse">Add nurse</a>
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
                        @foreach($nurses as $nurse)
                        <tr class="">
                            <td scope="row">{{$nurse->employeeid}}</td>
                            <td scope="row">{{$nurse->name}}</td>
                            <td>{{$nurse->position}}</td>
                            <td>{{$nurse->phone}}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updatenurse" wire:click="edit({{$nurse->id}})">Edit</button>
                                <a class="btn btn-danger btn-sm " role="button" wire:click="delete({{$nurse->id}})" wire:confirm="Delete {{$nurse->name}}?">Remove</a>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$nurses->links()}}
        </div>
    </div>
    <!--Modals here-->
    <!--Add nurse-->
    <div wire:ignore.self class="modal fade" id="addnurse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addnurseLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addnurseLabel">New nurse</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php $staffNo = $this->nurseStaffNumber; ?>
                    <form wire:submit="save">
                        <div class="form-group">
                            <input type="text" class="form-control" id="staffNo" wire:model="nurseStaffNumber" readonly>
                            <p style="color:red">@error('nurseStaffNumber') {{ $message }} @enderror</p>
                        </div>

                        <div class="form-group mt-2">
                            <input type="text" class="form-control" id="name" placeholder="Name" wire:model="nurseName">
                            <p style="color:red">@error('nurseName') {{ $message }} @enderror</p>
                        </div>
                        <div class="form-group mt-2">
                            <input type="text" class="form-control" id="idNumber" placeholder="ID Number" wire:model="nurseIdNumber">
                            <p style="color:red">@error('nurseIdNumber') {{ $message }} @enderror</p>
                        </div>
                        <div class="form-group mt-2">
                            <input type="tel" class="form-control" id="phone" placeholder="Phone Number" wire:model="nursePhone">
                            <p style="color:red">@error('nursePhone') {{ $message }} @enderror</p>
                        </div>
                        <div class="form-group mt-2">
                            <input type="text" class="form-control" id="position" placeholder="Position i.e CO or Gyno" wire:model="nursePosition">
                            <p style="color:red">@error('nursePosition') {{ $message }} @enderror</p>
                        </div>

                        <hr>
                        <div class="mt-3 float-end">
                            <button class="btn btn-primary btn-sm "> Save nurse </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--Update nurse-->
    <div wire:ignore.self class="modal fade" id="updatenurse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updatenurseLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updatenurseLabel">Update nurse</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form wire:submit="updateNurse">
                        <div class="form-group">
                            <label for="staffno">Staff No:</label>
                            <input type="text" class="form-control" wire:model="nurseStaffNumber" readonly>
                            <p style="color:red">@error('nurseStaffNumber') {{ $message }} @enderror</p>
                        </div>

                        <div class="form-group mt-2">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" placeholder="Name" wire:model="nurseName">
                            <p style="color:red">@error('nurseName') {{ $message }} @enderror</p>
                        </div>
                        <div class="form-group mt-2">
                            <label for="idnumber">ID Number:</label>
                            <input type="text" class="form-control" placeholder="ID Number" wire:model="nurseIdNumber">
                            <p style="color:red">@error('nurseIdNumber') {{ $message }} @enderror</p>
                        </div>
                        <div class="form-group mt-2">
                            <label for="phone">Phone Number:</label>
                            <input type="tel" class="form-control" placeholder="Phone Number" wire:model="nursePhone">
                            <p style="color:red">@error('nursePhone') {{ $message }} @enderror</p>
                        </div>
                        <div class="form-group mt-2">
                            <label for="position">Position:</label>
                            <input type="text" class="form-control" placeholder="Position i.e CO or Gyno" wire:model="nursePosition">
                            <p style="color:red">@error('nursePosition') {{ $message }} @enderror</p>
                        </div>

                        <hr>
                        <div class="mt-3 float-end">
                            <button class="btn btn-primary btn-sm "> Update nurse </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        var staffNo = <?php echo json_encode($staffNo); ?>;
        $(nurseument).ready(function() {
            
            // Attach a function to the modal's show event
            $('#addnurse').on('show.bs.modal', function() {
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