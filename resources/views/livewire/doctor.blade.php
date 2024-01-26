<div>

    <div class="card">

        <div class="card-body">
            <h5 class="card-title">Doctors</h5>
            <hr>
            <div class="row mt-2 justify-content-between">

                <div class="col-auto">
                    <input type="search" class="form-control" wire:model.live="docSearch" placeholder="Search Doctor">
                </div>
                
                <div class="col-auto" style="margin-left: auto;">
                    <a class="btn btn-dark btn-sm text-light" role="button" style="margin-right: -15px;">Export</a>
                </div>
                <div class="col-auto ml-auto">

                    <a class="btn btn-success btn-sm text-light" role="button" data-bs-toggle="modal" data-bs-target="#addDoctor">Add Doctor</a>
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
                        @foreach($docs as $doctor)
                        <tr class="">
                            <td scope="row">{{$doctor->employeeid}}</td>
                            <td scope="row">{{$doctor->name}}</td>
                            <td>{{$doctor->position}}</td>
                            <td>{{$doctor->phone}}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateDoctor" wire:click="edit({{$doctor->id}})">Edit</button>
                                <a class="btn btn-danger btn-sm " role="button" wire:click="delete({{$doctor->id}})" wire:confirm="Delete {{$doctor->name}}?">Remove</a>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$docs->links()}}
        </div>
    </div>
    <!--Modals here-->
    <!--Add Doctor-->
    <div wire:ignore.self class="modal fade" id="addDoctor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addDoctorLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDoctorLabel">New Doctor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php $staffNo = $this->docStaffNumber; ?>
                    <form wire:submit="save">
                        <div class="form-group">
                            <input type="text" class="form-control" id="staffNo" wire:model="docStaffNumber" readonly>
                            <p style="color:red">@error('docStaffNumber') {{ $message }} @enderror</p>
                        </div>

                        <div class="form-group mt-2">
                            <input type="text" class="form-control" id="name" placeholder="Name" wire:model="docName">
                            <p style="color:red">@error('docName') {{ $message }} @enderror</p>
                        </div>
                        <div class="form-group mt-2">
                            <input type="text" class="form-control" id="idNumber" placeholder="ID Number" wire:model="docIdNumber">
                            <p style="color:red">@error('docIdNumber') {{ $message }} @enderror</p>
                        </div>
                        <div class="form-group mt-2">
                            <input type="tel" class="form-control" id="phone" placeholder="Phone Number" wire:model="docPhone">
                            <p style="color:red">@error('docPhone') {{ $message }} @enderror</p>
                        </div>
                        <div class="form-group mt-2">
                            <input type="text" class="form-control" id="position" placeholder="Position i.e CO or Gyno" wire:model="docPosition">
                            <p style="color:red">@error('docPosition') {{ $message }} @enderror</p>
                        </div>

                        <hr>
                        <div class="mt-3 float-end">
                            <button class="btn btn-primary btn-sm "> Save Doctor </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--Update Doctor-->
    <div wire:ignore.self class="modal fade" id="updateDoctor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateDoctorLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateDoctorLabel">Update Doctor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form wire:submit="updateDoctor">
                        <div class="form-group">
                            <label for="staffno">Staff No:</label>
                            <input type="text" class="form-control" wire:model="docStaffNumber" readonly>
                            <p style="color:red">@error('docStaffNumber') {{ $message }} @enderror</p>
                        </div>

                        <div class="form-group mt-2">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" placeholder="Name" wire:model="docName">
                            <p style="color:red">@error('docName') {{ $message }} @enderror</p>
                        </div>
                        <div class="form-group mt-2">
                            <label for="idnumber">ID Number:</label>
                            <input type="text" class="form-control" placeholder="ID Number" wire:model="docIdNumber">
                            <p style="color:red">@error('docIdNumber') {{ $message }} @enderror</p>
                        </div>
                        <div class="form-group mt-2">
                            <label for="phone">Phone Number:</label>
                            <input type="tel" class="form-control" placeholder="Phone Number" wire:model="docPhone">
                            <p style="color:red">@error('docPhone') {{ $message }} @enderror</p>
                        </div>
                        <div class="form-group mt-2">
                            <label for="position">Position:</label>
                            <input type="text" class="form-control" placeholder="Position i.e CO or Gyno" wire:model="docPosition">
                            <p style="color:red">@error('docPosition') {{ $message }} @enderror</p>
                        </div>

                        <hr>
                        <div class="mt-3 float-end">
                            <button class="btn btn-primary btn-sm "> Update Doctor </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        var staffNo = <?php echo json_encode($staffNo); ?>;
        $(document).ready(function() {
            
            // Attach a function to the modal's show event
            $('#addDoctor').on('show.bs.modal', function() {
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