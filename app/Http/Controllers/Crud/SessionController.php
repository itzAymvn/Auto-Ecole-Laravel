<?php

namespace App\Http\Controllers\Crud;

use App\Models\User;

use App\Models\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all the session and sort them by date & time, so the top ones are the closest
        $sessions = Session::all()->sortBy('session_date');

        // check if there is a ?student query parameter
        if (request()->has('student_id')) {
            // Get the student id
            $student_id = request()->query('student_id');

            // Get the student
            $student = User::findOrFail($student_id);

            // Get the session of the student
            $sessions = $student->sessions;
            $sessions->student_name = $student->name;
        }

        // for each session, get the instructor name and number of students
        foreach ($sessions as $session) {
            $session->students_count = $session->user->count();
            $session->instructor_name = User::findOrFail($session->instructor_id)->name;
        }

        return view('dashboard.sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get the students
        $students = User::where('type', 'student')->get();

        // Get the instructors
        $instructors = User::where('type', 'instructor')->get();

        // Redirect to the session create page
        return view('dashboard.sessions.create', compact('students', 'instructors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*
            dd($request->all());    

            array:10 [▼ // app\Http\Controllers\Crud\SessionController.php:63
                "_token" => "KxYrZyoOwkrxERtvtYYq9KrsRzoK4ir9FgMXC07m"
                "title" => "Session example"
                "instructor_id" => "2"
                "date" => "2022-05-07"
                "time" => "15:14"
                "location" => "aaa"
                "student_id_1" => "4"
                "student_id_2" => "5"
                "student_id_3" => "19"
                "student_id_4" => "21"
            ]
        */
        // Validate the request
        $request->validate([
            'instructor_id' => 'required|integer|exists:users,id',
            'date' => 'required|string|max:100',
            'time' => 'required|string|max:100',
            'location' => 'required|string|max:100',
            'title' => 'required|string|max:100',
        ]);

        // Create a new session
        $session = new Session();

        // Assign the values to the session object
        $session->title = $request->title;
        $session->instructor_id = $request->instructor_id;
        $session->session_date = $request->date;
        $session->session_time = $request->time;
        $session->session_location = $request->location;

        // Save the session
        $session->save();

        // Get the students ids that are in the request
        $students = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'student_id_') !== false) {
                if (preg_match('/[0-9]+/', $value)) {
                    $students[] = $value;
                }
            }
        }

        // Attach the students to the session
        $session->user()->attach($students);

        // Redirect to the session index page
        return redirect()->route('sessions.index')->with('success', 'La session a été créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Session $session)
    {
        // Get the session details and the students in one query
        $session = Session::with('user')->findOrFail($session->id);

        // Get the students (splitting the query we did above)
        $students = $session->user;

        // Get the instructor
        $instructor = User::findOrFail($session->instructor_id);

        // Redirect to the session show page
        return view('dashboard.sessions.show', compact('session', 'students', 'instructor'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Session $session)
    {
        // Get the session details and the students in one query
        $session = Session::with('user')->findOrFail($session->id);

        // Get the students of the session
        $session_students = $session->user;

        // Get the students that are not in the session
        $students = User::where('type', 'student')->whereNotIn('id', $session->user->pluck('id'))->get();

        // Get the instructors
        $instructors = User::where('type', 'instructor')->get();

        // Redirect to the session show page
        return view('dashboard.sessions.edit', compact('session', 'students', 'session_students', 'instructors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Session $session)
    {

        // valdiating the request
        $request->validate([
            'instructor_id' => 'required|integer|exists:users,id',
            'title' => 'required|string|max:100',
            'date' => 'required|string|max:100',
            'time' => 'required|string|max:100',
            'location' => 'required|string|max:100',
            'is_completed' => 'required|boolean',
        ]);

        // updating the session
        $session->title = $request->title;
        $session->instructor_id = $request->instructor_id;
        // $session->vehicle_id = $request->vehicle_id;
        $session->session_date = $request->date;
        $session->session_time = $request->time;
        $session->session_location = $request->location;
        $session->is_completed = $request->is_completed;

        // saving the session
        if ($session->save()) {
            // redirecting to the sessions show page
            return redirect()->route('sessions.show', $session->id)->with('success', "La session a été modifiée avec succès");
        } else {
            // redirecting to the sessions show page
            return redirect()->route('sessions.show', $session->id)->with('error', "Une erreur s'est produite lors de la modification de la session");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session)
    {
        // findOrFail the session
        $session = Session::findOrFail($session->id);

        // Remove the session from the pivot table
        $session->user()->detach();

        // Delete the session
        $session->delete();



        // Redirect to the sessions index page
        return redirect()->route('sessions.index')->with('success', "La session a été supprimée avec succès");
    }

    /**
     * Add a student to an session
     */
    public function addStudent(Request $request)
    {
        // Find the session
        $session = Session::findOrFail($request->session_id);

        // Attach the student to the session
        $session->user()->attach($request->student_id);

        // Redirect to the sessions show page
        return redirect()->back()->with('success', "L'étudiant a été ajouté avec succès");
    }

    /**
     * 
     * Remove a student from an session
     */
    public function removeStudent(Request $request)
    {
        // Find the session
        $session = Session::findOrFail($request->session_id);

        // Detach the student from the session
        $session->user()->detach($request->student_id);

        // Redirect to the session show page
        return redirect()->back()->with('success', "L'étudiant a été supprimé avec succès");
    }

    /**
     * Update the is_attended field of a student in an session
     */
    public function updateIsAttended(Request $request)
    {
        // Validate the request
        $request->validate([
            'attended' => 'required|boolean',
        ]);

        // Find the session
        $session = Session::findOrFail($request->session_id);

        // Update the result updateExistingPivot($id, array $attributes)
        $session->user()->updateExistingPivot($request->student_id, ['attended' => $request->attended]);

        // Redirect to the sessions show page
        return redirect()->route('sessions.show', $session->id)
            ->with('success', "La présence de l'étudiant a été modifiée avec succès");
    }
}
