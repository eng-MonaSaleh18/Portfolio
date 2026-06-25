<?php
namespace App\Http\Controllers;

use App\Models\AboutMe;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use App\Models\VisitorMessage;
use Symfony\Component\HttpFoundation\Request;

class PortfolioController extends Controller
{
    public function getPortfolio()
    {
        // 1. جلب بيانات "عني" - نفترض وجود سجل واحد فقط
        $about = AboutMe::first();

        // 2. جلب المهارات مرتبة حسب الترتيب الذي تفضلينه أو حسب تاريخ الإضافة
        $skills = Skill::all();

        // 3. جلب المشاريع مرتبة من الأحدث إلى الأقدم
        $projects = Project::latest()->get();
        $user     = User::first();

        return view('portfolio', compact('about', 'skills', 'projects', 'user'));
    }

    public function storeMessage(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|max:255',
            'message_subject' => 'required|string|max:255',
            'message_content' => 'required|string',
        ]);

        VisitorMessage::create($validated);

        return back()->with('success', 'Your message has been sent successfully!');
    }
}
