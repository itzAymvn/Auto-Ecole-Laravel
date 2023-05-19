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
        // Get all the exams
        $exams = Exam::all();

        // check if there is a ?student query parameter
        if (request()->has('student_id')) {
            // Get the student id
            $student_id = request()->query('student_id');

            // Get the student
            $student = User::findOrFail($student_id);

            // Get the exams of the student
            $exams = $student->exams;
            $exams->student_name = $student->name;
        }

        // for each exam, get the instructor name and number of students
        foreach ($exams as $exam) {
            $exam->students_count = $exam->user->count();
            $exam->instructor_name = User::findOrFail($exam->instructor_id)->name;

            // if the exam has a vhicle id (so it' a drive exam) get the vehicle
            if ($exam->vehicle_id) {
                $exam->vehicle = Vehicle::findOrFail($exam->vehicle_id);
            }
        }

        // Redirect to the exams index page
        return view('dashboard.exams.index', compact('exams'));
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

        // Get the vehicles
        $vehicles = Vehicle::all();

        // Redirect to the exams create page
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
            'instructor_id' => 'exists:users,id',
            'type' => 'required|in:drive,code',
            'vehicle_id' => 'required_if:type,==,drive|exists:vehicles,id',
            'date' => 'required',
            'time' => 'required',
            'location' => 'required',
        ]);

        // Create a new exam object
        $exam = new Exam();

        // Assign the values to the exam object
        $exam->exam_title = $request->title;
        $exam->instructor_id = $request->instructor_id;

        // Check if the request has a vehicle id
        if ($request->has('vehicle_id')) {
            $exam->vehicle_id = $request->vehicle_id;
        }

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
        return redirect()->route('exams.index')->with('success', 'L\'examen a été créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        // Get the exam details and the students in one query
        $exam = Exam::with('user')->findOrFail($exam->id);

        // Get the students (splitting the query we did above)
        $students = $exam->user;

        // Get the instructor
        $instructor = User::findOrFail($exam->instructor_id);

        // Get the vehicle if the type is drive
        if ($exam->exam_type == 'drive') {
            $vehicle = Vehicle::findOrFail($exam->vehicle_id);
        } else {
            $vehicle = false;
        }

        // Redirect to the exams show page
        return view('dashboard.exams.show', compact('exam', 'instructor', 'vehicle', 'students'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        // Get the exam details and the students in one query
        $exam = Exam::with('user')->findOrFail($exam->id);

        // Get the students of the exam
        $exam_students = $exam->user;

        // Get the students that are not in the exam
        $students = User::where('type', 'student')->whereNotIn('id', $exam->user->pluck('id'))->get();

        // Get the instructors
        $instructors = User::where('type', 'instructor')->get();

        // Get the vehicles if the type is drive
        if ($exam->exam_type == 'drive') {
            $vehicles = Vehicle::all();
        } else {
            $vehicles = false;
        }

        // Redirect to the exams show page
        return view('dashboard.exams.edit', compact('exam', 'instructors', 'vehicles', 'exam_students', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {

        // valdiating the request
        $request->validate([
            'exam_title' => 'required',
            'exam_date' => 'required',
            'exam_time' => 'required',
            'exam_location' => 'required',
            'instructor_id' => 'required|exists:users,id',
            'vehicle_id' => 'required_if:exam_type,==,drive|exists:vehicles,id',
        ]);

        // updating the exam
        $exam->exam_title = $request->exam_title;
        $exam->exam_date = $request->exam_date;
        $exam->exam_time = $request->exam_time;
        $exam->exam_type = $request->exam_type;
        $exam->exam_location = $request->exam_location;
        $exam->instructor_id = $request->instructor_id;

        // checking if the request has a vehicle id
        if ($request->has('vehicle_id')) {
            $exam->vehicle_id = $request->vehicle_id;
        }


        // saving the exam
        if ($exam->save()) {
            // redirecting to the exams show page
            return redirect()->route('exams.show', $exam->id)->with('success', 'L\'examen a été mis à jour avec succès');
        } else {
            // redirecting to the exams show page
            return redirect()->route('exams.show', $exam->id)->with('error', 'Une erreur est survenue lors de la mise à jour de l\'examen');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        // findOrFail the exam 
        $exam = Exam::findOrfail($exam->id);

        // Delete the exam
        $exam->delete();

        // Redirect to the exams index page
        return redirect()->route('exams.index')->with('success', "L'examen a été supprimé avec succès");
    }

    /**
     * Add a student to an exam
     */
    public function addStudent(Request $request)
    {
        // Find the exam
        $exam = Exam::findOrFail($request->exam_id);

        // Attach the student to the exam
        $exam->user()->attach($request->student_id);

        // Redirect to the exams show page
        return redirect()->back()->with('success', "L'étudiant a été ajouté avec succès");
    }

    /**
     * 
     * Remove a student from an exam
     */
    public function removeStudent(Request $request)
    {
        // Find the exam
        $exam = Exam::findOrFail($request->exam_id);

        // Detach the student from the exam
        $exam->user()->detach($request->student_id);

        // Redirect to the exams show page
        return redirect()->back()->with('success', "L'étudiant a été supprimé avec succès");
    }

    /**
     * Update the result of a student
     */
    public function updateResult(Request $request)
    {
        // Validate the request
        $request->validate([
            'result' => 'required|numeric|min:0|max:100',
        ]);

        // Find the exam
        $exam = Exam::findOrFail($request->exam_id);

        // Update the result updateExistingPivot($id, array $attributes)
        $exam->user()->updateExistingPivot($request->student_id, ['result' => $request->result]);

        // Redirect to the exams show page
        return redirect()->back()->with('success', 'La note a été mise à jour avec succès');
    }
}
