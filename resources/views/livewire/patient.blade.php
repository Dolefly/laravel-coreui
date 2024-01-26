<div>
    <div class="card">

        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Patient Admission</h5>
                <button class="btn btn-sm btn-success text-white" data-bs-toggle="modal" data-bs-target="#newPatient">New
                    Patient</button>
            </div>
            <hr class="mt-2">
            <?php $today = date('m-d-Y'); ?>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="input-group me-2">
                    <input type="search" class="form-control" placeholder="Search Patient">
                    <button class="btn btn-sm btn-primary" type="button">Search</button>
                </div>

                <div class="input-group me-2">
                    <label for="date" class="form-label me-2">From:</label>
                    <input type="datetime-local" class="form-control" id="startDate">
                </div>

                <div class="input-group me-2">
                    <label class="me-2">To:</label>
                    <input type="datetime-local" class="form-control" id="endDate">
                </div>

                <div class="input-group">
                    <button class="btn btn-sm btn-primary">Apply</button>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-secondary table-hover">
                    <thead>
                        <tr>
                            <th scope="col">PID:</th>
                            <th scope="col">Name:</th>
                            <th scope="col">Age:</th>
                            <th scope="col">Gender:</th>
                            <th scope="col">Phone:</th>
                            <th scope="col">Insuarance:</th>
                            <th scope="col">County:</th>
                            <th scope="col">Residence:</th>
                            <th scope="col">Action:</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr class="">
                            <td></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- Add Patient Modal -->
        <div wire:ignore.self class="modal fade" id="newPatient" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="newPatientLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newPatientLabel">New Patient</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit='savePatient'>
                            <div>
                                <input type="text" class="form-control" id="patientName" wire:model="patientName"
                                    placeholder="Patient Name">
                                <div style="color:red">
                                    @error('patientName')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="input-group mt-2">
                                <span class="input-group-text">Date of Birth:</span>
                                <input type="date" aria-label="dob" wire:model="dob" class="form-control">
                                <span class="input-group-text">Gender:</span>
                                <select name="gender" id="gender" wire:model="gender" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>

                            </div>
                            <div style="color:red">
                                @error('dob') {{ $message }} @enderror
                                @error('gender')
                                {{ $message }}
                                @enderror
                            </div>

                            <div class="mt-2">
                                <input type="checkbox" name="guardianCheckbox" id="guardianCheckbox"
                                    onchange="toggleGuardian()">
                                <label for="guadianCheckbox"> <strong> Same as Patient</strong></label>
                                <input type="text" class="form-control" id="guardianName" wire:model="guardianName"
                                    placeholder="Guardian Name">
                                <div style="color:red">
                                    @error('guardianName')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="input-group mt-2">
                                <span class="input-group-text">ID Number.:</span>
                                <input type="text" aria-label="idnumber" wire:model="idNumber" class="form-control">
                                
                                <span class="input-group-text">Phone:</span>
                                <input type="tel" aria-label="phone" wire:model="phone" class="form-control">
                                
                            </div>
                            <div style="color:red">
                                @error('idNumber')
                                    {{ $message }}
                                @enderror
                                @error('phone')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="mt-2">
                                <?php $insurer = $this->insuarence; ?>
                                <select name="insurer" id="insurer" wire:model="insurer" class="form-control">
                                    <option value="">Select Insuarance</option>
                                    @foreach ($insurer as $item)
                                        <option value="{{ $item->code }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <div style="color:red">
                                    @error('insurer')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="input-group mt-2">
                                <span class="input-group-text">Residence:</span>
                                <input type="text" aria-label="residence" wire:model="residence"
                                    class="form-control">
                                
                                <span class="input-group-text">County:</span>
                                <select name="county" id="county" wire:model="county" class="form-control">
                                    <option value="">Select County</option>
                                    <option value="Mombasa">Mombasa</option>
                                    <option value="Kwale">Kwale</option>
                                    <option value="Kilifi">Kilifi</option>
                                    <option value="Tana River">Tana River</option>
                                    <option value="Lamu">Lamu</option>
                                    <option value="Taita Mak Taveta">Taita Mak Taveta</option>
                                    <option value="Garissa">Garissa</option>
                                    <option value="Wajir">Wajir</option>
                                    <option value="Mandera">Mandera</option>
                                    <option value="Marsabit">Marsabit</option>
                                    <option value="Isiolo">Isiolo</option>
                                    <option value="Meru">Meru</option>
                                    <option value="Tharaka-Nithi">Tharaka-Nithi</option>
                                    <option value="Embu">Embu</option>
                                    <option value="Kitui">Kitui</option>
                                    <option value="Machakos">Machakos</option>
                                    <option value="Makueni">Makueni</option>
                                    <option value="Nyandarua">Nyandarua</option>
                                    <option value="Nyeri">Nyeri</option>
                                    <option value="Kirinyaga">Kirinyaga</option>
                                    <option value="Murang’a">Murang’a</option>
                                    <option value="Kiambu">Kiambu</option>
                                    <option value="Turkana">Turkana</option>
                                    <option value="West Pokot">West Pokot</option>
                                    <option value="Samburu">Samburu</option>
                                    <option value="Trans-Nzoia">Trans-Nzoia</option>
                                    <option value="Uasin Gishu">Uasin Gishu</option>
                                    <option value="Elgeyo-Marakwet">Elgeyo-Marakwet</option>
                                    <option value="Nandi">Nandi</option>
                                    <option value="Baringo">Baringo</option>
                                    <option value="Laikipia">Laikipia</option>
                                    <option value="Nakuru">Nakuru</option>
                                    <option value="Narok">Narok</option>
                                    <option value="Kajiado">Kajiado</option>
                                    <option value="Kericho">Kericho</option>
                                    <option value="Bomet">Bomet</option>
                                    <option value="Kakamega">Kakamega</option>
                                    <option value="Vihiga">Vihiga</option>
                                    <option value="Bungoma">Bungoma</option>
                                    <option value="Busia">Busia</option>
                                    <option value="Siaya">Siaya</option>
                                    <option value="Kisumu">Kisumu</option>
                                    <option value="Homa Bay">Homa Bay</option>
                                    <option value="Migori">Migori</option>
                                    <option value="Kisii">Kisii</option>
                                    <option value="Nyamira">Nyamira</option>
                                    <option value="Nairobi">Nairobi</option>

                                </select>
                               
                            </div>
                            <div style="color:red">
                                @error('residence')
                                    {{ $message }}
                                @enderror
                                @error('county')
                                        {{ $message }}
                                    @enderror
                            </div>
                            <hr>
                            <div class="float-end">

                                <button class="btn btn-primary">Save Patient</button>
                            </div>
                        </form>
                    </div>

                    <script>
                        function toggleGuardian() {
                            var patientNameInput = document.getElementById('patientName');
                            var guardianNameInput = document.getElementById('guardianName');
                            var guardianCheckbox = document.getElementById('guardianCheckbox');

                            if (guardianCheckbox.checked) {
                                guardianNameInput.value = patientNameInput.value;
                                guardianNameInput.readOnly = true;
                            } else {
                                guardianNameInput.value = '';
                                guardianNameInput.readOnly = false;
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Include this script in your HTML file -->


<!-- Include this script in your HTML file -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the current date and time
        var currentDate = new Date();

        // Format the date to be compatible with datetime-local input
        var formattedDate = currentDate.toISOString().slice(0, 16);

        // Set the default value and max attribute of the 'From' input
        document.getElementById('startDate').value = formattedDate;
        document.getElementById('startDate').max = formattedDate;

        // Set the default value and max attribute of the 'To' input
        document.getElementById('endDate').value = formattedDate;
        document.getElementById('endDate').max = formattedDate;

        // Add event listener to 'change' event for 'From' input
        document.getElementById('startDate').addEventListener('change', function() {
            // Update 'To' input max attribute to prevent selecting a date before 'From' date
            document.getElementById('endDate').min = this.value;
        });

        // Add event listener to 'change' event for 'To' input
        document.getElementById('endDate').addEventListener('change', function() {
            // Update 'From' input max attribute to prevent selecting a date after 'To' date
            document.getElementById('startDate').max = this.value;
        });
    });
</script>
