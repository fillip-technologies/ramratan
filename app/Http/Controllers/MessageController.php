<?php

namespace App\Http\Controllers;

use App\Models\OredrSupport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function UerssendMessage(Request $request)
    {
        try {
            $validated = $request->validate([
                'order_id' => 'required|integer',
                'user_id' => 'required|integer',
                'message' => 'required|string|max:1000',
            ]);

            $message = new OredrSupport;
            $message->order_id = $validated['order_id'];
            $message->user_id = $validated['user_id'];
            $message->message = $validated['message'];
            $message->status = 1;
            $message->save();

            $msgs = OredrSupport::where('order_id', $validated['order_id'])
                ->whereIn('status', [1, 2])
                ->orderBy('created_at', 'asc')
                ->get(['order_id', 'user_id', 'message', 'status', 'created_at']);

            return response()->json([
                'status' => 'success',
                'messages' => $msgs,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getMessages($order_id)
    {
        try {
            $messages = OredrSupport::where('order_id', $order_id)->Orwhere('user_id',Auth::id())
                ->whereIn('status', [1, 2])
                ->orderBy('created_at', 'asc')
                ->get(['order_id', 'user_id', 'message', 'status', 'created_at']);

            return response()->json([
                'status' => 'success',
                'messages' => $messages,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


  
    public function getadminmsg(){
        $allsmg=OredrSupport::all();
        return view('admin.FormData.ordersupport',compact('allsmg'));

    }

      public function adminStoreMsg(Request $request){
          try {
            $validated = $request->validate([
                'order_id' => 'required|integer',
                'user_id' => 'required|integer',
                'message' => 'required|string|max:1000',
            ]);

            $message = new OredrSupport;
            $message->order_id = $validated['order_id'];
            $message->user_id = $validated['user_id'];
            $message->message = $validated['message'];
            $message->status = 2;
            $message->save();

            $msgs = OredrSupport::where('order_id', $validated['order_id'])
                ->whereIn('status', [1, 2])
                ->orderBy('created_at', 'asc')
                ->get(['order_id', 'user_id', 'message', 'status', 'created_at']);

            return response()->json([
                'status' => 'success',
                'messages' => $msgs,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
