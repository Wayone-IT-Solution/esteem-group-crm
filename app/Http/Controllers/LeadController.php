<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeadController extends Controller
{
          //show leads table data
  public function showallleads()
    {
       
        return view('leads.list');
    }

      public function addleads()
    {
       
        return view('leads.add');
    }
}
