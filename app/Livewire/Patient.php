<?php

namespace App\Livewire;

use App\Models\InsuaranceTable;
use Livewire\Component;

class Patient extends Component
{
    public $insuarence;
    public $patientName,$dob,$gender,$guardianName,$idNumber,$phone,$insurer,$residence,$county;
    public function mount(){
        $this->insuarence=InsuaranceTable::all();
    }
    public function validatePatient(){
        $this->validate([
            'patientName'=>'required',
            'dob'=>'required',
            'gender'=>'required',
            'guardianName'=>'required',
            'idNumber'=>'required',
            'phone'=>'required',
            'insurer'=>'required',
            'residence'=>'required',
            'county'=>'required'
        ]);
    }
    public function render()
    {
        return view('livewire.patient');
    }
    public function savePatient(){
        $this->validatePatient();
    }
}
