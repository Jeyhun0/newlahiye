<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function index(){
        // $user = new User();
        // $user->name="Test";
        // $user->username="test";
        // $user->email="test@gmail.com";
        // $user->password="admin123";
        // $user->save();

        // $user=User::find(1);
        // $user->password=Hash::make('password123');;
        // $user->save();

        // $category = new Category();
        // $category->name="testCategory";
        // $category->slug="test-category";
        // $category->save();

        // $customer=new Customer();
        // $customer->name="testCustomer";
        // $customer->email="testcustomer@gmail.com";
        // $customer->phone=3456788889;
        // $customer->address="Baki ş";
        // $customer->save();

        // $unit=new Unit();
        // $unit->name="testUnit";
        // $unit->slug="unit";
        // $unit->short_code=3456;
        // $unit->save();

        dd(DB::table('products')->get());
    }
}
