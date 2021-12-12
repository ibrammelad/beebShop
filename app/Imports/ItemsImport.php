<?php

namespace App\Imports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class ItemsImport implements ToModel , WithHeadingRow , WithValidation
{
  use Importable;

    public function model(array $row)
    {
        return new Item([
          'name'                   =>$row['name'],
          'description'            =>$row['description'],
          'quantity_type'          => $row['quantity_type'],
          'quantity'               => $row['quantity'],
          'price'                  => $row['price'],
          'discount'               => $row['discount'],
          'status'                 => $row['status'],
          'category_id'            => $row['category_id'],
          'cost1'                  => $row['cost1'] ,
          'cost2'                  => $row['cost2'],
          'cost3'                  => $row['cost3'],
          'pricebypoint'           => $row['pricebypoint'],
          'is_offer'               => $row['is_offer'],
          'image'  => "download.jpg",

        ]);
    }

  public function rules(): array
  {
    return[
      '*.name'=>'required',
      '*.description' => 'required' ,
      '*.quantity_type' => 'required' ,
      '*.category_id' =>'required|exists:categories,id',
      '*.quantity'=>'required|numeric',
      '*.price'=>'required|numeric',
      '*.discount'=>'required|numeric',
      '*.cost1'=>'required|numeric',
      '*.cost2'=>'required|numeric',
      '*.cost3'=>'required|numeric',
      '*.pricebypoint'=>'required|numeric',
      '*.status' => 'in:1,0',
    ];
  }

  public function onError(Throwable $e)
  {
    // TODO: Implement onError() method.
  }

  public function onFailure(Failure ...$failures)
  {
    // TODO: Implement onFailure() method.
  }
}
