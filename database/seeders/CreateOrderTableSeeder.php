<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Order;
use App\OrderTicket;
use Carbon\Carbon;

class CreateOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Order::insert([
      //   [
      //     'order_number' => '2004',
      //     'user_id' => 4,
      //     'ticket_fee_percentage' => 9,
      //     'total_ticket_fee' => 3.6,
      //     'total_ticket_price' => 43.6,
      //     'total_admin_comission' => 3.92, 
      //     'total_organizer_comission' => 39.67,
      //     'first_name' => 'demo3',
      //     'last_name' => 'demo33', 
      //     'email' => 'demo3@gmail.com',
      //     'payment_method' => 'paypal',
      //     'payment_status' => 1,
      //     'order_status' => 1,
      //     'created_at' => Carbon::now()->subDays(4),
      //     'updated_at' => Carbon::now()->subDays(4)
      //   ],
      //   [
      //     'order_number' => '2005',
      //     'user_id' => 2,
      //     'ticket_fee_percentage' => 9,
      //     'total_ticket_fee' => 1.8,
      //     'total_ticket_price' => 21.80,
      //     'total_admin_comission' => 1.96, 
      //     'total_organizer_comission' => 19.83,
      //     'first_name' => 'user',
      //     'last_name' => 'userr', 
      //     'email' => 'user@user.com',
      //     'payment_method' => 'paypal',
      //     'payment_status' => 1,
      //     'order_status' => 1,
      //     'created_at' => Carbon::now()->subDays(3),
      //     'updated_at' => Carbon::now()->subDays(3)
      //   ],
      //   [
      //     'order_number' => '2006',
      //     'user_id' => 4,
      //     'ticket_fee_percentage' => 9,
      //     'total_ticket_fee' => 1.8,
      //     'total_ticket_price' => 21.80,
      //     'total_admin_comission' => 1.96, 
      //     'total_organizer_comission' => 19.83,
      //     'first_name' => 'demo3',
      //     'last_name' => 'demo33', 
      //     'email' => 'demo3@gmail.com',
      //     'payment_method' => 'paypal',
      //     'payment_status' => 1,
      //     'order_status' => 1,
      //     'created_at' => Carbon::now()->subDays(2),
      //     'updated_at' => Carbon::now()->subDays(2)
      //   ],
      // ]);

      // OrderTicket::insert([
      //   [
      //     'order_id' => 1,
      //     'event_id' => 1,
      //     'ticket_type' => 'paid',
      //     'no_of_tickets' => 2,
      //     'unit_price' => 20,
      //     'ticket_fee_percentage' => 9,
      //     'ticket_fee' => 3.6,
      //     'ticket_price' => 43.6,
      //     'admin_comission' => 3.92, 
      //     'organizer_comission' => 39.67,
      //     'created_at' => Carbon::now()->subDays(4),
      //     'updated_at' => Carbon::now()->subDays(4)
      //   ],
      //   [
      //     'order_id' => 2,
      //     'event_id' => 3,
      //     'ticket_type' => 'paid',
      //     'no_of_tickets' => 2,
      //     'unit_price' => 10,
      //     'ticket_fee_percentage' => 9,
      //     'ticket_fee' => 1.8,
      //     'ticket_price' => 21.80,
      //     'admin_comission' => 1.96, 
      //     'organizer_comission' => 19.83,
      //     'created_at' => Carbon::now()->subDays(4),
      //     'updated_at' => Carbon::now()->subDays(4)
      //   ],
      //   [
      //     'order_id' => 3,
      //     'event_id' => 3,
      //     'ticket_type' => 'paid',
      //     'no_of_tickets' => 2,
      //     'unit_price' => 10,
      //     'ticket_fee_percentage' => 9,
      //     'ticket_fee' => 1.8,
      //     'ticket_price' => 21.80,
      //     'admin_comission' => 1.96, 
      //     'organizer_comission' => 19.83,
      //     'created_at' => Carbon::now()->subDays(4),
      //     'updated_at' => Carbon::now()->subDays(4)
      //   ],
      //   [
      //     'order_id' => 3,
      //     'event_id' => 2,
      //     'ticket_type' => 'free',
      //     'no_of_tickets' => 2,
      //     'unit_price' => 0,
      //     'ticket_fee_percentage' => 9,
      //     'ticket_fee' => 0,
      //     'ticket_price' => 0,
      //     'admin_comission' => 0, 
      //     'organizer_comission' => 0,
      //     'created_at' => Carbon::now()->subDays(4),
      //     'updated_at' => Carbon::now()->subDays(4)
      //   ],
      // ]);
    }
}
