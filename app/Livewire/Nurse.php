<?php

namespace App\Livewire;

use Exception;
use Livewire\Component;

use Livewire\WithPagination;
use App\Models\DoctorTable;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class Nurse extends Component
{
    use LivewireAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $nurseStaffNumber, $nurseName, $nursePosition, $nursePhone, $nurseIdNumber, $generateStaffNo, $nurseSearch;
    public $tableName = 'Doctor_tables';

    public function mount()
    {

        $getStaffNo = $this->getNextAutoIncrementValue($this->tableName);
        //dd($getStaffNo);
        $this->nurseStaffNumber = 'N' . $getStaffNo;
    }


    public function render()
    {
        $search = $this->nurseSearch;

        $nurses = DoctorTable::where('employeeid', 'LIKE', '%N%');

        if ($search) {
            $nurses->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('employeeid', 'like', '%' . $search . '%');
            });
        }

        $nurses = $nurses->paginate(5);

        return view('livewire.nurse', ['nurses' => $nurses]);
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
        $this->nurseStaffNumber = 'N' . $this->getNextAutoIncrementValue($this->tableName);;
        $this->nurseName = '';
        $this->nursePhone = '';
        $this->nursePosition = '';
        $this->nurseIdNumber = '';
    }
    public function save()
    {
        $this->validateDoctor();
        try {


            DoctorTable::create([
                'employeeid' => $this->nurseStaffNumber,
                'name' => strtoupper($this->nurseName),
                'position' => strtoupper($this->nursePosition),
                'phone' => $this->nursePhone,
                'IdNumber' => $this->nurseIdNumber
            ]);
            $this->alert('info', "Nurse added successfuly!");
            $this->resetFields();
        } catch (Exception $e) {
            $this->alert('warning', $e->getMessage());
        }
    }
    public function validateDoctor()
    {
        return   $this->validate(
            [
                'nurseStaffNumber' => 'required',
                'nurseName' => 'required',
                'nursePosition' => 'required',
                'nursePhone' => 'required',
                'nurseIdNumber' => 'required'
            ],
            [
                'nurseStaffNumber.required' => 'The staff number field is required.',
                'nurseName.required' => 'The name field is required.',
                'nursePosition.required' => 'The position field is required.',
                'nursePhone.required' => 'The phone field is required.',
                'nurseIdNumber.required' => 'The ID number field is required.'
            ]
        );
    }
    public function edit($id)
    {
        $Doctor = DoctorTable::where('id', $id)->first();
        if ($Doctor) {
            $this->nurseStaffNumber = $Doctor->employeeid;
            $this->nurseName = $Doctor->name;
            $this->nurseIdNumber = $Doctor->IdNumber;
            $this->nursePhone = $Doctor->phone;
            $this->nursePosition = $Doctor->position;
        }
    }
    public function updateNurse()
    {
        $this->validateDoctor();
        $Doctor = DoctorTable::where('employeeid', $this->nurseStaffNumber)->first();
        if ($Doctor) {
            $Doctor->update([
                'name' => strtoupper($this->nurseName),
                'position' => strtoupper($this->nursePosition),
                'phone' => $this->nursePhone,
                'IdNumber' => $this->nurseIdNumber
            ]);
            $this->alert('info', "Nurse updated successfuly!");
        }
    }
    public function delete($id)
    {
        $Doctor = DoctorTable::where('id', $id)->first();
        if ($Doctor) {
            $Doctor->delete();
            $this->alert('success', 'Nurse removed successfuly!');
            $this->resetFields();
        }
    }
}
