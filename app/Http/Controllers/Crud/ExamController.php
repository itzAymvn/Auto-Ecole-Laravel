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
        return redirect()->route('exams.index')->with('success', 'L\'examen a été créé avec succès.');
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
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        $exam = Exam::with('user')->find($exam->id);
        $students = User::where('type', 'student')->whereNotIn('id', $exam->user->pluck('id'))->get();
        $instructors = User::where('type', 'instructor')->get();
        $exam_students = $exam->user;
        $vehicles = Vehicle::all();

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
            'exam_type' => 'required|in:drive,code',
            'exam_location' => 'required',
            'instructor_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        // updating the exam
        $exam->exam_title = $request->exam_title;
        $exam->exam_date = $request->exam_date;
        $exam->exam_time = $request->exam_time;
        $exam->exam_type = $request->exam_type;
        $exam->exam_location = $request->exam_location;
        $exam->instructor_id = $request->instructor_id;
        $exam->vehicle_id = $request->vehicle_id;

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
        $exam = Exam::findOrfail($exam->id);
        $exam->delete();

        return redirect()->route('exams.index')->with('success', "L'examen a été supprimé avec succès");
    }

    /**
     * Add a student to an exam
     */
    public function addStudent(Request $request)
    {
        $exam = Exam::find($request->exam_id);
        $exam->user()->attach($request->student_id);

        return redirect()->back()->with('success', "L'étudiant a été ajouté avec succès");
    }

    /**
     * 
     * Remove a student from an exam
     */
    public function removeStudent(Request $request)
    {
        $exam = Exam::find($request->exam_id);
        $exam->user()->detach($request->student_id);

        return redirect()->back()->with('success', "L'étudiant a été supprimé avec succès");
    }

    /**
     * Update the result of a student
     */
    public function updateResult(Request $request)
    {
        $request->validate([
            'result' => 'required|numeric|min:0|max:100',
        ]);

        $exam = Exam::findOrFail($request->exam_id);
        $exam->user()->updateExistingPivot($request->student_id, ['result' => $request->result]);

        return redirect()->back()->with('success', 'La note a été mise à jour avec succès');
    }
}
