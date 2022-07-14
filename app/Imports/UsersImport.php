<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Notifications\NotifyRahulAndAksharaOfCompletedImport;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;


use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;

class UsersImport implements ToCollection, WithChunkReading, SkipsOnFailure, ShouldQueue, WithHeadingRow
{
    use Importable, SkipsFailures;

    public $columnCount = 0;
    public $header;

    public function __construct()
    {

        $this->messages = [

        ];
    }

    /**
    * @return array
    */
    public function rules(): array
    {
        return [
            'user_code' => 'required',
            'user_name' => 'required|regex:/^[a-zA-Z]+$/u',
            'user_address' => 'required|regex:/^[a-zA-Z]+$/u',
       ];
    }

    /**
     * @return int
     */
    // public function startRow(): int
    // {
    //     return 2;
    // }

    public function collection(Collection $rows)
    {    
        $this->header = $rows->first();

        $this->columnCount = $this->header->count();

        /*Prepare batches for big data sets*/
        $recordBatches = array_chunk($rows->toArray(), 200);

        foreach ($recordBatches as $recordBatch) {
            User::insert($recordBatch);
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }


     /**
     * @param Failure[] $failures
     */
    public function onFailure(Failure ... $failures)
    {
        // dd($failures);
        // Handle the failures how you'd like.
    }
}
