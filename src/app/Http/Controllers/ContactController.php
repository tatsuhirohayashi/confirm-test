<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactController extends Controller
{
    public function admin()
    {
        $contacts = Contact::with('category')->Paginate(7);
        $categories = Category::all();
        $search = false;

        return view('admin', compact('contacts', 'categories', 'search'));
    }

    public function contact()
    {
        $categories = Category::all();

        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'address', 'building', 'category_id', 'detail']);
        $category = Category::find($contact['category_id']);

        $tell1 = $request->input('tell1');
        $tell2 = $request->input('tell2');
        $tell3 = $request->input('tell3');

        $tell = $tell1 . $tell2 . $tell3;

        $contact['tell'] = $tell;

        return view('confirm', compact('contact', 'category'));
    }

    public function store(Request $request)
    {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tell', 'address', 'building', 'category_id', 'detail']);
        Contact::create($contact);

        return view('thanks');
    }

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }

    public function search(Request $request)
    {
        $query = Contact::with('category')->DateSearch($request->created_at)->CategorySearch($request->category_id)->KeywordSearch($request->keyword);

        if ($request->gender == 'all') {
            $genderValues = ['1', '2', '3'];
            $query->whereIn('gender', $genderValues);
        } else {
            $query->GenderSearch($request->gender);
        }

        $contacts = $query->Paginate(7)->appends($request->all());
        $categories = Category::all();
        $search = true;

        return view('admin', compact('contacts', 'categories', 'search'));
    }

    public function export()
    {
        $contacts = Contact::all();
        $csvHeader = ['id', 'category_id', 'first_name', 'last_name', 'gender', 'email', 'tell', 'address', 'building', 'detail', 'created_at', 'updated_at'];
        $csvData = $contacts->toArray();

        $response = new StreamedResponse(function () use ($csvHeader, $csvData) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $csvHeader);

            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ]);

        return $response;
    }

    public function exportSearch(Request $request)
    {
        // クエリを構築
        $query = Contact::query();

        if ($request->filled('created_at')) {
            $query->DateSearch($request->created_at);
        }

        if ($request->filled('category_id')) {
            $query->CategorySearch($request->category_id);
        }

        if ($request->filled('gender')) {
            if ($request->gender == 'all') {
                $genderValues = ['1', '2', '3'];
                $query->whereIn('gender', $genderValues);
            } else {
                $query->GenderSearch($request->gender);
            }
        }

        if ($request->filled('keyword')) {
            $query->KeywordSearch($request->keyword);
        }

        // データを取得して配列に変換
        $contacts = $query->get()->toArray();

        $csvHeader = ['id', 'category_id', 'first_name', 'last_name', 'gender', 'email', 'tell', 'address', 'building', 'detail', 'created_at', 'updated_at'];

        $response = new StreamedResponse(function () use ($csvHeader, $contacts) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $csvHeader);

            foreach ($contacts as $contact) {
                fputcsv($handle, $contact);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="search_results.csv"',
        ]);

        return $response;
    }
}
