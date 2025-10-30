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

put -> /variants/{id}
                 ♦ request -> variants table id
                 
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
