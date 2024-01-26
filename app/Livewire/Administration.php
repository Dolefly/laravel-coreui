<?php

namespace App\Livewire;

use App\Models\InsuaranceTable;
use Exception;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Administration extends Component
{
    use LivewireAlert;
    public $InsuaranceList, $insuaranceCompanyName, $insuaranceContactPerson, $insuarancePhone, $insuaranceCode;
    public $selectedInsurer,$modalTitle="Add";
    public function mount()
    {
        $results = InsuaranceTable::all();
        $this->InsuaranceList = $results;
    }
    public function render()
    {
        return view('livewire.administration');
    }
    public function validateInsuarance()
    {

        return $this->validate([
            'insuaranceCode' => 'required',
            'insuaranceCompanyName' => 'required',
            'insuaranceContactPerson' => 'required',
            'insuarancePhone' => 'required',
        ]);
        //dd("here");
    }

    public function saveInsuarance(){
        if($this->modalTitle=="Add"){
            $this->addInsuarance();
        }
        else if($this->modalTitle=="Update"){
            $this->updateInsuarance();
        }
    }
    public function addInsuarance()
    {

        try {
            $this->validateInsuarance();
            $insure = InsuaranceTable::create([
                'code' => $this->insuaranceCode,
                'name' =>strtoupper( $this->insuaranceCompanyName),
                'contact_name' => strtoupper($this->insuaranceContactPerson),
                'phone' => $this->insuarancePhone
            ]);
            if ($insure) {
                $this->alert('info', $this->insuaranceCompanyName . ' saved successfuly');
                $this->clearInsuarance();
            } else {
                $this->alert('warning', 'Failed to save, check and try again!');
            }
        } catch (Exception $e) {
            // Check if the exception message contains the specific code
            if (strpos($e->getMessage(), '1062') !== false) {
                // Handle the specific case when the message contains the code
                $this->alert('warning', 'The Insuarance with the same code exist!');
            } else {
                // Handle other exceptions or provide a generic error message
                $this->alert('warning', "An error occurred: " . $e->getMessage());
            }
        }
    }
    public function updateInsuarance(){
        $this->validateInsuarance();
        $insurer = InsuaranceTable::where('id',$this->selectedInsurer)->first();
        if($insurer){
            $insurer->update([
                'name' =>strtoupper( $this->insuaranceCompanyName),
                'contact_name' => strtoupper($this->insuaranceContactPerson),
                'phone' => $this->insuarancePhone
            ]);
            $this->alert('info', $this->insuaranceCompanyName . ' updated successfuly');
                $this->clearInsuarance();
        }
    }
    public function clearInsuarance()
    {
        $this->insuaranceCompanyName = null;
        $this->insuaranceContactPerson = null;
        $this->insuarancePhone = null;
        $this->insuaranceCode=null;
        $this->modalTitle="Add";
    }
    public function editInsurer($id){
        $this->selectedInsurer=$id;
        $insurer=InsuaranceTable::where('id',$id)->first();
        if($insurer){
            $this->insuaranceCode=$insurer->code;
            $this->insuaranceCompanyName=$insurer->name;
            $this->insuaranceContactPerson=$insurer->contact_name;
            $this->insuarancePhone=$insurer->phone;

            $this->modalTitle="Update";
            
        }
    }
    public function deleteInsure($id){
        $insurer=InsuaranceTable::where('id',$id)->first();
        if($insurer){
            $insurer->delete();
            $this->alert('success','Insuarance Removed Successfuly!');
        }
    }
}
