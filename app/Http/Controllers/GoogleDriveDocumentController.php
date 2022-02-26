<?php

namespace App\Http\Controllers;

use App\Models\ProductDocument;
use App\Traits\deleteTraits;
use Google\Service\Storage as ServiceStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GoogleDriveDocumentController extends Controller
{
    use deleteTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $productDocument;
    public function __construct(ProductDocument $productDocument)
    {
        $this->productDocument = $productDocument;
    }
    public function index()
    {
        // $document = $this->productDocument->latest()->paginate(5);
        $dir = '/'; //thư mục gốc
        $recursive = false; //  Có lấy file trong các thư mục con không?
        $documents_all = collect(Storage::disk('google')->listContents($dir, $recursive));
        $documents = $documents_all->forPage(0, 5);
        // dd($documents_all->count() % 5);
        return view('admin.Document.index', compact('documents_all', 'documents'));
    }
    public function getDataPaginate(Request $request)
    {
        $page = $request->page;
        $start = $page * 5;
        $dir = '/'; //thư mục gốc
        $recursive = false; //  Có lấy file trong các thư mục con không?
        $documents_all = collect(Storage::disk('google')->listContents($dir, $recursive));
        $documents = $documents_all->forPage(0, $start);
        $html_dataDocument = view('admin.Document.components.data', compact('documents'))->render();
        $lastPage = round($documents_all->count() / 5);
        // dd($lastPage);
        return Response()->json([
            'status' => 200,
            'html_dataDocument' => $html_dataDocument,
            'lastPage' => $lastPage,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function create_document()
    {
        Storage::disk('google')->put('test.txt', 'hello');
        dd('ok');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($name, $path)
    {
        Storage::disk('google')->delete($path);
        $productDocument = $this->productDocument->where('document_name', $name)->first();
        if ($productDocument != null) {
            return $this->DeleteTraits($this->productDocument, $productDocument->id);
        } else {
            return Response()->json([
                'status' => 200,
                'message' => 'Da xoa ggDriver, document nay khong co trong csdl'
            ], 200);
        };
    }
}
