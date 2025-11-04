### Usefull comands in laravel
`php artisan serve` 👉 run laravel project <br>
`php artisan migrate:fresh` 👉 drop all the table in the database and generate tables <br>
`php artisan migrate:fresh --seed` 👉 drop all the table in the database and generate tables and also generate dummy data in tables <br>

-------------------------------------------------------------------------------------------------------------------------------------

## Inventory Consumption List Routes
<pre>    
get -> /inventory-consumptions
get -> /inventory-consumptions/{id}
                ♦ request -> MenuItem_Outlet_Inventory table id
                
post -> /inventory-consumptions
                'consumed_quantity' => 'required|numeric|min:0',
                'remark' => 'nullable|string|max:255',
                'menu_item_outlet_inventory_id' => 'required|exists:menu_item_outlet_inventories,id',
                'outlet_id' => 'required|exists:outlets,id',

// // show products items by outlet id
post -> /inventory-consumptions/showByOutlet
                'outlet_id' => 'required|exists:outlets,id',


    
</pre>

-------------------------------------------------------------------------------------------------------------------------------------

## Inventory Management List Routes
<pre>    
get -> /inventories
get -> /inventories/{id}
                ♦ request -> MenuItem_Outlet_Inventory table id
                
post -> /inventories
                'product_name' => 'required|string|max:255',
                'sku' => 'nullable|string|max:255',
                'available_quantity' => 'nullable|numeric|min:0',
                'allow_out_of_stock_sales' => 'nullable|boolean',
                'outlet_id' => 'nullable|exists:outlets,id',

put -> /inventories/{id}
                ♦ request -> MenuItem_Outlet_Inventory table id

                'product_name' => 'required|string|max:255',
                'sku' => 'nullable|string|max:255',
                'available_quantity' => 'nullable|numeric|min:0',
                'allow_out_of_stock_sales' => 'nullable|boolean',
                'outlet_id' => 'nullable|exists:outlets,id',

delete -> /inventories/{id}
                 ♦ request -> MenuItem_Outlet_Inventory table id
    
</pre>

-------------------------------------------------------------------------------------------------------------------------------------

## Unit Measurements List Routes
<pre>    
get -> /unit-measurements
get -> /unit-measurements/{id}
                ♦ request -> unit-measurements table id
                
post -> /unit-measurements
                'measurement_name' => 'required|string|max:255'

put -> /unit-measurements/{id}
                 ♦ request -> unit-measurements table id

                 'measurement_name' => 'required|string|max:255'
               
delete -> /unit-measurements/{id}
                 ♦ request -> unit-measurements table id
    
</pre>

-------------------------------------------------------------------------------------------------------------------------------------

## Menu Management List Routes
<pre>    
get -> /menuLists
get -> /menuLists/{id}
                ♦ request -> MenuManagementList table id
                
post -> /menuLists
                'name' => 'required|string|max:255',
                'menu_item_ids' => 'required|array',  👈 menu_item id
                'outlet_ids' => 'required|array',     👈 outlet id
    
                👨‍🏫exmple resquest: 
                    {
                      "name": "Dinner Specials",
                      "menu_item_ids": [1, 2, 3],
                      "outlet_ids": [1, 2]
                    }

put -> /menuLists/{id}
                 ♦ request -> MenuManagementList table id

                 'name' => 'required|string|max:255',
                 'menu_item_ids' => 'required|array',  👈 menu_item id
                 'outlet_ids' => 'required|array',     👈 outlet id

                👨‍🏫exmple resquest: 
                    {
                      "name": "Dinner Specials",
                      "menu_item_ids": [1, 2, 3],
                      "outlet_ids": [1, 2]
                    }
                 
delete -> /menuLists/{id}
                 ♦ request -> MenuManagementList table id
    
</pre>
-----------------------------------------------------------------------------------------------------------
