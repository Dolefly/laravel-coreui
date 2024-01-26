<?php

namespace App\Livewire;

use Exception;
use Livewire\Component;

use Livewire\WithPagination;
use App\Models\DoctorTable;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class Subordinate extends Component
{
    use LivewireAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $subStaffNumber, $subName, $subPosition, $subPhone, $subIdNumber, $generateStaffNo, $subSearch;
    public $tableName = 'Doctor_tables';

    public function mount()
    {

        $getStaffNo = $this->getNextAutoIncrementValue($this->tableName);
        //dd($getStaffNo);
        $this->subStaffNumber = 'S' . $getStaffNo;
    }


    public function render()
    {
        $search = $this->subSearch;

        $subs = DoctorTable::where('employeeid', 'LIKE', '%S%');

        if ($search) {
            $subs->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('employeeid', 'like', '%' . $search . '%');
            });
        }

        $subs = $subs->paginate(5);

        return view('livewire.subordinate', ['subs' => $subs]);
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
        $this->subStaffNumber = 'S' . $this->getNextAutoIncrementValue($this->tableName);;
        $this->subName = '';
        $this->subPhone = '';
        $this->subPosition = '';
        $this->subIdNumber = '';
    }
    public function save()
    {
        $this->validateDoctor();
        try {


            DoctorTable::create([
                'employeeid' => $this->subStaffNumber,
                'name' => strtoupper($this->subName),
                'position' => strtoupper($this->subPosition),
                'phone' => $this->subPhone,
                'IdNumber' => $this->subIdNumber
            ]);
            $this->alert('info', "Staff added successfuly!");
            $this->resetFields();
        } catch (Exception $e) {
            $this->alert('warning', $e->getMessage());
        }
    }
    public function validateDoctor()
    {
        return   $this->validate(
            [
                'subStaffNumber' => 'required',
                'subName' => 'required',
                'subPosition' => 'required',
                'subPhone' => 'required',
                'subIdNumber' => 'required'
            ],
            [
                'subStaffNumber.required' => 'The staff number field is required.',
                'subName.required' => 'The name field is required.',
                'subPosition.required' => 'The position field is required.',
                'subPhone.required' => 'The phone field is required.',
                'subIdNumber.required' => 'The ID number field is required.'
            ]
        );
    }
    public function edit($id)
    {
        $Doctor = DoctorTable::where('id', $id)->first();
        if ($Doctor) {
            $this->subStaffNumber = $Doctor->employeeid;
            $this->subName = $Doctor->name;
            $this->subIdNumber = $Doctor->IdNumber;
            $this->subPhone = $Doctor->phone;
            $this->subPosition = $Doctor->position;
        }
    }
    public function updateSub()
    {
        $this->validateDoctor();
        $Doctor = DoctorTable::where('employeeid', $this->subStaffNumber)->first();
        if ($Doctor) {
            $Doctor->update([
                'name' => strtoupper($this->subName),
                'position' => strtoupper($this->subPosition),
                'phone' => $this->subPhone,
                'IdNumber' => $this->subIdNumber
            ]);
            $this->alert('info', "staff updated successfuly!");
        }
    }
    public function delete($id)
    {
        $Doctor = DoctorTable::where('id', $id)->first();
        if ($Doctor) {
            $Doctor->delete();
            $this->alert('success', 'Staff removed successfuly!');
            $this->resetFields();
        }
    }
}
