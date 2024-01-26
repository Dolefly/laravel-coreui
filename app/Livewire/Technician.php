<?php

namespace App\Livewire;

use Exception;
use Livewire\Component;

use Livewire\WithPagination;
use App\Models\DoctorTable;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class Technician extends Component
{
    use LivewireAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $techStaffNumber, $techName, $techPosition, $techPhone, $techIdNumber, $generateStaffNo, $techSearch;
    public $tableName = 'Doctor_tables';

    public function mount()
    {

        $getStaffNo = $this->getNextAutoIncrementValue($this->tableName);
        //dd($getStaffNo);
        $this->techStaffNumber = 'T' . $getStaffNo;
    }


    public function render()
    {
        $search = $this->techSearch;

        $techs = DoctorTable::where('employeeid', 'LIKE', '%T%');

        if ($search) {
            $techs->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('employeeid', 'like', '%' . $search . '%');
            });
        }

        $techs = $techs->paginate(5);

        return view('livewire.technician', ['techs' => $techs]);
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
        $this->techStaffNumber = 'T' . $this->getNextAutoIncrementValue($this->tableName);;
        $this->techName = '';
        $this->techPhone = '';
        $this->techPosition = '';
        $this->techIdNumber = '';
    }
    public function save()
    {
        $this->validateDoctor();
        try {


            DoctorTable::create([
                'employeeid' => $this->techStaffNumber,
                'name' => strtoupper($this->techName),
                'position' => strtoupper($this->techPosition),
                'phone' => $this->techPhone,
                'IdNumber' => $this->techIdNumber
            ]);
            $this->alert('info', "Technician added successfuly!");
            $this->resetFields();
        } catch (Exception $e) {
            $this->alert('warning', $e->getMessage());
        }
    }
    public function validateDoctor()
    {
        return   $this->validate(
            [
                'techStaffNumber' => 'required',
                'techName' => 'required',
                'techPosition' => 'required',
                'techPhone' => 'required',
                'techIdNumber' => 'required'
            ],
            [
                'techStaffNumber.required' => 'The staff number field is required.',
                'techName.required' => 'The name field is required.',
                'techPosition.required' => 'The position field is required.',
                'techPhone.required' => 'The phone field is required.',
                'techIdNumber.required' => 'The ID number field is required.'
            ]
        );
    }
    public function edit($id)
    {
        $Doctor = DoctorTable::where('id', $id)->first();
        if ($Doctor) {
            $this->techStaffNumber = $Doctor->employeeid;
            $this->techName = $Doctor->name;
            $this->techIdNumber = $Doctor->IdNumber;
            $this->techPhone = $Doctor->phone;
            $this->techPosition = $Doctor->position;
        }
    }
    public function updateTech()
    {
        $this->validateDoctor();
        $Doctor = DoctorTable::where('employeeid', $this->techStaffNumber)->first();
        if ($Doctor) {
            $Doctor->update([
                'name' => strtoupper($this->techName),
                'position' => strtoupper($this->techPosition),
                'phone' => $this->techPhone,
                'IdNumber' => $this->techIdNumber
            ]);
            $this->alert('info', "Technician updated successfuly!");
        }
    }
    public function delete($id)
    {
        $Doctor = DoctorTable::where('id', $id)->first();
        if ($Doctor) {
            $Doctor->delete();
            $this->alert('success', 'Technician removed successfuly!');
            $this->resetFields();
        }
    }
}
