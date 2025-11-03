## Menu Item Routes
<pre>    
get -> /menu-items
get -> /menu-items/{id}
                ♦ request -> menu_items table id
                
post -> /menu-items
                'name' => 'required|string|max:255',
                'is_visible' => 'boolean | default:true',
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

put -> /menu-items/{id}
                 ♦ request -> menu_items table id

                'name' => 'required|string|max:255',
                'is_visible' => 'boolean | default:true',
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
                'variant_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                // Inventory fields
                'sku' => 'nullable|string|max:100',
                'available_quantity' => 'nullable|numeric|min:0',
                'allow_out_of_stock_sales' => 'nullable|boolean',

put -> /variants/{id}
                 ♦ request -> variants table id

                'menu_item_id' => 'required|exists:menu_items,id',
                'variant_name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'compare_at_price' => 'nullable|numeric|min:0',
                'track_inventory_enabled' => 'required|boolean',
                'variant_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                // Inventory fields
                'sku' => 'nullable|string|max:100',
                'available_quantity' => 'nullable|numeric|min:0',
                'allow_out_of_stock_sales' => 'nullable|boolean',
                 
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
