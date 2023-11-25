<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class UploadDocumentController extends Controller
{
    public function uploadDocument(Request $request)
    {
        // dd('ok');
        $request->validate([
            'files.*' => 'required|mimes:png,jpg,pdf,jpeg'
        ]);

        $uploadedFiles = $request->file('files'); // Use 'files' instead of 'file'
        $filenames = [];


        foreach ($uploadedFiles as $file) {
            //error handling
            $extension = $file->getClientOriginalExtension();
            if (!in_array($extension, ['png', 'jpg', 'pdf', 'jpeg'])) {
                return response()->json([
                    'error' => 'Invalid file type. Only PNG, JPG, MP4, PDF, and JPEG files are allowed.'
                ], 400); // Return a 400 Bad Request status with an error message
            }

            $originalFileName = $file->getClientOriginalName();
            $filename = time() . '_' . $file->getClientOriginalName();
            // $file->storeAs('upload', $filename, 'public');
            $file->storeAs('upload', $filename, 'private');
            $filenames[] = $filename;

            // Cut off the number prefix and underscore from the original filename
            $displayFilename = preg_replace('/^\d+_/u', '', $originalFileName);

            // Save file information to the "documents" table
            $document = new Document();
            $document->file_name = $displayFilename;
            $document->file_path = 'upload/' . $filename;

            $document->user_id = $request->user_id;
            $document->save();
        }


        return response()->json([
            'message' => 'File uploaded successfully',
            'filenames' => $filenames,
            // 'document' => $document
        ]);
    }

    public function retrieveApplicantDocument(string $applicantId)
    {
        $user = User::where('applicant_id', $applicantId)->first();

        if ($user) {
            return Document::where('user_id', $user->id)->get();
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function openPdfFile(string $id)
    {
        $document = Document::find($id);
        // $document = Document::where('file_path', $filepath)->first();

        if (!$document) {
            return response()->json(['error' => 'Document not found'], 404);
        }

        $filePath = "private/$document->file_path";

        if (!Storage::exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        return response()->file(
            Storage::path($filePath)
        );
    }

    public function retrieveDocument(string $id)
    {

        return Document::where('user_id', $id)->get();
    }

    public function destroy(string $id)
    {
        $document = Document::findOrFail($id);
        $olddocument = $document->file_path;

        if ($olddocument) {
            Storage::disk('private')->delete($olddocument);
        }

        // Delete the document record from the database
        $document->delete();

        return response()->json(['message' => 'Document deleted successfully']);
        // return Document::destroy($id);
    }


    //upload file document for student
    public function uploadDocumentStudent(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpeg,png,pdf|min:12',
            "file_type" => 'nullable|string',
        ]);

        $file = $request->file('file');
        $fileName =  time() . '_' .  $file->getClientOriginalName();
        $filePath = $file->storeAs('upload', $fileName, 'private');
        $file_type = $request->input('file_type');


        $document = new Document();
        $document->file_name = $fileName;
        $document->file_path = $filePath;
        $document->file_type = $file_type;
        $document->user_id = auth()->id();
        $document->save();

        return response()->json(['message' => 'File uploaded successfully',
        'file'=> $document,
    ]);
    }

    //update doc by replace it with a new one
    public function updateDocument(Request $request, $documentId)
    {
        // Validate the incoming request and file
        $request->validate([
            'file' => 'required|mimes:jpeg,png,pdf,ppt,docx|min:24',
        ]);

        // Find the document to replace
        $document = Document::where('id', $documentId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Delete the old file
        Storage::disk('private')->delete($document->file_path);

        // Store the new file
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('upload', $fileName, 'private');

        // Update the document record with the new file information
        $document->update([
            'file_name' => $fileName,
            'file_path' => $filePath,
        ]);

        return response()->json([
            'message' => 'File replaced successfully',
            'file'=> $document,
    ]);
    }

    //get document belong to which user
    public function getDocuments()
    {
        $documents = Document::where('user_id', auth()->id())->get();
        return response()->json($documents);
    }

    //delete document belong to which user
    public function deleteDocument($id)
    {
        $document = Document::findOrFail($id);
        $olddocument = $document->file_path;

        if ($olddocument) {
            Storage::disk('private')->delete($olddocument);
        }

        // Delete the document record from the database
        $document->delete();

        return response()->json(['message' => 'Document deleted successfully']);
    }


    //preview file student
    public function previewDocument(string $documentId)
    {
        return response()->file(storage_path('app/private/upload/' .  $documentId));
    }
}
