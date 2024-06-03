<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\ApplyLoans;
use App\Models\Applys;

class ChatController extends Controller
{
    public function messagesSend($applicantId)
    {
        $messages = Message::where('applicant_id', $applicantId)
        ->with('user')
        ->get();
        // Fetch the status of the applicant
        $applicantStatus = Applys::where('id', $applicantId)->value('status');
    
         // Store the phoneNumber in the session
    $phoneNumber = session('trackLoanData.phoneNumber');

    return view('frontend.chat', compact('messages', 'applicantId', 'applicantStatus', 'phoneNumber'));
    }

    public function messagesStore(Request $request, $applicantId)
    {

        $validatedData = $request->validate([
            'text' => 'required_without:file|max:255',
            'file' => 'required_without:text|array|max:5', // Limit the number of files to 5
            'file.*' => 'file',
        ]);
    
        // Fetch the applicant data
        $applicant = Applys::find($applicantId);
        //dd($applicant);
    
        $message = Message::create([
            'applicant_id' => $applicantId,
            'user_id' => $applicant->id,
            'text' => $request->input('text'),
            'user_type_id' => $applicant->user_type_id, // Add this line to store the user_type_id from the bank_branches table
        ]);
    
        if ($request->has('file')) {
            $filenames = [];
            foreach ($request->file('file') as $file) {
                $extension = $file->getClientOriginalName(); // Corrected variable name
                $filename = time() . '.' . $extension;
                $file->move('storage/', $filename);
                $filenames[] = $filename;
            }
            $message->file = json_encode($filenames);
        }
    
        $message->save();
    
        session()->flash('message', 'Message created and job dispatched.');
    
        return redirect()->back();
    }
    
}
