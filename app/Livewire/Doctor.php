<?php

namespace App\Livewire;

use Exception;
use Livewire\Component;
use App\Models\DoctorTable;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;


class Doctor extends Component
{
    use LivewireAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $docStaffNumber, $docName, $docPosition, $docPhone, $docIdNumber, $generateStaffNo, $docSearch;
    public $tableName = 'doctor_tables';

    public function mount()
    {

        $getStaffNo = $this->getNextAutoIncrementValue($this->tableName);
        //dd($getStaffNo);
        $this->docStaffNumber = 'D' . $getStaffNo;
    }


    public function render()
    {
        
        $search = $this->docSearch;

        $docs = DoctorTable::where('employeeid', 'LIKE', '%D%');

        if ($search) {
            $docs->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('employeeid', 'like', '%' . $search . '%');
            });
        }

        $docs = $docs->paginate(5);

        return view('livewire.doctor', ['docs' => $docs]);
    }
    public function getNextAutoIncrementValue()
    {
        $lastRecord = DoctorTable::latest('id')->first();

        if ($lastRecord) {
            $nextAutoIncrement = $lastRecord->id + 1;
        } else {
            // Handle the case when the table is empty
            $nextAutoIncrement = 1;
        }

        return $nextAutoIncrement;
    }
    // Example usage

    public function resetFields()
    {
        $this->docStaffNumber = 'D' . $this->getNextAutoIncrementValue($this->tableName);;
        $this->docName = '';
        $this->docPhone = '';
        $this->docPosition = '';
        $this->docIdNumber = '';
    }
    public function save()
    {
        $this->validateDoctor();
        try {


            DoctorTable::create([
                'employeeid' => $this->docStaffNumber,
                'name' => strtoupper($this->docName),
                'position' => strtoupper($this->docPosition),
                'phone' => $this->docPhone,
                'IdNumber' => $this->docIdNumber
            ]);
            $this->alert('info', "Doctor added successfuly!");
            $this->resetFields();
        } catch (Exception $e) {
            $this->alert('warning', $e->getMessage());
        }
    }
    public function validateDoctor()
    {
        return   $this->validate(
            [
                'docStaffNumber' => 'required',
                'docName' => 'required',
                'docPosition' => 'required',
                'docPhone' => 'required',
                'docIdNumber' => 'required'
            ],
            [
                'docStaffNumber.required' => 'The staff number field is required.',
                'docName.required' => 'The name field is required.',
                'docPosition.required' => 'The position field is required.',
                'docPhone.required' => 'The phone field is required.',
                'docIdNumber.required' => 'The ID number field is required.'
            ]
        );
    }
    public function edit($id)
    {
        $doctor = DoctorTable::where('id', $id)->first();
        if ($doctor) {
            $this->docStaffNumber = $doctor->employeeid;
            $this->docName = $doctor->name;
            $this->docIdNumber = $doctor->IdNumber;
            $this->docPhone = $doctor->phone;
            $this->docPosition = $doctor->position;
        }
    }
    public function updateDoctor()
    {
        $this->validateDoctor();
        $doctor = DoctorTable::where('employeeid', $this->docStaffNumber)->first();
        if ($doctor) {
            $doctor->update([
                'name' => strtoupper($this->docName),
                'position' => strtoupper($this->docPosition),
                'phone' => $this->docPhone,
                'IdNumber' => $this->docIdNumber
            ]);
            $this->alert('info', "Doctor updated successfuly!");
        }
    }
    public function delete($id)
    {
        $doctor = DoctorTable::where('id', $id)->first();
        if ($doctor) {
            $doctor->delete();
            $this->alert('success', 'Doctor removed successfuly!');
            $this->resetFields();
        }
    }
}
