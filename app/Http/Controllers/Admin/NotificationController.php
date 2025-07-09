<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::with('user')->latest()->paginate(15);
        return view('admin.notifications.index', compact('notifications'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();
        return view('admin.notifications.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'user_id' => 'nullable',
        ]);

        if ($request->user_id === 'all' || is_null($request->user_id)) {
            $users = User::all();
            foreach ($users as $user) {
                Notification::create(['user_id' => $user->id, 'title' => $request->title, 'message' => $request->message]);
            }
            $message = 'Notificação enviada para todos os utilizadores.';
        } else {
            $request->validate(['user_id' => 'exists:users,id']);
            Notification::create($request->all());
            $message = 'Notificação enviada com sucesso.';
        }

        return redirect()->route('admin.notifications.index')->with('success', $message);
    }

    public function show(Notification $notification)
    {
        return view('admin.notifications.show', compact('notification'));
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return redirect()->route('admin.notifications.index')->with('success', 'Notificação apagada com sucesso.');
    }
}
