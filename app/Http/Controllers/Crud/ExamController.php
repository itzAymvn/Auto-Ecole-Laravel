<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;

use App\Models\Exam;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::all();
        // for each exam, get the instructor name and number of students
        foreach ($exams as $exam) {
            $exam->students_count = $exam->user->count();
            $exam->instructor_name = User::find($exam->instructor_id)->name;
        }
        return view('dashboard.exams.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // redirect to the exams index page with a list of users and vehicles
        $students = User::where('type', 'student')->get();
        $instructors = User::where('type', 'instructor')->get();
        $vehicles = Vehicle::all();
        return view('dashboard.exams.create', compact('students', 'instructors', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate the request
        $request->validate([
            'title' => 'required',
            'instructor_id' => 'required',
            'vehicle_id' => 'required',
            'type' => 'required',
            'date' => 'required',
            'time' => 'required',
            'location' => 'required',
        ]);

        // Create a new exam object
        $exam = new Exam();

        // Assign the values to the exam object
        $exam->exam_title = $request->title;
        $exam->instructor_id = $request->instructor_id;
        $exam->vehicle_id = $request->vehicle_id;
        $exam->exam_type = $request->type;
        $exam->exam_date = $request->date;
        $exam->exam_time = $request->time;
        $exam->exam_location = $request->location;

        // Save the exam
        $exam->save();

        // Get the students ids that are in the request
        $students = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'student_id_') !== false) {
                if (preg_match('/[0-9]+/', $value)) {
                    $students[] = $value;
                }
            }
        }

        // Attach the students to the exam
        $exam->user()->attach($students);

        // Redirect to the exams index page
        return redirect()->route('exams.index')->with('success', 'Exam created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        // Get the exam, instructor and vehicle and the students (using the pivot table)
        $exam = Exam::with('user')->find($exam->id);
        $instructor = User::find($exam->instructor_id);
        $vehicle = Vehicle::find($exam->vehicle_id);
        $students = $exam->user;

        // Redirect to the exams show page
        return view('dashboard.exams.show', compact('exam', 'instructor', 'vehicle', 'students'));
    }

    /**
     * Remove a student from an exam
     */

    public function removeStudent(Request $request)
    {
        $exam = Exam::find($request->exam_id);
        $exam->user()->detach($request->student_id);

        return redirect()->route('exams.show', $exam->id)->with('success', 'Student removed from exam successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
