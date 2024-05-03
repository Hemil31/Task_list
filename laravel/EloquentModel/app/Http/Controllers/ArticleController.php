<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Examine;
use App\Models\Flight;
use App\Models\Softdel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;


class ArticleController extends Controller
{
    public function store(Request $request)
    {
        $article = Articles::create([
            'title' => $request->title
        ]);

        return response()->json($article);
    }

    public function index()
    {
        $articles = Articles::all();

        return response()->json($articles);
    }


    public function show()
    {

        // Retrieve flights to Paris
        $flights = Flight::where('destination', 'Paris')->get();

        // Output the count of flights
        echo "Total Flights to Paris: " . $flights->count() . "\n";

        // Output the names of all non-cancelled flights to Paris
        echo "Non-cancelled Flights:\n";
        foreach ($flights as $flight) {
            if (!$flight->cancelled) {
                echo "- $flight->name\n";
            }
        }

        // Use the reject method to remove cancelled flights
        $nonCancelledFlights = $flights->reject(function ($flight) {
            return $flight->cancelled;
        });

        echo "Filtered Flights (Cancelled Flights Removed):\n";
        foreach ($nonCancelledFlights as $flight) {
            echo "- $flight->name\n";
        }

        // Use the map method to transform flight names
        $flightNames = $flights->map(function ($flight) {
            return strtoupper($flight->name);
        });

        echo "Flight Names Uppercased:\n";
        foreach ($flightNames as $name) {
            echo "- $name\n";
        }

        // Use the first method to retrieve the first flight
        $firstFlight = $flights->first();
        echo "First Flight: $firstFlight->name\n";

        // Use the last method to retrieve the last flight
        $lastFlight = $flights->last();
        echo "Last Flight: $lastFlight->name\n";

        Flight::chunk(200, function (Collection $flights) {
            foreach ($flights as $flight) {
                // Process each flight
                echo "Processing flight: $flight->name\n";
            }
        });
    }

    public function lazy()
    {


        // Flight::departedFlights()->lazyById(200, 'id')->each(function ($flight) {
        //     // For demonstration, let's update the flight's status
        //     $flight->update(['departed' => false]);
        // });

        // return response()->json(['message' => 'Flights updated successfully']);
        $users = Flight::cursor()->filter(function ($user) {
            return $user->id > 3; // Filter users with id greater than 500
        });

        foreach ($users as $user) {
            echo $user->id . ': ' . $user->name . "\n"; // Printing user id and name
        }
    }


    public function demo()
    {
        // Create a new user
        $user = Examine::create([
            'first_name' => 'Taylor',
            'last_name' => 'Otwell',
            'title' => 'Developer',
        ]);

        // Change the title
        $user->title = 'Painter';

        // Check if user is dirty (changed)
        dump($user->isDirty()); // true
        dump($user->isDirty('title')); // true
        dump($user->isDirty('first_name')); // false
        dump($user->isDirty(['first_name', 'title'])); // true

        // Check if user is clean (unchanged)
        dump($user->isClean()); // false
        dump($user->isClean('title')); // false
        dump($user->isClean('first_name')); // true
        dump($user->isClean(['first_name', 'title'])); // false

        // Save the changes
        $user->save();

        // Check if user is dirty after save
        dump($user->isDirty()); // false
        dump($user->isClean()); // true

        // Check if attributes were changed after save
        dump($user->wasChanged()); // true
        dump($user->wasChanged('title')); // true
        dump($user->wasChanged(['title', 'slug'])); // true
        dump($user->wasChanged('first_name')); // false
        dump($user->wasChanged(['first_name', 'title'])); // true

        // Get original attributes
        dump($user->getOriginal('name')); // null, as 'name' doesn't exist
        dump($user->getOriginal()); // Original attributes of the user
    }

    public function indexone()
    {
        $flights = Softdel::withTrashed()->get();


        return view('softdel', compact('flights'));
    }

    public function destroy($id)
    {
        
        $flight = Softdel::findOrFail($id);
        $flight->delete(); // Soft deletes the flight
        return redirect()->route('flights.index')->with('success', 'Flight deleted successfully');
    }

    public function restore($id)
    {
        $flight = Softdel::withTrashed()->findOrFail($id);
        $flight->restore(); // Restores the soft deleted flight
        return redirect()->route('flights.index')->with('success', 'Flight restored successfully');
    }
}
