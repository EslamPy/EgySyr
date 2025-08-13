<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\ContactMessage;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContactMessagesExport;

class ContactMessageController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = ContactMessage::query();

        if ($search = $request->string('q')->toString()) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        if ($from = $request->date('from', null)) {
            $query->whereDate('created_at', '>=', $from);
        }
        if ($to = $request->date('to', null)) {
            $query->whereDate('created_at', '<=', $to);
        }

        $messages = $query->latest()->paginate(20);

        return response()->json($messages);
    }

    public function export()
    {
        return Excel::download(
            new ContactMessagesExport(),
            'contact_messages_' . date('Y-m-d') . '.xlsx'
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = ContactMessage::whereKey($id)->delete();
        return response()->json(['deleted' => (bool) $deleted]);
    }
} 