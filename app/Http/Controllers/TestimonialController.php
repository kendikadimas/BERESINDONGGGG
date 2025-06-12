<?php
// app/Http/Controllers/TestimonialController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    // public function create()
    // {
    //     return Inertia::render('AddTestimoniForm');
    // }

    public function store(Request $request)
    {
        $request->validate(['comment' => 'required|string|min:10|max:500']);

        $request->user()->testimonials()->create([
            'comment' => $request->comment,
            'is_approved' => true, 
        ]);

        return redirect()->route('home');
    }
}