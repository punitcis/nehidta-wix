<?php

namespace App\Http\Controllers;

use App\Models\NewEnglandPlace;
use App\Models\NewEnglandState;
use Illuminate\Http\Request;

class NewEnglandController extends Controller

{
//this function adminDashboard is used for rendering the adminPortal 
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }
    


    public function create()
    {
        return view('NewEngland.NewEnglandstate');


    }

public function newEnglandMap()
{
    $states = NewEnglandState::all();
   
    $places = NewEnglandPlace::all()->groupBy('new_england_state_id'); 
    $stateNames = $states->pluck('state', 'id');

    $placesByStateName = $places->mapWithKeys(function ($places, $NewEnglandstateId) use ($stateNames) {
        $stateName = $stateNames[$NewEnglandstateId] ?? 'Unknown';
        return [$stateName => $places];
    });

    return view('NewEngland.NewEnglandMap', compact('states', 'placesByStateName'));
}



public function newEnglandFormStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'geojson' => 'required|file|mimes:json',
        ]);

        $state = new NewEnglandState();
        $state->state = $request->name;


        $publicPath = 'newenglandgeojson/';


        $fileName = $request->file('geojson')->getClientOriginalName();

        $request->file('geojson')->move(public_path($publicPath), $fileName);


        $state->file_path = $publicPath . $fileName;

        $state->save();

        return redirect()->route('NewEnglandstate.create')->with('success', 'State added successfully.');
    }

 

    // public function createNewEnglandPlace()
    // {
    //     $states = NewEnglandState::all(); 
    //     $places = NewEnglandPlace::with('NewEnglandStates')->orderBy('id', 'desc')->paginate(4); 
        
    //     return view('NewEngland.NewEnglandplaces', compact('states','places'));
    // }

    public function storeNewEnglandPlace(Request $request)
    {
        $request->validate([
            'new_england_state_id' => 'required|exists:new_england_states,id',
            'address' => 'required|string|max:255',
            'lat' => 'required|numeric|between:-90,90',
            'lng' => 'required|numeric|between:-180,180',
            'city' => 'required|string|max:255',
            'project_name' => 'required|string|max:255',
            'project_type' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'contact' => 'required|string|max:255',
            'project_link' => 'nullable|url|max:255',
            'facebook_link' => 'nullable|url|max:255',
            'youtube_link' => 'nullable|url|max:255',
            'receipient_name' => 'nullable|string|max:255',
            'project_target' => 'required|array|min:1',
        ], [
            'lat.required' => 'Please provide a valid place.',
        ]);
    
       
        $project_target_string = implode(', ', $request->input('project_target'));
    
 
        NewEnglandPlace::create(array_merge($request->all(), [
            'project_target' => $project_target_string, 
        ]));
    
        return redirect()->route('NewEnglandplaces.create')->with('success', 'Place added successfully.');
    }
    


    public function newEnglandDelete($id)
    {
       $place = NewEnglandPlace::findOrFail($id);
       $place->delete();
   
       return redirect()->route('NewEnglandplaces.create')->with('success', 'Place deleted successfully');
   }

   public function update(Request $request, $id)
   {
       $place = NewEnglandPlace::findOrFail($id);
       
     
       $request->validate([
        'new_england_state_id' => 'required|exists:new_england_states,id',
        'address' => 'required|string|max:255',
        'lat' => 'required|numeric|between:-90,90',
        'lng' => 'required|numeric|between:-180,180',
        'city' => 'required|string|max:255',
        'project_name' => 'required|string|max:255',
        'project_type' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
        'year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
        'contact' => 'required|string|max:255',
        'project_link' => 'nullable|url|max:255',
        'facebook_link' => 'nullable|url|max:255',
        'youtube_link' => 'nullable|url|max:255',
        'receipient_name' => 'nullable|string|max:255',
        'project_target' => 'required|array|min:1'
       ]);
   
    $projectTargetsString = implode(',', $request->project_target);

    $place->update(array_merge($request->all(), ['project_target' => $projectTargetsString]));

   
       return redirect()->route('NewEnglandplaces.create')->with('success', 'Place updated successfully');
   }
   

   public function manageNewEnglandPlace($id = null)
   {

       $states = NewEnglandState::all();
   
       
       if ($id) {
           $place = NewEnglandPlace::findOrFail($id);
         
           $places = NewEnglandPlace::with('NewEnglandStates')->orderBy('id', 'desc')->paginate(4);
           
      
           return view('NewEngland.manageNewEnglandPlace', compact('place', 'states', 'places'));
       }
   
       $places = NewEnglandPlace::with('NewEnglandStates')->orderBy('id', 'desc')->paginate(4);
       
      
       return view('NewEngland.manageNewEnglandPlace', compact('states', 'places'));
   }
    




  // new england map without header/footer

  public function newEnglandMapNew()
{
    $states = NewEnglandState::all();
   
    $places = NewEnglandPlace::all()->groupBy('new_england_state_id'); 
    $stateNames = $states->pluck('state', 'id');

    $placesByStateName = $places->mapWithKeys(function ($places, $NewEnglandstateId) use ($stateNames) {
        $stateName = $stateNames[$NewEnglandstateId] ?? 'Unknown';
        return [$stateName => $places];
    });

    return view('NewEngland.NewEnglandMapNew', compact('states', 'placesByStateName'));
}

}
