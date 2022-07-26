Now you can write a query in CodeIgniter.
Note: $this->db->select(‘*’) means you are getting all columns from both tables

this->db->select('*');
$this->db->from('users');
$this->db->join('comments','comments.user_id = users.u_id');
$this->db->get();
This chaining (in Codeigniter) means you can chaining multiple methods by using a single statement.
$this->db->select('*')
->from('users')
->join('comments','comments.user_id = users.u_id')
->get();
If you want to use left outer join OR left join, pass the third parameter in join() function/method using Codeigniter.
$this->db->select('*')
->from('users')
->join('comments','comments.user_id = users.u_id','left')//this is the left join in codeigniter
->get();
If you want to use the right outer join in Codeigniter OR right join in Codeigniter, pass the third parameter in join() function/method.
$this->db->select('*')
->from('users')
->join('comments','comments.user_id = users.u_id','right')//this is the right join in codeigniter
->get();
What can you do if you want to join more than two tables? It’s simple; I use the third table named a city in this example.
$this->db->select('*')
->from('users')
->join('comments','comments.user_id = users.u_id')
->join('city','city.user_id = users.u_id')
->get();
You can also use the WHERE clause
$this->db->select('*')
->from('users')
->where('users.u_id',1)
->join('comments','comments.user_id = users.u_id')
->join('city','city.user_id = users.u_id')
->get();
joins/multiple joins with a group by in Codeigniter
$this->db->query("select table1.ud_id,table1.ud_date,table1.up_lat_profit_date,table1.ud_currency
                  ,sum(table1.ud_amount*table3.dp_percentage/100) as profit
               from table1
               JOIN `table2` ON `table2`.`deposit_id` = `table1`.`ud_id`
               JOIN `table3` ON `table3`.`dp_id` = `table2`.`daily_profit_id`
               where `table1`.`ud_status` = 1
               AND `table3`.`dp_status` = 1
               AND `table1`.`user_plan_id` = $up_id
               AND table2.pr_status = 1
               group by table1.ud_id");
How can use joins in codeigniter4/CI4
$machineInfoTable =  new ModMachineInfo();//creating the instance
            $data['catData'] = $machineInfoTable->distinct()->
            select('
                           mi_id,mi_slug,mi_name,mi_machine_condition,(select categories.c_name from categories where categories.c_id=machine_info.machine_category) as categoryName,
                           categories.c_name,categories.c_slug
                            ')
                ->where('mi_status',1)
                ->where('machine_category IN (SELECT categories.c_id from categories where categories.c_status = 1 and categories.c_slug="'.$slug.'")')
                ->orderBy('machine_info.mi_id','desc')
                ->join('categories','categories.c_id=machine_info.machine_category')->findAll();
 
