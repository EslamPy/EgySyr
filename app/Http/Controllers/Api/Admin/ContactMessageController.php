<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\ContactMessage;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    public function export(Request $request): StreamedResponse
    {
        $query = ContactMessage::query()->latest();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contact_messages.csv"',
        ];

        $callback = function () use ($query) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Name', 'Email', 'Subject', 'Message', 'Created At']);
            $query->chunk(500, function ($rows) use ($handle) {
                foreach ($rows as $row) {
                    fputcsv($handle, [
                        $row->id, $row->name, $row->email, $row->subject, $row->message, $row->created_at,
                    ]);
                }
            });
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = ContactMessage::whereKey($id)->delete();
        return response()->json(['deleted' => (bool) $deleted]);
    }
} 