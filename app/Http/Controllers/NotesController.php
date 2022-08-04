<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\notes;
use Illuminate\support\Facades\Hash;

class NotesController extends Controller
{
    //API Function to create notes

    public function CreateNotes(Request $request)
    {
        $request->validate( [
            'Title' => 'required | string | max:50',
            'Description' => 'required | string |max:1000',
        ]);
        
        $notes = notes::create([
            'Title' => $request->Title,
            'Description' => $request->Description
        
        ]);
        return response()->json([
            'message' => 'Notes created successfully',
            'notes' => $notes
        ], 200);
    }

    // API Function to display notes
    public function displayNotes()
    {
        $notes = notes::all();
        return response()->json(['success' => $notes]);

    }

     // API Function to display notes by ID
     public function displayNotes_ID($id)
     {
         $notes = notes::find($id);
         if($notes)
         {
             return response()->json(['success' => $notes]);
         }
         else
         {
             Log::channel('custom')->info("No Notes Found with that ID");
             return response()->json(['Message' => "No Notes found with that ID"]);
         }
     }

     // API Function to Update notes by ID
    public function updateNotes_ID(Request $request, $id)
    {
       
        //validating the data to make it not to be null
        $request->validate( [
            'Title' => 'required | string | max:50',
            'Description' => 'required | string |max:1000',
        ]);

        $notes = notes::find($id);
        if($notes)
        {
            $notes->Title = $request->Title;
            $notes->Description = $request->Description;
            
            $notes ->update();
            return response()->json(['message'=>'Notes Updated Successfully'],200);
        }
        else
        {
            Log::channel('custom')->info("No Notes Found with that ID");
            return response()->json(['message'=>'No Notes Found with that ID'],404);
        }
      
    }

    public function deleteNotes_ID(Request $request, $id)
    {       
        $notes = notes::find($id);
        if($notes)
        {
            $notes ->delete();
            return response()->json(['message'=>'Data Deleted Successfully'],200);
        }
        else
        {
            Log::channel('custom')->info("No Notes Found with that ID");
            return response()->json(['message'=>'No Data Found with that ID'],404);
        }
    }
}