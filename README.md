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
                'product_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'outlet_id' => 'required|exists:outlets,id',
                'sku' => 'nullable|string|max:255',
                'available_quantity' => 'nullable|numeric|min:0',
                'allow_out_of_stock_sales' => 'nullable|boolean',
                'outlet_id' => 'required|exists:outlets,id',

put -> /inventories/{id}
                ♦ request -> MenuItem_Outlet_Inventory table id

                'product_name' => 'required|string|max:255',
                'product_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'outlet_id' => 'required|exists:outlets,id',
                'sku' => 'nullable|string|max:255',
                'available_quantity' => 'nullable|numeric|min:0',
                'allow_out_of_stock_sales' => 'nullable|boolean',
                'outlet_id' => 'required|exists:outlets,id',

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
## Menu Item Routes
<pre>    
get -> /menu-items
get -> /menu-items/{id}
                ♦ request -> menu_items table id
                
post -> /menu-items
                'name' => 'required|string|max:255',
                'is_visible' => 'boolean | default:true',
                'menuItem_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'category_id' => 'required|exists:menu_categories,id',
                'subcategory_id' => 'nullable|exists:menu_subcategories,id',
                'price' => 'required|numeric|min:0',
                'compare_at_price' => 'nullable|numeric|min:0',
                'type' => 'required|in:Veg,Non_veg',
                'product_code' => 'nullable|string|max:100',
                'description' => 'nullable|string',
                'track_inventory_enabled' => 'boolean',
                // Inventory fields
                'sku' => 'nullable|string|max:100',
                'available_quantity' => 'nullable|numeric|min:0',
                'allow_out_of_stock_sales' => 'nullable|boolean',

                'outlet_id' => 'required|exists:outlets,id',

put -> /menu-items/{id}
                 ♦ request -> menu_items table id

                'name' => 'required|string|max:255',
                'is_visible' => 'boolean | default:true',
                'menuItem_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'category_id' => 'required|exists:menu_categories,id',
                'subcategory_id' => 'nullable|exists:menu_subcategories,id',
                'price' => 'required|numeric|min:0',
                'compare_at_price' => 'nullable|numeric|min:0',
                'type' => 'required|in:Veg,Non_veg',
                'product_code' => 'nullable|string|max:100',
                'description' => 'nullable|string',
                'track_inventory_enabled' => 'boolean',
                // Inventory fields
                'sku' => 'nullable|string|max:100',
                'available_quantity' => 'nullable|numeric|min:0',
                'allow_out_of_stock_sales' => 'nullable|boolean',

                'outlet_id' => 'required|exists:outlets,id',
                 
delete -> /menu-items/{id}
                 ♦ request -> menu_items table id
    
</pre>
-----------------------------------------------------------------------------------------------------------

## Menu Category Routes
<pre>    
get -> /categories
get -> /categories/{id}
                ♦ request -> categories table id
                
post -> /categories
                'name' => 'required|string|max:255|unique:menu_categories,name',
                'description' => 'nullable|string',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 

put -> /categories/{id}
                 ♦ request -> categories table id

                'name' => 'required|string|max:255|unique:menu_categories,name',
                'description' => 'nullable|string',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
                 
delete -> /categories/{id}
                 ♦ request -> categories table id
    
</pre>
-----------------------------------------------------------------------------------------------------------

## Menu Subcategory Routes
<pre>    
get -> /subcategories
get -> /subcategories/{id}
                ♦ request -> Subcategory table id
                
post -> /subcategories
                'name' => 'required|string|max:255|unique:menu_subcategories,name',
                'category_id' => 'required|exists:menu_categories,id',
                'description' => 'nullable|string',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

put -> /subcategories/{id}
                 ♦ request -> Subcategory table id

                'name' => 'required|string|max:255|unique:menu_subcategories,name',
                'category_id' => 'required|exists:menu_categories,id',
                'description' => 'nullable|string',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                 
delete -> /subcategories/{id}
                 ♦ request -> Subcategory table id
    
</pre>
-----------------------------------------------------------------------------------------------------------

## Menu Variant Routes
<pre>    
get -> /variants
get -> /variants/{id}
                ♦ request -> variants table id
                
post -> /variants
                'menu_item_id' => 'required|exists:menu_items,id',
                'variant_name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'compare_at_price' => 'nullable|numeric|min:0',
                'track_inventory_enabled' => 'required|boolean',
                // Inventory fields
                'sku' => 'nullable|string|max:100',
                'available_quantity' => 'nullable|numeric|min:0',
                'allow_out_of_stock_sales' => 'nullable|boolean',

                'outlet_id' => 'required|exists:outlets,id',

put -> /variants/{id}
                 ♦ request -> variants table id

                'menu_item_id' => 'required|exists:menu_items,id',
                'variant_name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'compare_at_price' => 'nullable|numeric|min:0',
                'track_inventory_enabled' => 'required|boolean',
                // Inventory fields
                'sku' => 'nullable|string|max:100',
                'available_quantity' => 'nullable|numeric|min:0',
                'allow_out_of_stock_sales' => 'nullable|boolean',
    
                'outlet_id' => 'required|exists:outlets,id',
                 
delete -> /variants/{id}
                 ♦ request -> variants table id
    
</pre>
-----------------------------------------------------------------------------------------------------------

## Order Items Routes
<pre>
get -> /orderItems
get -> /orderItems/{id}
                 ♦ request -> orderItems table id
    
post -> /orderItems
                'item_name' => 'required|string|max:255',
                'qty' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0',
                'total_price' => 'required|numeric|min:0',
                'order_id' => 'required|exists:orders,id',
    
put -> /orderItems/{id}
                 ♦ request -> orderItems table id
    
                'item_name' => 'required|string|max:255',
                'qty' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0',
                'total_price' => 'required|numeric|min:0',
                'order_id' => 'required|exists:orders,id',
    
delete -> /orderItems/{id}
                 ♦ request -> orderItems table id
    
</pre>
