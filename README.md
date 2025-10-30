### Usefull comands in laravel
`php artisan serve` 👉 run laravel project <br>
`php artisan migrate:fresh` 👉 drop all the table in the database and generate tables <br>
`php artisan migrate:fresh --seed` 👉 drop all the table in the database and generate tables and also generate dummy data in tables <br>

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
