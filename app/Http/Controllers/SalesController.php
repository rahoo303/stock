<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Models\Item;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function createSale(SaleRequest $request)
    {
        $saleItems = $request->get('sale_items');
        $sale = [
            'customer_name' => $request->get('customer'),
            'bill_date' => $request->get('bill_date'),
            'mobile' => $request->get('mobile'),
            'amount' => $request->get('amount'),
        ];

        $saleId = Sale::create($sale)->id;
        $this->saveSaleEntry($saleId,  $saleItems);
        return response()->json([
            'message' => 'Sales created',
        ], 200);
    }

    private function saveSaleEntry($saleId,  $saleItems)
    {
        if (!empty($saleItems) && count($saleItems) > 0) {
            foreach ($saleItems as $row) {
                if (!empty($row["item_id"])) {
                    SaleItem::create([
                        'sale_id' => $saleId,
                        'item_id' => $row["item_id"],
                        'qty' => $row["qty"],
                        'amount' => $row["price"],
                    ]);
                    $stock = Item::where('id', $row["item_id"])->value('stock');
                    $stock = ($stock - $row["qty"]);
                    Item::where('id', $row["item_id"])->update(['stock' => $stock]);
                }
                
            }
           
        }
    }

    public function getSales(Request $request)
    {
        $sales = Sale::all();
        return response()->json([
            'sales' => $sales,
        ], 200);
    }
}
