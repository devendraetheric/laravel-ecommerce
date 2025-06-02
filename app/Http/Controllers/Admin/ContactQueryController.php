<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactQuery;
use App\Notifications\ContactCreatedNotification;
use Illuminate\Http\Request;

class ContactQueryController extends Controller
{
    public function index()
    {
        $contactQueries = ContactQuery::latest()
            ->search(request('query'))
            ->paginate()
            ->withQueryString();

        return view('admin.contactQueries.index', compact('contactQueries'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactQuery $contactQuery)
    {
        $contactQuery->delete();

        return redirect()
            ->route('admin.contactQueries.index')
            ->with('success', __('Contact Query deleted successfully.'));
    }
}
