<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class RecipeController extends Controller
{
    public function create()
    {

        $countriesByRegion = [
            'Africa' => [
                'Algeria', 'Angola', 'Benin', 'Botswana', 'Burkina Faso', 'Burundi', 'Cameroon', 'Cape Verde', 'Chad', 'Comoros',
                'Côte d\'Ivoire', 'Congo (Congo-Brazzaville)', 'Democratic Republic of the Congo', 'Djibouti', 'Egypt', 'Eritrea', 
                'Eswatini', 'Ethiopia', 'Gabon', 'Gambia', 'Ghana', 'Guinea', 'Guinea-Bissau', 'Kenya', 'Lesotho', 'Liberia', 'Libya',
                'Madagascar', 'Malawi', 'Mali', 'Mauritania', 'Mauritius', 'Morocco', 'Mozambique', 'Namibia', 'Niger', 'Nigeria',
                'Rwanda', 'São Tomé and Príncipe', 'Senegal', 'Seychelles', 'Sierra Leone', 'Somalia', 'South Africa', 'Sudan', 'Tanzania',
                'Togo', 'Tunisia', 'Uganda', 'Zambia', 'Zimbabwe'
            ],
            'Asia' => [
                'Afghanistan', 'Armenia', 'Azerbaijan', 'Bahrain', 'Bangladesh', 'Bhutan', 'Cambodia', 'China', 'Cyprus', 'Georgia',
                'India', 'Indonesia', 'Iran', 'Iraq', 'Israel', 'Japan', 'Jordan', 'Kazakhstan', 'Kuwait', 'Kyrgyzstan', 'Laos',
                'Lebanon', 'Malaysia', 'Maldives', 'Mongolia', 'Myanmar', 'Nepal', 'North Korea', 'Oman', 'Pakistan', 'Palestine',
                'Philippines', 'Qatar', 'Saudi Arabia', 'Singapore', 'Sri Lanka', 'Syria', 'Tajikistan', 'Thailand', 'Timor-Leste',
                'Turkey', 'Turkmenistan', 'United Arab Emirates', 'Uzbekistan', 'Vietnam', 'Yemen'
            ],
            'Europe' => [
                'Albania', 'Andorra', 'Austria', 'Belarus', 'Belgium', 'Bosnia and Herzegovina', 'Bulgaria', 'Croatia', 'Cyprus', 'Czech Republic',
                'Denmark', 'Estonia', 'Finland', 'France', 'Georgia', 'Germany', 'Greece', 'Hungary', 'Iceland', 'Ireland', 'Italy', 
                'Kosovo', 'Latvia', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Malta', 'Moldova', 'Monaco', 'Montenegro', 'Netherlands', 
                'North Macedonia', 'Norway', 'Poland', 'Portugal', 'Romania', 'San Marino', 'Serbia', 'Slovakia', 'Slovenia', 'Spain', 
                'Sweden', 'Switzerland', 'Ukraine', 'United Kingdom', 'Vatican City'
            ],
            'North America' => [
                'Antigua and Barbuda', 'Bahamas', 'Barbados', 'Belize', 'Canada', 'Costa Rica', 'Cuba', 'Dominica', 'Dominican Republic', 
                'El Salvador', 'Grenada', 'Guatemala', 'Haiti', 'Honduras', 'Jamaica', 'Mexico', 'Nicaragua', 'Panama', 'Saint Kitts and Nevis', 
                'Saint Lucia', 'Saint Vincent and the Grenadines', 'Trinidad and Tobago', 'United States'
            ],
            'South America' => [
                'Argentina', 'Bolivia', 'Brazil', 'Chile', 'Colombia', 'Ecuador', 'French Guiana', 'Guyana', 'Paraguay', 'Peru', 'Suriname',
                'Uruguay', 'Venezuela'
            ],
            'Oceania' => [
                'American Samoa', 'Australia', 'Cook Islands', 'Fiji', 'French Polynesia', 'Kiribati', 'Marshall Islands', 'Micronesia', 
                'Nauru', 'New Zealand', 'Palau', 'Papua New Guinea', 'Samoa', 'Solomon Islands', 'Tonga', 'Tuvalu', 'Vanuatu'
            ]
        ];
        

        $categories = Category::recipeCategories()->get();
        return view('recipes.create', compact('categories', 'countriesByRegion'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'ingredients' => 'required|array',
            'ingredients.*' => 'required|string', 
            'instructions' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'nullable|exists:categories,id',
            'country' => 'required|string|max:255',
            'preparation_time' => 'required|integer',
        ]);

        $imagePath = null;

        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('recipe_images', 'public');
        }

        Recipe::create([
            'title' => $request->title,
            'ingredients' => json_encode($request->ingredients),
            'instructions' => $request->instructions,
            'description' => $request->description,
            'image' => $imagePath,
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'country' => $request->country,
            'preparation_time' => $request->preparation_time,
        ]);

        return redirect()->route('recipes.create');
    }
}