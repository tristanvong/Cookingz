<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\ContactForm;
use App\Models\FAQItem;
use App\Models\FAQProposal;
use App\Models\FoodType;
use App\Models\NewsItem;
use App\Models\Recipe;

class AdminController extends Controller
{
    public function listAllUsers(Request $request)
    {
        $query = User::query();
    
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
    
        if ($request->has('sort') && in_array($request->sort, ['asc', 'desc'])) {
            $query->orderBy('id', $request->sort);
        }
    
        $users = $query->get();
    
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username|regex:/^\S*$/',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'in:user,admin',
        ], [
            'username.regex' => 'Username cannot contain spaces.',
        ]);

        try {
            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.users.create')->with('error', 'User could not be created. Please try again.');
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function makeAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'admin';
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User promoted to admin.');
    }

    public function revokeAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'user';
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Admin privileges revoked.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function dashboard(Request $request)
    {
        $model = $request->get('model', 'Category');
        $query = $this->getModelQuery($model);

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            if ($model == 'Category') {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('id', $search);
                });
            }elseif ($model == 'ContactForm') {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('id', $search);
                });
            }elseif ($model == 'FAQItem' || $model == 'FAQProposal') {
                $query->where(function ($q) use ($search) {
                    $q->where('question', 'like', "%{$search}%")
                      ->orWhere('id', $search);
                });
            }elseif ($model == 'FoodType') {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('id', $search);
                });
            }
            elseif ($model == 'NewsItem') {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('id', $search);
                });
            }elseif ($model == 'Recipe') {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('id', $search);
                });
            }elseif ($model == 'User') {
                $query->where(function ($q) use ($search) {
                    $q->where('username', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('id', $search);
                });
            }
        }

        $results = $query->get();

        return view('admin.dashboard.dashboard', compact('results', 'model'));
    }

    public function listAll(Request $request)
    {
        $model = $request->get('model', 'Category');
        $query = $this->getModelQuery($model);

        $results = $query->get();

        return view('admin.dashboard.dashboard', compact('results', 'model'));
    }

    private function getModelQuery($model)
    {
        switch ($model) {
            case 'ContactForm':
                return ContactForm::query();
            case 'Category':
                return Category::query();
            case 'FAQItem':
                return FAQItem::query()->with('category');
            case 'FAQProposal':
                return FAQProposal::query()->with('category', 'user');
            case 'FoodType':
                return FoodType::query();
            case 'NewsItem':
                return NewsItem::query();
            case 'Recipe':
                return Recipe::query()->with('category', 'user', 'foodTypes');
            case 'User':
                return User::query()->with('blacklist');
            default:
                return Category::query();
        }
    }
}